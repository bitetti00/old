<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro realizado - CinePlay</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(135deg, #000000, #4b0000); /* Preto para vermelho escuro */
      color: #fff;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    h2 {
      font-size: 32px;
      margin-bottom: 20px;
      text-shadow: 0 0 10px #000;
    }

    p {
      font-size: 18px;
      margin-bottom: 30px;
    }

    /* Bolinhas de carregamento */
    .loader {
      display: flex;
      justify-content: center;
      align-items: flex-end;
      gap: 10px;
      height: 50px;
    }

    .loader div {
      width: 15px;
      height: 15px;
      background-color: #8b0000; /* Vermelho-vinho */
      border-radius: 50%;
      animation: bounce 0.6s infinite alternate;
    }

    .loader div:nth-child(2) { animation-delay: 0.2s; }
    .loader div:nth-child(3) { animation-delay: 0.4s; }

    @keyframes bounce {
      from { transform: translateY(0); }
      to { transform: translateY(-20px); }
    }

    a {
      display: inline-block;
      margin-top: 20px;
      color: #fff;
      text-decoration: underline;
      font-weight: bold;
    }
  </style>

  <script>
    // Redirecionamento automático após 4 segundos
    setTimeout(function() {
      window.location.href = 'loginn.html';
    }, 4000);
  </script>
</head>
<body>
  <h2>Cadastro realizado com sucesso!</h2>
  <p>Você será redirecionado para a página de login em instantes...</p>
  
  <div class="loader">
    <div></div>
    <div></div>
    <div></div>
  </div>

  <p>Se não for redirecionado, <a href="loginn.html">clique aqui</a>.</p>
</body>
</html>
