<?php
// Recebe a mensagem via GET
$mensagem = isset($_GET['mensagem']) ? $_GET['mensagem'] : "Erro desconhecido";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Erro - CinePlay</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0b0b0b;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .erro-box {
            background-color: #1a1a1a;
            padding: 30px 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 15px #ff0000;
        }
        a {
            color: #ff5555;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="erro-box">
        <h2>Ops! Algo deu errado</h2>
        <p><?php echo htmlspecialchars($mensagem); ?></p>
        <p><a href="cadastro.html">Voltar para cadastro</a></p>
    </div>
</body>
</html>
