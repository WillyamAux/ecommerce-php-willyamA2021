<?php 
require_once('./db.php');
$nombre = $_POST['nombre'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$pdo = getPdo();

$sqlValidacionCuenta = "select * from usuarios where username = ? or email =?";
$consultaValidacion = $pdo->prepare($sqlValidacionCuenta);
$consultaValidacion->execute([$username,$email]);


if ($consultaValidacion->rowCount() > 0){
    header('location: account.php?error=datosExistentesError');
}else {

  $sqlInsertarUsuario = " insert into usuarios (`nombre`,`username`,`password`,`email`) values (?,?,?,?) ";
  $consulta = $pdo->prepare($sqlInsertarUsuario);
  $consulta->execute([$nombre,$username,$password,$email]);  
  header('location: account.php');
}

?>
