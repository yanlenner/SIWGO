<?php
session_start();
include '../../src/php/enlace.php';
$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$enlace->set_charset('utf8');
if (!$enlace) die("Conexión fallida: " . mysqli_connect_error());
$result = mysqli_query($enlace, "SELECT max(id_sesion) as id FROM sesion WHERE usuario = '$_SESSION[usuario]'");
$row = mysqli_fetch_assoc($result);
$marca=date("Y-m-d H:i:s");
$query = mysqli_query($enlace, "INSERT into registro_devisitas (id_sesion, enlace, tiempo) values('$row[id]','$_SERVER[PHP_SELF]','$marca')");
$query = mysqli_query($enlace, "UPDATE sesion set fin ='$marca', minutos=TIMESTAMPDIFF(MINUTE,inicio,fin) where id_sesion = '$row[id]' and usuario like '$_SESSION[usuario]'");
session_unset($_SESSION['usuario']);
session_unset($_SESSION['nivel']);
session_unset($_SESSION['ultimoAcceso']);
session_destroy();
header("Location:../../",TRUE,301);
mysqli_close($enlace);
?>