<?php 
require('conexion.php');

$mysqli = getConnexion();


$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Radiología e Imagenologia') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Radiología e Imagenologia') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Radiología e Imagenologia') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Radiología e Imagenologia';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}


$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Administración') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Administración') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Administración') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Administración';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}



$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Agroalimentación') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Agroalimentación') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Agroalimentación') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Agroalimentación';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}



$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Construcción Civil') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Construcción Civil') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Construcción Civil') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Construcción Civil';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}


$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Contaduría Pública') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Contaduría Pública') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Contaduría Pública') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Contaduría Pública';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Enfermería') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Enfermería') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Enfermería') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Enfermería';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}


$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Fonoaudiología') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Fonoaudiología') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Fonoaudiología') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Fonoaudiología';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}


$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Geociencias') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Geociencias') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Geociencias') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Geociencias';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Histocitotecnología') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Histocitotecnología') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Histocitotecnología') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Histocitotecnología';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Historia') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Historia') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Historia') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Historia';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Informática') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Informática') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Informática') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Informática';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Nutrición y Dietetica') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Nutrición y Dietetica') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Nutrición y Dietetica') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Nutrición y Dietetica';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}


$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Psicología Social') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Psicología Social') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Psicología Social') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Psicología Social';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}



$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Seguridad Alimentaria y Cultura Nutricional') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Seguridad Alimentaria y Cultura Nutricional') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Seguridad Alimentaria y Cultura Nutricional') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Seguridad Alimentaria y Cultura Nutricional';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Turismo') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Turismo') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'PNF en Turismo') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' PNF en Turismo';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'TSU en Manejo de Emergencias y Acción Contra Desastres') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['Jovenes'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'TSU en Manejo de Emergencias y Acción Contra Desastres') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60";
$res = $mysqli->query($query);		
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['Adultos'];

$query  = "SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and t2.carrera = 'TSU en Manejo de Emergencias y Acción Contra Desastres') and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99";
$res = $mysqli->query($query);		


while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['carrera']=' TSU en Manejo de Emergencias y Acción Contra Desastres';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;

}


$results = ["sEcho" => 1,

"iTotalRecords" => count($data),

"iTotalDisplayRecords" => count($data),

"aaData" => $data ];

mysqli_close($mysqli);

echo json_encode($results);

?>