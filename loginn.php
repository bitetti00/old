<?php
// Ativa exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicia sessão (ADICIONADO - mínimo)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Conexão com MySQL
$conn = new mysqli("localhost", "root", "", "oldfilmes");
if ($conn->connect_error) {
    header("Location: errologin.php?mensagem=" . urlencode("Erro de conexão com o banco de dados."));
    exit;
}

// Recebe dados do formulário
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

// Valida campos
if (empty($email) || empty($senha)) {
    header("Location: errologin.php?mensagem=" . urlencode("Todos os campos são obrigatórios."));
    exit;
}

// Valida formato de e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: errologin.php?mensagem=" . urlencode("E-mail inválido."));
    exit;
}

// Busca usuário no banco
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: errologin.php?mensagem=" . urlencode("E-mail não cadastrado."));
    exit;
}

$usuario = $result->fetch_assoc();

// Verifica senha
if (password_verify($senha, $usuario['senha'])) {
    // Autenticação OK

    // SALVAR INFORMAÇÕES NA SESSÃO (ADICIONADO - mínimo)
    // Mantemos o redirecionamento original (sucesso_login.php) para não alterar fluxo
    $_SESSION['user_id']   = isset($usuario['id']) ? $usuario['id'] : null;
    $_SESSION['user_name'] = isset($usuario['nome']) ? $usuario['nome'] : null;

    // Define flag de admin (se a coluna is_admin existir será 1/0; senão ficará 0)
    $_SESSION['is_admin'] = (!empty($usuario['is_admin']) && $usuario['is_admin'] == 1) ? 1 : 0;

    // Redireciona para página de sucesso como antes
    header("Location: sucesso_login.php?nome=" . urlencode($usuario['nome']));
    exit;
} else {
    header("Location: errologin.php?mensagem=" . urlencode("Senha incorreta."));
    exit;
}

$conn->close();
?>
