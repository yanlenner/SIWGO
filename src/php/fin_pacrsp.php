<?php 

require_once 'conexion.php';

function search()
{
	$mysqli = getConnexion();
	$search = $mysqli->real_escape_string($_POST['search']);
	$query = "SELECT respuesta from estudiante WHERE cedula = '$search'";
	$res = $mysqli->query($query);
	$row = $res->fetch_array(MYSQLI_ASSOC);
	$count = mysqli_num_rows($res);
	echo "$row[respuesta]";
}


search();

?>