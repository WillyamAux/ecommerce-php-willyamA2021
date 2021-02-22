<?php
$username = $_POST ['username'];
$password = $_POST ['password'];
$email = $_POST ['email'];

$archivoRegistro = fopen("cuentas/$username.txt",'w+');
fwrite($archivoRegistro,$username."\n");
fwrite($archivoRegistro,$password."\n");
fwrite($archivoRegistro,$email."\n");
fclose($archivoRegistro);
header('Location: account.php');


?>