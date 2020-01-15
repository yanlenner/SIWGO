<?php
require('conexion.php');
$mysqli = getConnexion();
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Saludable')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Saludable')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Saludable')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes Saludables, sin antecedentes';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Anemia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Anemia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Anemia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Anemia';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Anestesia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Anestesia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Anestesia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes alergicos a la Anestesia';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ApretamientoDentario')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ApretamientoDentario')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ApretamientoDentario')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Apretamiento Dentario';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Asma')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Asma')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Asma')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Asma';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Aspirina')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Aspirina')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Aspirina')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes alergicos a la Aspirina';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ConsultasMédicas')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ConsultasMédicas')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ConsultasMédicas')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que asisten a Consultas Médicas';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ConsumodePastillasA.C.')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ConsumodePastillasA.C.')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ConsumodePastillasA.C.')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que consumen Pastillas A.C.';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ConsumodeTabaco')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ConsumodeTabaco')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ConsumodeTabaco')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que consumen Tabaco';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'DefícitdeVitaminaK')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'DefícitdeVitaminaK')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'DefícitdeVitaminaK')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Defícit de Vitamina K';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Diabetes')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Diabetes')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Diabetes')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Diabetes';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'DiversidadFuncional')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'DiversidadFuncional')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'DiversidadFuncional')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Diversidad Funcional';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Embarazo')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Embarazo')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Embarazo')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes en situación de Embarazo';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'EnfermedadesVenéreas')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'EnfermedadesVenéreas')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'EnfermedadesVenéreas')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Enfermedades Venéreas';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'FiebreReumática')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'FiebreReumática')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'FiebreReumática')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Fiebre Reumática';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Hemofilia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Hemofilia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Hemofilia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Hemofilia';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Hepatitís')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Hepatitís')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Hepatitís')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que han padecido Hepatitís';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'HerpesoAftasfrecuentes')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'HerpesoAftasfrecuentes')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'HerpesoAftasfrecuentes')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Herpes o Aftas frecuentes';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'IntervenciónQuirúrgica')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'IntervenciónQuirúrgica')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'IntervenciónQuirúrgica')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que han recibido Intervención Quirúrgica';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Iodo')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Iodo')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Iodo')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes alergicos al Iodo';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Leucemia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Leucemia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Leucemia')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Leucemia';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Lim.paraabrir/cerrarlaboca')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Lim.paraabrir/cerrarlaboca')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Lim.paraabrir/cerrarlaboca')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Limitación para abrir/cerrar la boca';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'OtrasAlergias')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'OtrasAlergias')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'OtrasAlergias')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Otras Alergias';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Penicilina')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Penicilina')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Penicilina')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes alergicos a la Penicilina';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ProblemasdelCorazón')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ProblemasdelCorazón')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'ProblemasdelCorazón')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Problemas del Corazón';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'RespiraciónBucal')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'RespiraciónBucal')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'RespiraciónBucal')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes con problemas de Respiración Bucal';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Ruidosalabrir/cerrarlaboca')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Ruidosalabrir/cerrarlaboca')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Ruidosalabrir/cerrarlaboca')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Ruidos al abrir/cerrar la boca';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'SangradoExcesivoalCortarse')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'SangradoExcesivoalCortarse')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'SangradoExcesivoalCortarse')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Sangrado Excesivo al Cortarse';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Tiroides')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Tiroides')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'Tiroides')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de la Tiroides';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'TransfusiónSanguínea')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'TransfusiónSanguínea')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'TransfusiónSanguínea')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que han recibido Transfusión Sanguínea';
	$row['jovenes']=$jovenes;
	$row['adultos']=$adultos;
	$row['total']=$jovenes+$adultos+$row['mayores'];
	$data[] = $row;
}
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as jovenes from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'UlceraGástrica')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$jovenes = $row['jovenes'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as adultos from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'UlceraGástrica')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60 ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$adultos = $row['adultos'];
$query  = "select count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as mayores from persona t1 where exists( select id_historia from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from antecedente t3 where t3.id_historia = t2.id_historia and t3.nombre_antecedente like 'UlceraGástrica')) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99 ";
$res = $mysqli->query($query);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Ulcera Gástrica';
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