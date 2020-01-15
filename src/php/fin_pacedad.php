<?php 

require_once 'conexion.php';

function search()
{
	$mysqli = getConnexion();
	$search = $mysqli->real_escape_string($_POST['search']);
	$query = "SELECT TIMESTAMPDIFF(YEAR,fecha,CURDATE()) AS edad
	FROM persona WHERE cedula = '$search'";
	$res = $mysqli->query($query);
	$row = $res->fetch_array(MYSQLI_ASSOC);
	$count = mysqli_num_rows($res);
	echo "$row[edad]";
}


search();

?>