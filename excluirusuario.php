<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    die("Acesso negado.");
}

if (!isset($_GET['id'])) {
    header("Location: listarusuarios.php");
    exit;
}

$id = intval($_GET['id']);
$conn = new mysqli("localhost", "root", "", "oldfilmes");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: listarusuarios.php");
exit;
?>
