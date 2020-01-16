<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['nivel'] =='a'){
	$fechaGuardada = $_SESSION["ultimoAcceso"];
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
//comparamos el tiempo transcurrido
	if($tiempo_transcurrido < 0 || $tiempo_transcurrido > 599){
		include '../../../src/php/enlace.php';
$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$enlace->set_charset('utf8');
if (!$enlace) die("Conexión fallida: " . mysqli_connect_error());
$result = mysqli_query($enlace, "SELECT max(id_sesion) as id FROM sesion WHERE usuario = '$_SESSION[usuario]'");
$row = mysqli_fetch_assoc($result);
$query = mysqli_query($enlace, "UPDATE sesion set fin ='$ahora', minutos=TIMESTAMPDIFF(MINUTE,inicio,fin) where id_sesion = '$row[id]' and usuario like '$_SESSION[usuario]'");
session_unset($_SESSION['usuario']);
session_unset($_SESSION['nivel']);
session_unset($_SESSION['trabajador']);
session_unset($_SESSION['ultimoAcceso']);
session_destroy();
header("Location:../../../",TRUE,301);
mysqli_close($enlace);
	}
	else
		$_SESSION["ultimoAcceso"] = $ahora;
	
	if(empty($_POST['tipo_reporte']))
	die("<h2 style='text-align: center; margin-top: 12%;'> Parece que quieres consultar una estadística, de preferencia utiliza los campos del formulario</h2><h4 style='text-align:center;'><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
	require('../../../src/php/conexion.php');
	if($_POST['tipo_reporte']=='G'){
		require('../../../src/fpdf/fpdf.php');
		class PDF extends FPDF
		{
			function Header()
			{
				$this->Image('../../../src/img/membrete.png',12.5,15,-200);
				$this->Ln(15);				
		$this->SetFont('Times','B',14);
		$titulo=utf8_decode('Reporte de Estadísticas General del Servicio');
		$this->Cell(0,30,$titulo,0,1,'C');
			}
			function Footer()
			{
				$this->SetY(-15);
				$this->SetFont('Arial','I',8);
				$pie = utf8_decode('Servicio Odontólogico "Kléber Ramírez" ');
				$this->Cell(0,10,$pie.$this->PageNo().'/{nb}',0,0,'C');
			}
		}
		$pdf = new PDF('P', 'mm', 'A4');
		$pdf->AliasNbPages();
		$pdf->SetMargins(20, 25 , 20);
		$pdf->SetAutoPageBreak(true,25);
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
		$pdf->Cell(0,5,'',0,1);
		$pdf->Ln(2);
				$pdf->SetFont('Arial','',12);
				$pdf->setFillColor(240,240,240);
		$mysqli = getConnexion();
		$fecha = date('d - m - Y');
		$pdf->SetX(153 , false);
		$pdf->Cell(42,8,'Fecha: '.$fecha,0,1,'R');
				$pdf->Ln(1);
		$tafiliados=utf8_decode('Estudiantes afiliados al servicio:  ');
		$query  = 'select count(id_historia) as historias from estudiante';
		$res = $mysqli->query($query);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$afiliados=$row['historias'];
		$pdf->Cell(175,10,$tafiliados.' '.$afiliados,1,1,'L',1);
		$pdf->Ln(1);
		$tantecedente=utf8_decode('son pacientes Saludables, sin antecedentes');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Saludable')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pre=utf8_decode('De los cuales: el ');
		$pdf->Cell(175,5.5,$pre.$antecedente.'% '.$tantecedente,1,1,'L');

		$tantecedente=utf8_decode('padece Anemia');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Anemia')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		
		$tantecedente=utf8_decode('son alergicos a la Anestesia');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Anestesia')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('padece Apretamiento Dentario');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ApretamientoDentario')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('sufre de Asma');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Asma')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('son alergicos a la Aspirina');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Aspirina')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('asiste a Consultas Médicas');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ConsultasMédicas')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('consume Pastillas A.C.');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ConsumodePastillasA.C.')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('consume Tabaco');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ConsumodeTabaco')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('padece Defícit de Vitamina K');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'DefícitdeVitaminaK')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('sufre de Diabetes');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Diabetes')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('padece Diversidad Funcional');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'DiversidadFuncional')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('en situación de Embarazo');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Embarazo')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('padece Enfermedades Venéreas');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'EnfermedadesVenéreas')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('sufre de Fiebre Reumática');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'FiebreReumática')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('padece Hemofilia');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Hemofilia')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('han padecido Hepatitís');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Hepatitís')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('padece Herpes o Aftas frecuentes');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'HerpesoAftasfrecuentes')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('han recibido Intervención Quirúrgica');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'IntervenciónQuirúrgica')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('son alergicos al Iodo');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Iodo')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('sufre de Leucemia');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Leucemia')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('padece Limitación para abrir/cerrar la boca');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Lim.paraabrir/cerrarlaboca')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('padece Otras Alergias');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'OtrasAlergias')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('son alergicos a la Penicilina');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Penicilina')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('sufre de Problemas del Corazón');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'ProblemasdelCorazón')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('con problemas de Respiración Bucal');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'RespiraciónBucal')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('padece Ruidos al abrir/cerrar la boca');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Ruidosalabrir/cerrarlaboca')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('sufre de Sangrado Excesivo al Cortarse');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'SangradoExcesivoalCortarse')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('sufre de la Tiroides');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'Tiroides')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('ha recibido Transfusión Sanguínea');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'TransfusiónSanguínea')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
		$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.',',1,1,'L');
		$tantecedente=utf8_decode('sufre de Ulcera Gástrica');
		$sql = "select count(id_historia) as estudiantes from estudiante t1 where exists(select cedula from persona t2 where t2.cedula = t1.cedula) and exists( select nombre_antecedente from antecedente t3 where t3.id_historia = t1.id_historia and nombre_antecedente like 'UlceraGástrica')";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$antecedente=$row['estudiantes'];
				$antecedente= round(($antecedente*100)/$afiliados);
		$pdf->Cell(175,5.5,$antecedente.'% '.$tantecedente.'.',1,1,'L');
		$pdf->SetMargins(20, 25 , 20);
						$pdf->Ln(3);
		$query  = "select count(cedula) as mujeres from estudiante t1 where exists( select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select id_historia from consulta t3 where t3.id_historia = t1.id_historia)";
		$res = $mysqli->query($query);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$mujeres = $row['mujeres'];
		$query  = "select count(cedula) as hombres from estudiante t1 where exists( select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select id_historia from consulta t3 where t3.id_historia = t1.id_historia)";
		$res = $mysqli->query($query);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$hombres = $row['hombres'];
			$atendidos=$mujeres+$hombres;
		$query  = "select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) as edad from persona t1 where exists( select id_historia, cedula from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from consulta t3 where t3.id_historia = t2.id_historia)) and genero like 'H'";
		$res = $mysqli->query($query);
		$hjovenes=0;$hadultos=0;$hmayores=0;
		while ($row = $res->fetch_array(MYSQLI_ASSOC)){
			if($row['edad']> 15 && $row['edad']<26)
				$hjovenes+=1;
			if($row['edad']> 25 && $row['edad']<60)
				$hadultos+=1;
			if($row['edad']> 59)
				$hmayores+=1;
		}
		$hjovenes= round(($hjovenes*100)/$atendidos);
		$hadultos= round(($hadultos*100)/$atendidos);
		$hmayores= round(($hmayores*100)/$atendidos);
		$query  = "select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) as edad from persona t1 where exists( select id_historia, cedula from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from consulta t3 where t3.id_historia = t2.id_historia)) and genero like 'M'";
		$res = $mysqli->query($query);
		$mjovenes=0;$madultos=0;$mmayores=0;
		while ($row = $res->fetch_array(MYSQLI_ASSOC)){
			if($row['edad']> 15 && $row['edad']<26)
				$mjovenes+=1;
			if($row['edad']> 25 && $row['edad']<60)
				$madultos+=1;
			if($row['edad']> 59)
				$mmayores+=1;
		}
		$mjovenes= round(($mjovenes*100)/$atendidos);
		$madultos= round(($madultos*100)/$atendidos);
		$mmayores= round(($mmayores*100)/$atendidos);
		$tatendidos=utf8_decode('Estudiantes atendidos:  ');
		$pdf->MultiCell(175,10,$tatendidos.' '.$atendidos,1,1,'L',1);
		$pdf->Ln(1);
		$hombres= round(($hombres*100)/$atendidos);
		$mujeres= round(($mujeres*100)/$atendidos);
		$pdf->Cell(175,8,$hombres.'% Hombres :: '.'Jovenes (16 ~ 25) '.$hjovenes.'%, '.'Adultos (26 ~ 59) '.$hadultos.'%, '.'Adulto Mayor (60+) '.$hmayores.'% .',1,1,'L');
		$pdf->Cell(175,8,$mujeres.'%   Mujeres :: '.'Jovenes (16 ~ 25) '.$mjovenes.'%, '.'Adultos (26 ~ 59) '.$madultos.'%, '.'Adulto Mayor (60+) '.$mmayores.'% .',1,1,'L');
		$pdf->SetMargins(20, 25 , 20);	
		$pdf->Ln(3);
		$titulo=utf8_decode('Consultas registradas:');
		$sql = "select count(id_consulta) as registradas from consulta";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$consultas=$row['registradas'];
		$pdf->Cell(175,10,$titulo.' '.$consultas,1,1,'L',1);
		$pdf->Ln(1);
		$titulo=utf8_decode('[Veces]. Tipo de Atención prestada.');
		$pdf->Cell(175,8,$titulo,1,1,'L');
		$query  = "SELECT tipo_consulta, COUNT( tipo_consulta ) AS veces FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) as edad from persona t3 where t3.cedula = t2.cedula)) GROUP BY tipo_consulta ORDER BY veces DESC";
		$res = $mysqli->query($query);
		$i=1;
		$pdf->setFillColor(255,255,255);
		while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
		$tipo_consulta=utf8_decode($row['tipo_consulta']);
		$pdf->MultiCell(175,6,'      ['.$row['veces'].']. '.$tipo_consulta.'.',1,1,'L');
		$i+=1;
		}
		$titulo=utf8_decode('A continuación los once diagnósticos más frecuentes:');
		$pdf->Cell(175,8,$titulo,1,1,'R');
		$query  = "SELECT diagnostico, COUNT( diagnostico ) AS diag FROM  consulta t1 where exists(select cedula from estudiante t2 where t2.id_historia = t1.id_historia and exists( select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) as edad from persona t3 where t3.cedula = t2.cedula)) GROUP BY diagnostico ORDER BY diag DESC LIMIT 11";
		$res = $mysqli->query($query);
		$i=1;
		while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
		$diagnostico=utf8_decode($row['diagnostico']);
		$pdf->MultiCell(175,6,'      ['.$i.']. '.$diagnostico.'.',1,1,'L');
		$i+=1;
		}
		$pdf->setFillColor(240,240,240);
		$pdf->Ln(3);
		$titulo=utf8_decode('Preescripciones médicas expedidas:');
		$sql = "select count(id_tratamiento) as otorgadas from tratamiento";
		$res = $mysqli->query($sql);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$consultas=$row['otorgadas'];
		$pdf->Cell(175,10,$titulo.' '.$consultas,1,1,'L',1);
		$titulo = utf8_decode('Estadísticas General del Servicio.pdf');
		$pdf->Output($dest='D', $name=$titulo, $isUTF8=false);
		mysqli_close($mysqli);
	}
	if($_POST['tipo_reporte']=='E'){
		$mysqli = getConnexion();
		if($_POST['e1']=='genero' && $_POST['e2']==    'atendidos'){
			$query  = "select count(cedula) as mujeres from estudiante t1 where exists( select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M') and exists( select id_historia from consulta t3 where t3.id_historia = t1.id_historia)";
			$res = $mysqli->query($query);
			$row = $res->fetch_array(MYSQLI_ASSOC);
			$mujeres = $row['mujeres'];
			$query  = "select count(cedula) as hombres from estudiante t1 where exists( select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H') and exists( select id_historia from consulta t3 where t3.id_historia = t1.id_historia)";
			$res = $mysqli->query($query);
			$row = $res->fetch_array(MYSQLI_ASSOC);
			$hombres = $row['hombres'];
			$t=$mujeres+$hombres;
			echo "<div class='blanco'><img src='../../../src/img/man.png' > Hombres: $hombres  <img src='../../../src/img/woman.png' style='margin-left: 60px;'>  Mujeres: $mujeres </div><br><div class='blanco' style='margin-top:5%;'> Total de estudiantes atendidos: $t</div>";
		}
		if($_POST['e1']==  'edad' && $_POST['e2']==    'atendidos'){
			$query  = 'select TIMESTAMPDIFF(YEAR,fecha,CURDATE()) as edad from persona t1 where exists( select id_historia, cedula from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from consulta t3 where t3.id_historia = t2.id_historia))';
						$res = $mysqli->query($query);
			$a=0;$b=0;$c=0;
			while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
				if($row['edad']> 15 && $row['edad']<26)
					$a+=1;
				if($row['edad']> 25 && $row['edad']<60)
					$b+=1;
				if($row['edad']> 59)
					$c+=1;
			}
			$t=$a+$b+$c;
			echo "
			<img src='../../../src/img/jovenes.png' style='margin-left: 5%; margin-right: 5%; width='50px' height='75px'>
			<img src='../../../src/img/adultos.png' style='margin-left: 5%; margin-right: 5%; width='50px' height='75px'>
			<img src='../../../src/img/mayores.png' style='margin-left: 5%; margin-right: 5%; width='50px' height='75px'>
			<br>
			<bdi class='blanco' style='margin-left: 4%; margin-right: 4%; font-size: 1rem;'> Jovenes (16 ~ 25): $a </bdi> <bdi class='blanco' style='margin-left: 6%; margin-right: 5%; font-size: 1rem;'> Adultos (26 ~ 59): $b </bdi> <bdi class='blanco' style='margin-left: 5%; margin-right: 3%; font-size: 1rem;'> Adulto Mayor (60+): $c </bdi><br><div class='blanco' style='margin-top:5%;'> Total de estudiantes atendidos: $t</div>";
		}
		if($_POST['e1']=='genero' && $_POST['e2']=='preescripcion'){
			$query  = "select count(cedula) as mujeres from estudiante t1 where exists( select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'M' and exists( select id_historia from tratamiento t3 where t3.id_historia = t1.id_historia))";
			$res = $mysqli->query($query);
			$row = $res->fetch_array(MYSQLI_ASSOC);
			$mujeres = $row['mujeres'];
			$query  = "select count(cedula) as hombres from estudiante t1 where exists( select cedula from persona t2 where t2.cedula = t1.cedula and genero like 'H' and exists( select id_historia from tratamiento t3 where t3.id_historia = t1.id_historia))";
			$res = $mysqli->query($query);
			$row = $res->fetch_array(MYSQLI_ASSOC);
			$hombres = $row['hombres'];
			if(is_null($mujeres))
				$mujeres=0;
			if(is_null($hombres))
				$hombres=0;
			$t=$mujeres+$hombres;
			echo "<div class='blanco'><img src='../../../src/img/man.png' > Hombres: $hombres  <img src='../../../src/img/woman.png' style='margin-left: 60px;'>  Mujeres: $mujeres </div><br><div class='blanco' style='margin-top:5%;'> Total de estudiantes que han<br> recibido preescripción médica: $t</div>";
				}
		if($_POST['e1']==  'edad' && $_POST['e2']=='preescripcion'){
			$query='SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Jovenes from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from tratamiento t3 where t3.id_historia = t2.id_historia)) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 15 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 26';
						$res = $mysqli->query($query);
						$row = $res->fetch_array(MYSQLI_ASSOC);
			$a=$row['Jovenes'];
			$query='SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Adultos from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from tratamiento t3 where t3.id_historia = t2.id_historia)) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 25 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 60';
						$res = $mysqli->query($query);
						$row = $res->fetch_array(MYSQLI_ASSOC);
			$b=$row['Adultos'];
			$query='SELECT count(TIMESTAMPDIFF(YEAR,fecha,CURDATE())) as Mayores from persona t1 where exists( select cedula from estudiante t2 where t2.cedula = t1.cedula and exists( select id_historia from tratamiento t3 where t3.id_historia = t2.id_historia)) and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) > 59 and TIMESTAMPDIFF(YEAR,fecha,CURDATE()) < 99';
						$res = $mysqli->query($query);
						$row = $res->fetch_array(MYSQLI_ASSOC);
			$c=$row['Mayores'];
			$t=$a+$b+$c;
			echo "
			<img src='../../../src/img/jovenes.png' style='margin-left: 5%; margin-right: 5%; width='50px' height='75px'>
			<img src='../../../src/img/adultos.png' style='margin-left: 5%; margin-right: 5%; width='50px' height='75px'>
			<img src='../../../src/img/mayores.png' style='margin-left: 5%; margin-right: 5%; width='50px' height='75px'>
			<br>
			<bdi class='blanco' style='margin-left: 4%; margin-right: 4%; font-size: 1rem;'> Jovenes (16 ~ 25): $a </bdi> <bdi class='blanco' style='margin-left: 6%; margin-right: 5%; font-size: 1rem;'> Adultos (26 ~ 59): $b </bdi> <bdi class='blanco' style='margin-left: 5%; margin-right: 3%; font-size: 1rem;'> Adulto Mayor (60+): $c </bdi><br><div class='blanco' style='margin-top:5%;'> Total de estudiantes que han <br>recibido preescripción médica: $t</div>";
				}
		mysqli_close($mysqli);
	}
}
else
{
	echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";
	header('Refresh: 6; http://odontologia.uptm/SIWGO'); //redirect
}?>