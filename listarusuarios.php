<?php
session_start();

$conn = new mysqli("localhost", "root", "", "oldfilmes");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT id, nome, email, criado_em FROM usuarios";
$result = $conn->query($sql);
?>

<h2>Lista de Usuários</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Criado em</th>
        <th>Ações</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['nome']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= $row['criado_em'] ?></td>
        <td>
            <a href="excluirusuario.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza?');">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php $conn->close(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<style>

/* Fundo escuro e fonte clara */
body {
    background-color: #121212;
    color: #f0f0f0;
    font-family: Arial, sans-serif;
    margin: 20px;
}

/* Título */
h2 {
    text-align: center;
    color: #ffffff;
    margin-bottom: 20px;
}

/* Tabela estilizada */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    padding: 12px;
    border: 1px solid #333;
    text-align: center;
}

table th {
    background-color: #1f1f1f;
}

table tr:nth-child(even) {
    background-color: #1a1a1a;
}

table tr:hover {
    background-color: #333;
}

/* Links de ação */
a {
    color: #ff4d4d;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

a:hover {
    color: #ff0000;
}

/* Botão de voltar */
.voltar-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #1f1f1f;
    color: #f0f0f0;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s, color 0.3s;
}

.voltar-btn:hover {
    background-color: #333;
    color: #ffffff;
}

</style>

    <a href="index.html" class="voltar-btn">Voltar</a>
</body>
</html>
