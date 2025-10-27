<?php
$mensagem = isset($_GET['mensagem']) ? htmlspecialchars($_GET['mensagem']) : "Ocorreu um erro no login.";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Erro no Login</title>
<style>
body {
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(135deg, #1a0000, #000000);
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
}
h2 { font-size: 32px; margin-bottom: 20px; color: #ff5555; }
p { font-size: 18px; margin-bottom: 30px; }
a.button {
    display: inline-block;
    padding: 12px 25px;
    background-color: #ff0000;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    transition: all 0.3s;
}
a.button:hover { background-color: #cc0000; }
</style>
</head>
<body>
<h2>Erro no Login!</h2>
<p><?php echo $mensagem; ?></p>
<a href="loginn.html" class="button">Tentar novamente</a>
</body>
</html>
