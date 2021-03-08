<?php 
session_start();

$idProducto = $_GET['id_producto'];
unset($_SESSION['cart'][$idProducto]);
header ('location: cart.php');
?>