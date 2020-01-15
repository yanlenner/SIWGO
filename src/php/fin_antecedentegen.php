<?php
require('conexion.php');
$mysqli = getConnexion();
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Saludable')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Saludable')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes Saludables, sin antecedentes';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Anemia')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Anemia')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Anemia';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Anestesia')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Anestesia')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes alergicos a la Anestesia';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ApretamientoDentario')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ApretamientoDentario')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Apretamiento Dentario';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Asma')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Asma')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Asma';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Aspirina')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Aspirina')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes alergicos a la Aspirina';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ConsultasMédicas')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ConsultasMédicas')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que asisten a Consultas Médicas';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ConsumodePastillasA.C.')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ConsumodePastillasA.C.')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que consumen Pastillas A.C.';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ConsumodeTabaco')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ConsumodeTabaco')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que consumen Tabaco';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'DefícitdeVitaminaK')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'DefícitdeVitaminaK')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Defícit de Vitamina K';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Diabetes')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Diabetes')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Diabetes';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'DiversidadFuncional')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'DiversidadFuncional')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Diversidad Funcional';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Embarazo')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Embarazo')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes en situación de Embarazo';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'EnfermedadesVenéreas')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'EnfermedadesVenéreas')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Enfermedades Venéreas';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'FiebreReumática')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'FiebreReumática')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Fiebre Reumática';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Hemofilia')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Hemofilia')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Hemofilia';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Hepatitís')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Hepatitís')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que han padecido Hepatitís';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'HerpesoAftasfrecuentes')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'HerpesoAftasfrecuentes')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Herpes o Aftas frecuentes';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'IntervenciónQuirúrgica')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'IntervenciónQuirúrgica')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que han recibido Intervención Quirúrgica';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Iodo')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Iodo')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes alergicos al Iodo';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Leucemia')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Leucemia')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Leucemia';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Lim.paraabrir/cerrarlaboca')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Lim.paraabrir/cerrarlaboca')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Limitación para abrir/cerrar la boca';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'OtrasAlergias')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'OtrasAlergias')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Otras Alergias';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Penicilina')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Penicilina')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes alergicos a la Penicilina';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ProblemasdelCorazón')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ProblemasdelCorazón')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Problemas del Corazón';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'RespiraciónBucal')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'RespiraciónBucal')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes con problemas de Respiración Bucal';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Ruidosalabrir/cerrarlaboca')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Ruidosalabrir/cerrarlaboca')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que padecen Ruidos al abrir/cerrar la boca';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'SangradoExcesivoalCortarse')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'SangradoExcesivoalCortarse')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Sangrado Excesivo al Cortarse';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Tiroides')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Tiroides')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de la Tiroides';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'TransfusiónSanguínea')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'TransfusiónSanguínea')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que han recibido Transfusión Sanguínea';
	$row['mujeres']=$mujeres['mujeres'];
	$row['total']=$row['hombres']+$mujeres['mujeres'];
	$data[] = $row;
}
$sql = "select count(id_historia) as hombres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'UlceraGástrica')";
$sql2 = "select count(id_historia) as mujeres from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'UlceraGástrica')";
$res = $mysqli->query($sql);
$res2 = $mysqli->query($sql2);
$mujeres=$res2->fetch_array(MYSQLI_ASSOC);
while($row = $res->fetch_array(MYSQLI_ASSOC)){
	$row['nombre_antecedente']=' Pacientes que sufren de Ulcera Gástrica';
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