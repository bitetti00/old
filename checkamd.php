<?php
// check_admin.php - inclui nas páginas administrativas
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Se não estiver logado ou não for admin, redireciona
if (empty($_SESSION['user_id']) || empty($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: index.php'); // ajuste para onde quiser enviar
    exit;
}
?>
