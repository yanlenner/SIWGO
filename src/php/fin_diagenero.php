<?php 
require('conexion.php');

$mysqli = getConnexion();
$sql  = "SELECT diagnostico, COUNT( DISTINCT(id_historia) ) AS hombres FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select genero from persona t3 where t3.cedula = t2.cedula and genero like 'H')) GROUP BY diagnostico ORDER BY hombres DESC LIMIT 11"; 

$sql2 = "SELECT diagnostico, COUNT( DISTINCT(id_historia) ) AS mujeres FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select genero from persona t3 where t3.cedula = t2.cedula and genero like 'M')) GROUP BY diagnostico ORDER BY mujeres DESC LIMIT 11"; 

$res = $mysqli->query($sql);		

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['mujeres']='';
	$data[] = $row;
}

$res = $mysqli->query($sql2);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['hombres']='';
	$data[] = $row;
}

$results = ["sEcho" => 1,

"iTotalRecords" => count($data),

"iTotalDisplayRecords" => count($data),

"aaData" => $data ];

mysqli_close($mysqli);

echo json_encode($results);

?>