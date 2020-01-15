<?php 

require_once 'conexion.php';

function search()
{
	$mysqli = getConnexion();
	$search = $mysqli->real_escape_string($_POST['search']);
	$query = "SELECT genero FROM persona WHERE cedula = '$search' ";
	$res = $mysqli->query($query);
	$row = $res->fetch_array(MYSQLI_ASSOC);
	echo "$row[genero]";
}

search();

?>