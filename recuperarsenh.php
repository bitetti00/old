<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco
$conn = new mysqli("localhost", "root", "", "oldfilmes");
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Inicializa variáveis
$mensagem = "";
$mostrarPergunta = false;
$mostrarNovaSenha = false;
$usuarioId = 0; // Evita erro no HTML
$pergunta = "Qual o nome do usuário?";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Etapa 1: Usuário digitou e-mail
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);

        if (empty($email)) {
            $mensagem = "Por favor, preencha o campo de e-mail.";
        } else {
            $stmt = $conn->prepare("SELECT id, nome FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $usuario = $result->fetch_assoc();
                $mostrarPergunta = true;
                $usuarioId = $usuario['id'];
            } else {
                $mensagem = "E-mail não encontrado no sistema.";
            }

            $stmt->close();
        }
    }

    // Etapa 2: Usuário respondeu a pergunta de segurança
    elseif (isset($_POST['resposta'], $_POST['usuarioId'])) {
        $resposta = trim($_POST['resposta']);
        $usuarioId = intval($_POST['usuarioId']);

        $stmt = $conn->prepare("SELECT nome FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();

        if ($usuario && strtolower($resposta) === strtolower($usuario['nome'])) {
            $mostrarNovaSenha = true;
        } else {
            $mensagem = "Resposta incorreta.";
            $mostrarPergunta = true;
        }

        $stmt->close();
    }

    // Etapa 3: Usuário digitou nova senha
    elseif (isset($_POST['nova_senha'], $_POST['usuarioId'])) {
        $novaSenha = trim($_POST['nova_senha']);
        $usuarioId = intval($_POST['usuarioId']);

        if (empty($novaSenha)) {
            $mensagem = "A nova senha não pode ser vazia.";
            $mostrarNovaSenha = true;
        } else {
            $hash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
            $stmt->bind_param("si", $hash, $usuarioId);
            $stmt->execute();
            $stmt->close();

            // Redireciona para login
            header("Location: loginn.html");
            exit();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recuperar Senha</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
body {
  margin: 0;
  padding: 0;
  font-family: 'Roboto', sans-serif;
  background: #0b0b0b;
  background-image: url("fundo-jogos.png");
  background-size: cover;
  background-position: center;
  color: #fff;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.container {
  background: #1a1a1a;
  padding: 40px 30px;
  border-radius: 10px;
  width: 90%;
  max-width: 420px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.8);
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
}

h2 {
  font-size: 28px;
  margin-bottom: 25px;
  font-weight: 700;
  color: #f5f5f5;
  background: linear-gradient(90deg,#fff,#ff5555);
  background-clip: text;
  -webkit-text-fill-color: transparent;
  text-shadow: 0 0 5px #fff33,0 0 10px #ff000022;
}

form {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}

input, button {
  width: 100%;
  max-width: 350px; /* largura máxima */
  padding: 12px 15px;
  border-radius: 6px;
  border: 1px solid #333;
  background: #262626;
  color: #fff;
  font-size: 15px;
  margin: 10px 0;
  box-sizing: border-box; /* garante que padding não aumente largura */
}

input:focus {
  outline: none;
  border-color: #ff0000;
  box-shadow: 0 0 8px 2px #ff0000;
  background: #2e2e2e;
}

button {
  border: none;
  background: #ff0000;
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
}

button:hover {
  background: #cc0000;
  box-shadow: 0 0 15px 3px #ff0000;
}

.mensagem {
  margin-top: 15px;
  font-size: 14px;
  color: #ffaaaa;
}

a.voltar {
  display: inline-block;
  margin-top: 20px;
  color: #fff;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s;
}

a.voltar:hover {
  text-decoration: underline;
  color: #ff5555;
}
</style>
</head>
<body>
<div class="container">
<h2>Recuperar Senha</h2>

<?php if($mostrarPergunta && !$mostrarNovaSenha): ?>
<form method="POST" action="">
<p>Qual o nome do usuário?</p>
<input type="text" name="resposta" placeholder="Digite a resposta" required>
<input type="hidden" name="usuarioId" value="<?php echo $usuarioId; ?>">
<button type="submit">Confirmar</button>
</form>

<?php elseif($mostrarNovaSenha): ?>
<form method="POST" action="">
<input type="password" name="nova_senha" placeholder="Digite a nova senha" required>
<input type="hidden" name="usuarioId" value="<?php echo $usuarioId; ?>">
<button type="submit">Alterar Senha</button>
</form>

<?php else: ?>
<form method="POST" action="">
<input type="email" name="email" placeholder="Digite seu e-mail cadastrado" required>
<button type="submit">Continuar</button>
</form>
<?php endif; ?>

<?php if(!empty($mensagem)): ?>
<p class="mensagem"><?php echo htmlspecialchars($mensagem); ?></p>
<?php endif; ?>

<a href="loginn.html" class="voltar">Voltar ao login</a>
</div>
</body>
</html>
