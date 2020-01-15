<?php 
require('conexion.php');

$mysqli = getConnexion();
$query  = "SELECT diagnostico, COUNT( DISTINCT(id_historia) ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) <26 )) GROUP BY diagnostico ORDER BY jovenes DESC LIMIT 11";
$sql2  = "SELECT diagnostico, COUNT( DISTINCT(id_historia) ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) <60 )) GROUP BY diagnostico ORDER BY adultos DESC LIMIT 11";

$sql3  = "SELECT diagnostico, COUNT( DISTINCT(id_historia) ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) <99 )) GROUP BY diagnostico ORDER BY mayores DESC LIMIT 11";

$res = $mysqli->query($query);	

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['adultos']='';
	$row['mayores']='';
	$data[] = $row;
}

$res = $mysqli->query($sql2);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['jovenes']='';
	$row['mayores']='';
	$data[] = $row;
}


$res = $mysqli->query($sql3);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['jovenes']='';
	$row['adultos']='';
	$data[] = $row;
}


$results = ["sEcho" => 1,

"iTotalRecords" => count($data),

"iTotalDisplayRecords" => count($data),

"aaData" => $data ];

mysqli_close($mysqli);

echo json_encode($results);

?>