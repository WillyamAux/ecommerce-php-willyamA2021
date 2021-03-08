<?php
session_start();
$usuario=$_SESSION['user'];

$talla = $_POST['talla'];
$cantidad = $_POST['cantidad'];
$idProducto = $_POST['idProducto'];

if (isset($_SESSION['cart']) == false){

    $_SESSION['cart'] = array();
}

$carritoActual = $_SESSION['cart'];
$productoAgregar = array("idProducto"=> $idProducto, 'talla' => $talla, 'cantidad' => $cantidad);
$carritoActual[] = $productoAgregar;
$_SESSION['cart'] = $carritoActual;

header('location: cart.php')
?>