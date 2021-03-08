<?php

require_once('./db.php');

$username = $_POST['username'];
$password = $_POST['password'];

$pdo = getPdo();
$sqlLogin = "select nombre,username,email from usuarios where username = ? and password = ?";

$consulta = $pdo->prepare($sqlLogin);
$consulta->execute([$username, $password]);
$user = $consulta-> fetch(PDO::FETCH_ASSOC);
if ($consulta->rowCount() == 1) {
    session_start();
    $_SESSION['logueado'] = true;
    $_SESSION['user'] = $user;
    $_SESSION['id']= $id;
    header('location: index.php');
} else {
    header('location: account.php?error=loginError');
}


?>