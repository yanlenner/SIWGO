<?php 
require('conexion.php');
$mysqli = getConnexion();

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Administración' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Administración' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Administración';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Agroalimentación' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Agroalimentación' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Agroalimentación';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Construcción Civil' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Construcción Civil' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Construcción Civil';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Contaduría Pública' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Contaduría Pública' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Contaduría Pública';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Enfermería' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Enfermería' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Enfermería';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Fonoaudiología' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Fonoaudiología' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Fonoaudiología';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Geociencias' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Geociencias' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Geociencias';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Histocitotecnología' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Histocitotecnología' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Histocitotecnología';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Historia' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Historia' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Historia';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Informática' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Informática' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Informática';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Nutrición y Dietetica' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Nutrición y Dietetica' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Nutrición y Dietetica';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Psicología Social' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Psicología Social' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Psicología Social';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Radiología e Imagenologia' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Radiología e Imagenologia' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Radiología e Imagenologia';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Seguridad Alimentaria y Cultura Nutricional' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Seguridad Alimentaria y Cultura Nutricional' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Seguridad Alimentaria y Cultura Nutricional';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}


$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'PNF en Turismo' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'PNF en Turismo' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Turismo';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}

$sql  = "select count(cedula) as hombres from estudiante t1 where carrera = 'TSU en Manejo de Emergencias y Acción Contra Desastres' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H')"; 
$sql2 = "select count(cedula) as mujeres from estudiante t1 where carrera = 'TSU en Manejo de Emergencias y Acción Contra Desastres' and exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M')"; 
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);

$mujeres=$res2->fetch_array(MYSQLI_ASSOC);

while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' TSU en Manejo de Emergencias y Acción Contra Desastres';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;

}


$results = ["sEcho" => 1,

"iTotalRecords" => count($data),

"iTotalDisplayRecords" => count($data),

"aaData" => $data ];

mysqli_close($mysqli);

echo json_encode($results);

?>