<?php
$nome = isset($_GET['nome']) ? htmlspecialchars($_GET['nome']) : "Usuário";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Bem-Sucedido</title>
<style>
body {
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(135deg, #000000, #4b0000);
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
}
h2 { font-size: 32px; margin-bottom: 20px; }
p { font-size: 18px; margin-bottom: 30px; }

/* Loader de bolinhas vinho */
.loader {
    display: flex;
    gap: 10px;
    justify-content: center;
    align-items: flex-end;
    height: 50px;
}
.loader div {
    width: 15px;
    height: 15px;
    background-color: #8b0000;
    border-radius: 50%;
    animation: bounce 0.6s infinite alternate;
}
.loader div:nth-child(2) { animation-delay: 0.2s; }
.loader div:nth-child(3) { animation-delay: 0.4s; }

@keyframes bounce {
    from { transform: translateY(0); }
    to { transform: translateY(-20px); }
}
</style>
<script>
// Redireciona para index.html após 4 segundos
setTimeout(() => {
    window.location.href = 'index.html';
}, 4000);
</script>
</head>
<body>
<h2>Bem-vindo, <?php echo $nome; ?>!</h2>
<p>Login realizado com sucesso. Você será levado para a página inicial...</p>
<div class="loader">
    <div></div>
    <div></div>
    <div></div>
</div>
<p>Se não for redirecionado, <a href="index.html">clique aqui</a>.</p>
</body>
</html>
