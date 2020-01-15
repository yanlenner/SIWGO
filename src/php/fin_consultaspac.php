<?php
require('conexion.php');

$mysqli = getConnexion();


$sql  = "SELECT id_historia from estudiante where cedula like '$_POST[paciente]'";
$res = $mysqli->query($sql);
$row = $res->fetch_array(MYSQLI_ASSOC);
$pachis = $row['id_historia'];



$sql  = "SELECT id_consulta, pieza, diagnostico, tipo_consulta, fecha, cedula from consulta t1 where id_historia like '$pachis' and not exists(select id_consulta from tratamiento t2 where t2.id_consulta = t1.id_consulta)";

$res = $mysqli->query($sql);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$sql2="SELECT nombre from persona where cedula like '$row[cedula]'";
	$res2 = $mysqli->query($sql2);
  	$row2 = $res2->fetch_array(MYSQLI_ASSOC);
  	$count = mysqli_num_rows($res2);
  	if($count == 0)
	$row['doctor']='Odontólogo Retirado';
	else
	$row['doctor']=$row2['nombre'];
	$data[] = $row;
}

$results = ["sEcho" => 1,

"iTotalRecords" => count($data),

"iTotalDisplayRecords" => count($data),

"aaData" => $data ];

mysqli_close($mysqli);

echo json_encode($results);

?>
