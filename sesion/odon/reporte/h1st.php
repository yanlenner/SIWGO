<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['nivel'] =='o'){
$fechaGuardada = $_SESSION["ultimoAcceso"];
$ahora = date("Y-n-j H:i:s");
$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
//comparamos el tiempo transcurrido
if($tiempo_transcurrido < 0 || $tiempo_transcurrido > 599)
{
//si pasaron 10 minutos o más
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
function fechaCastellano ($fecha) {
$fecha = substr($fecha, 0, 10);
$numeroDia = date('d', strtotime($fecha));
$dia = date('l', strtotime($fecha));
$mes = date('F', strtotime($fecha));
$anio = date('Y', strtotime($fecha));
$dias_ES = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
$dias_EN = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
$nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$meses_EN = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$nombreMes = str_replace($meses_EN, $meses_ES, $mes);
return $nombredia.' '.$numeroDia.' de '.$nombreMes.' de '.$anio;
}
function basico($numero) {
$valor = array ("uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve",
"diez", "once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", "dieciocho", "diecinueve",
"veinte", "veintiún", "veintidós", "veintitrés", "veinticuatro", "veinticinco", "veintiséis", "veintisiete", "veintiocho", "veintinueve");
return $valor[$numero - 1];
}
function decenas($n) {
$decenas = array (30=>'treinta',40=>'cuarenta',50=>'cincuenta',60=>'sesenta',
70=>'setenta',80=>'ochenta',90=>'noventa');
if( $n <= 29) return basico($n);
$x = $n % 10;
if ( $x == 0 ) {
return $decenas[$n];
} else return $decenas[$n - $x].' y '. basico($x);
}
function convertir($n) {
switch (true) {
case ( $n >= 1 && $n <= 29) : return basico($n); break;
case ( $n >= 30 && $n < 100) : return decenas($n); break;
}
}
date_default_timezone_set('America/Caracas');
require('../../../src/fpdf/fpdf.php');
require('../../../src/php/conexion.php');
class PDF extends FPDF
{
// Page header
function Header()
{
// Logo
$this->Ln(1);
}
// Page footer
function Footer()
{
// Position at 1.5 cm from bottom
$this->SetY(-15);
// Arial italic 8
$this->SetFont('Arial','I',8);
// Page number
$pie = utf8_decode('Servicio Odontólogico "Kléber Ramírez" ');
$this->Cell(0,10,$pie.$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->SetMargins(20, 25 , 20);
$pdf->SetAutoPageBreak(true, 30);
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Image('../../../src/img/membrete.png',12.5,15,-200);
$pdf->Ln(9);
if(empty($_POST['ci']))
	die("<h2 style='text-align: center; margin-top: 12%;'> Parece que quieres generar una historia clínica, regresa después de haber llenado los campos del formulario</h2><h4 style='text-align:center;'><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
$mysqli = getConnexion();
$search = $mysqli->real_escape_string($_POST['ci']);
$query = "SELECT id_historia FROM estudiante WHERE cedula = '$search' ";
$query2 = "SELECT nombre, apellido, cedula, TIMESTAMPDIFF(YEAR,fecha,CURDATE()) AS edad, genero  FROM persona WHERE cedula = '$_POST[ci]' ";
$query3 = "SELECT carrera, carnet, aspecto, hallazgo, observacion, respuesta FROM estudiante WHERE cedula = '$_POST[ci]' ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$res2 = $mysqli->query($query2);
$row2 = $res2->fetch_array(MYSQLI_ASSOC);
$res3 = $mysqli->query($query3);
$row3 = $res3->fetch_array(MYSQLI_ASSOC);
$historia = $row['id_historia'];
$antecedente = $mysqli->query("SELECT nombre_antecedente FROM antecedente WHERE id_historia = '$historia'");
$consulta = $mysqli->query("SELECT id_consulta, pieza, DATE_FORMAT(fecha, '%d-%m-%Y ')  as fecha2, tipo_consulta, diagnostico, cedula FROM consulta WHERE id_historia = '$historia' order by fecha asc");
$tratamiento = $mysqli->query("SELECT id_consulta, indicaciones, medicamento, duracion FROM tratamiento WHERE id_historia = '$historia'");
$pacnom = utf8_decode($row2['nombre']);
$pacape = utf8_decode($row2['apellido']);
$cedula = utf8_decode($row2['cedula']);
$edad = utf8_decode($row2['edad']);
$carrera = utf8_decode($row3['carrera']);
$carnet = utf8_decode($row3['carnet']);
$aspecton = utf8_decode($row3['aspecto']);
$hallazgon = utf8_decode($row3['hallazgo']);
$observacion = utf8_decode($row3['observacion']);
$respuestan = utf8_decode($row3['respuesta']);
if($row2['genero']=='H')
$genero='l Paciente';
else
$genero=' la Paciente';
$pdf->Ln(5);
$titulo=utf8_decode('Historia Clínica');
$pdf->Cell(0,6,$titulo,0,1,'C');
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,7,'',0,1);
$pdf->SetFont('Arial','',12);
$texto = utf8_decode('Fecha: ');
$pdf->MultiCell(170,6,$texto.utf8_decode(fechaCastellano(date('d-m-Y'))),1);
$texto = utf8_decode('No de Historia: ');
$pdf->Cell(0,-6,$texto.$historia,0,1,'R');
$pdf->Ln(12);
$pdf->SetFont('Times','B',14);
$titulo=utf8_decode('Datos Personales de');
$pdf->Cell(0,6,$titulo.$genero,0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->SetTextColor(0,0,0);
$texto = utf8_decode('Nombres: ');
$pdf->Cell(190,7,'',0,1);
$pdf->MultiCell(170,6,$texto.$pacnom,1);
$texto = utf8_decode('Cédula de Identidad: ');
$pdf->Cell(0,-6,$texto.$cedula,0,1,'R');
$pdf->Ln(6);
$texto = utf8_decode('Apellidos: ');
$pdf->MultiCell(170,6,$texto.$pacape,1);
$texto = utf8_decode('No de Carnet Estudiantil: ');
$pdf->Cell(0,-6,$texto.$carnet,0,1,'R');
$pdf->Ln(6);
$texto = utf8_decode('Carrera: ');
$pdf->MultiCell(170,6,$texto.$carrera,1);
$texto = utf8_decode('Edad: ');
$edad2= convertir($edad);
$edad2= utf8_decode($edad2);
$pdf->Cell(0,-6,$texto.$edad2.'('.$edad.')',0,1,'R');
$pdf->Ln(12);
$aspecto = utf8_decode('Aspecto extraoral:');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(170,6,$aspecto);
$pdf->SetFont('Arial','',12);
$pdf->Ln(6);
$pdf->MultiCell(170,6,'   '.$aspecton,1,1);
$pdf->Cell(0,2,'',0,1);
$hallazgo = utf8_decode('Hallazgos clínicos bucales de importancia:');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,$hallazgo,0,0,'R');
$pdf->SetFont('Arial','',12);
$pdf->Ln(6);
$pdf->MultiCell(170,6,'   '.$hallazgon,1,1);
$pdf->Cell(0,2,'',0,1);
$respuesta = utf8_decode('Respuestas positivas:');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,$respuesta,0,0,'L');
$pdf->SetFont('Arial','',12);
$pdf->Ln(6);
$pdf->MultiCell(170,6,'   '.$respuestan,1,1);
$pdf->Cell(0,2,'',0,1);
$observa = utf8_decode('Observaciones percibidas del paciente:');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,$observa,0,0,'R');
$pdf->SetFont('Arial','',12);
$pdf->Ln(6);
$pdf->MultiCell(170,6,'   '.$observacion,1,1);
$pdf->Ln(7);
$pdf->SetFont('Times','B',14);
$titulo=utf8_decode('Antecedentes Médicos');
$pdf->Cell(0,6,$titulo,0,1,'C');
$pdf->SetFont('Arial','',12);
$firstarrow='izquierda';
$recarga=0;
$t5='a';
while($a = $antecedente->fetch_assoc()){
if($t5=='a'){
$pdf->setFillColor(249,249,249);
$t5='b';
}
if($t5=='c'){
$pdf->setFillColor(242,242,242);
$t5='a';
}
$ant=$a['nombre_antecedente'];
if($ant=='Saludable'){
$pant='Paciente:';
$ant='Saludable, sin antecedentes';
}
if($ant=='Embarazo')
$pant='En situación de:';
if($ant=='Asma')
$pant='Sufre de:';
if($ant=='Anemia')
$pant='Padece:';
if($ant=='Tiroides')
$pant='Problemas de la:';
if($ant=='Diabetes')
$pant='Sufre de:';
if($ant=='Hepatitís')
$pant='Ha padecido:';
if($ant=='Leucemia')
$pant='Sufre de:';
if($ant=='Hemofilia')
$pant='Padece:';
if($ant=='Aspirina')
$pant='Alergia a la:';
if($ant=='Penicilina')
$pant='Alergia a la:';
if($ant=='Anestesia')
$pant='Alergia a la:';
if($ant=='Iodo')
$pant='Alergia al:';
if($ant=='ConsultasMédicas'){
$pant='Asiste a:';
$ant='Consultas Médicas';
}
if($ant=='UlceraGástrica'){
$pant='Sufre de:';
$ant='Ulcera Gástrica';
}
if($ant=='ConsumodeTabaco'){
$pant='Práctica:';
$ant='Consumo de Tabaco';
}
if($ant=='FiebreReumática'){
$pant='Sufre de:';
$ant='Fiebre Reumática';
}
if($ant=='TransfusiónSanguínea'){
$pant='Ha recibido:';
$ant='Transfusión Sanguínea';
}
if($ant=='RespiraciónBucal'){
$pant='Problemas de:';
$ant='Respiración Bucal';
}
if($ant=='IntervenciónQuirúrgica'){
$pant='Ha recibido:';
$ant='Intervención Quirúrgica';
}
if($ant=='DefícitdeVitaminaK'){
$pant='Padece:';
$ant='Defícit de Vitamina K';
}
if($ant=='OtrasAlergias'){
$pant='Padece:';
$ant='Otras Alergias';
}
if($ant=='DiversidadFuncional'){
$pant='Padece:';
$ant='Diversidad Funcional';
}
if($ant=='ConsumodePastillasA.C.'){
$pant='Práctica:';
$ant='Consumo de Pastillas A.C.';
}
if($ant=='ApretamientoDentario'){
$pant='Padece:';
$ant='Apretamiento Dentario';
}
if($ant=='ProblemasdelCorazón'){
$pant='Sufre:';
$ant='Problemas del Corazón';
}
if($ant=='EnfermedadesVenéreas'){
$pant='Padece:';
$ant='Enfermedades Venéreas';
}
if($ant=='HerpesoAftasfrecuentes'){
$pant='Padece:';
$ant='Herpes o Aftas frecuentes';
}
if($ant=='Ruidosalabrir/cerrarlaboca'){
$pant='Padece:';
$ant='Ruidos al abrir/cerrar la boca';
}
if($ant=='SangradoExcesivoalCortarse'){
$pant='Sufre de:';
$ant='Sangrado Excesivo al Cortarse';
}
if($ant=='Lim.paraabrir/cerrarlaboca'){
$pant='Padece:';
$ant='Limitación para abrir/cerrar la boca';
}
$pdf->SetTextColor(0,0,0);
$texto = utf8_decode($pant);
$text2 = utf8_decode($ant);
$pdf->Cell(170,6,'',0,1);
$pdf->Cell(170,6,$texto.' '.$text2,1);
if($t5=='b')
$t5='c';
}
$pdf->Ln(12);
$pdf->SetFont('Times','B',14);
$titulo=utf8_decode('Consultas Realizadas');
$pdf->Cell(0,6,$titulo,0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(190,7,'',0,1);
$pdf->Cell(0,0,'Id Consulta',0,1,'L');
$pdf->Cell(0,0,'Pieza dental',0,1,'C');
$pdf->Cell(0,0,'Fecha',0,1,'R');
$pdf->SetFont('Arial','',12);
$t5='a';
while($c = $consulta->fetch_assoc()){
if($t5=='a'){
$pdf->setFillColor(249,249,249);
$t5='b';
}
if($t5=='c'){
$pdf->setFillColor(242,242,242);
$t5='a';
}
$c1=utf8_decode($c['id_consulta']);
$c2=utf8_decode($c['pieza']);
$c3=utf8_decode($c['fecha2']);
$c4=utf8_decode($c['tipo_consulta']);
$atendidopor = $mysqli->query("SELECT nombre, apellido from persona where cedula = '$c[cedula]'");
$atendidox = $atendidopor->fetch_assoc();
if(is_null($atendidox['nombre'])){
$atendidox['nombre']='Odontólogo';
$atendidox['apellido']='Retirado';
}
$c5=utf8_decode($atendidox['nombre'].' '.$atendidox['apellido']);
$pdf->Cell(190,8,'',0,1);
$pdf->Cell(0,6,$c1,1,1,'L',true);
$pdf->Cell(0,-6,$c2,0,1,'C');
$pdf->Cell(0,6,$c3,0,1,'R');
$c40=utf8_decode('Tipo de Consulta: ');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,$c40.$c4,1,1,'L',true);
$c40=utf8_decode('Diagnóstico:');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,$c40,1,1,'R',true);
$pdf->SetFont('Arial','',12);
$pdf->SetTextColor(0,0,0);
$c4=utf8_decode($c['diagnostico']);
$pdf->MultiCell(170,7,$c4,1,1,'R',true);
if($genero==' la Paciente')
$c40=utf8_decode('Atendida por: ');
if($genero=='l Paciente')
$c40=utf8_decode('Atendido por: ');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,$c40.$c5,0,0,'R');
$pdf->SetFont('Arial','',12);
$pdf->Ln(3);
if($t5=='b')
$t5='c';
}
$pdf->Ln(7);
$pdf->SetFont('Times','B',14);
$titulo=utf8_decode('Tratamientos');
$pdf->Cell(0,6,$titulo,0,1,'C');

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(190,7,'',0,1);
$subt=utf8_decode('Id Consulta');
$pdf->Cell(0,0,$subt,0,1,'L');
$subt=utf8_decode('Medicamento');
$pdf->Cell(0,0,$subt,0,1,'C');
$subt=utf8_decode('Duración');
$pdf->Cell(0,0,$subt,0,1,'R');
$pdf->SetFont('Arial','',12);
$t5='a';
while($t = $tratamiento->fetch_assoc()){
if($t5=='a'){
$pdf->setFillColor(249,249,249);
$t5='b';
}
if($t5=='c'){
$pdf->setFillColor(242,242,242);
$t5='a';
}
$t1=utf8_decode($t['id_consulta']);
$t2=utf8_decode($t['medicamento']);
$t3=utf8_decode($t['duracion']);
$t4=utf8_decode($t['indicaciones']);
$pdf->Cell(190,6,'',0,1);
$pdf->Cell(0,6,$t1,1,1,'L',true);
$pdf->Cell(0,-6,$t2,0,1,'C');
$pdf->Cell(0,6,$t3,0,1,'R');
$c40=utf8_decode('Indicaciones: ');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,$c40,1,1,'L',true);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(170,6,$t4,1,1,'L',true);
if($t5=='b')
$t5='c';
}
mysqli_close($mysqli);
$titulo=utf8_decode('Hístoria Clínica de ');
$pdf->Output($dest='D', $name=$titulo.$pacnom.' '.$pacape.'.pdf', $isUTF8=false);
}
else
{
// Usuario que no se ha logueado
echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";
header('Refresh: 6; http://odontologia.uptm/SIWGO'); //redirect
}
?>