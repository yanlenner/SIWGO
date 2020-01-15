<?php 
require('conexion.php');
$mysqli = getConnexion();
$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Atención de Emergencia'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Atención de Emergencia'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Atención de Emergencia'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Atención de Emergencia';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}

$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Administración de Medicamento'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Administración de Medicamento'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Administración de Medicamento'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Administración de Medicamento';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}

$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Cirugia Dental'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Cirugia Dental'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Cirugia Dental'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Cirugia Dental';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}

$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Control Dental Preventivo'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Control Dental Preventivo'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Control Dental Preventivo'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Control Dental Preventivo';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}

$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Endodoncia'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Endodoncia'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Endodoncia'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Endodoncia';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}

$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Operatorias Dental'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Operatorias Dental'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Operatorias Dental'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Operatorias Dental';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}

$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Profilaxis'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Profilaxis'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Profilaxis'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Profilaxis';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}


$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Radiagrofia Panóramica'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Radiagrofia Panóramica'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Radiagrofia Panóramica'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Radiagrofia Panóramica';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}


$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Raspado y Alisado'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Raspado y Alisado'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Raspado y Alisado'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Raspado y Alisado';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}


$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Sellantes de Fosa y Fisura'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Sellantes de Fosa y Fisura'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Sellantes de Fosa y Fisura'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Sellantes de Fosa y Fisura';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}

$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Topificación de Flúor'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Topificación de Flúor'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Topificación de Flúor'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Topificación de Flúor';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}


$sql = "SELECT COUNT( diagnostico ) AS jovenes FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26)) and tipo_consulta = 'Tratectomia'"; 

$sql2 = "SELECT COUNT( diagnostico ) AS adultos FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60)) and tipo_consulta = 'Tratectomia'"; 

$sql3 = "SELECT COUNT( diagnostico ) AS mayores FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) from persona t3 where t3.cedula = t2.cedula and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99)) and tipo_consulta = 'Tratectomia'"; 

$res = $mysqli->query($sql);	
$res2 = $mysqli->query($sql2);
$res3 = $mysqli->query($sql3);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['atencion']=' Tratectomia';
	$row2=$res2->fetch_array(MYSQLI_ASSOC);
	$row['adultos']=$row2['adultos'];
	$row3=$res3->fetch_array(MYSQLI_ASSOC);
	$row['mayores']=$row3['mayores'];
	$row['total']=$row['jovenes']+$row['adultos']+$row['mayores'];
	$data[] = $row;
}

$results = ["sEcho" => 1,

"iTotalRecords" => COUNT($data),

"iTotalDisplayRecords" => COUNT($data),

"aaData" => $data ];

mysqli_close($mysqli);

echo json_encode($results);

?>