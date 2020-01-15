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
require('../../../src/fpdf/fpdf.php');
require('../../../src/php/conexion.php');
error_reporting(0);
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(20, 25 , 20);
$pdf->SetAutoPageBreak(true,25);
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Ln(20);
if(empty($_POST['ci']))
	die("<h2 style='text-align: center; margin-top: 12%;'> Para generar la referencia, es obligatorio llenar los campos del formulario</h2><h4 style='text-align:center;'><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
$mysqli = getConnexion();
$query2 = "SELECT nombre, apellido, TIMESTAMPDIFF(YEAR,fecha,CURDATE()) AS edad, genero FROM persona WHERE cedula = '$_POST[ci]' ";
$query3 = "SELECT id_historia, carrera, carnet FROM estudiante WHERE cedula = '$_POST[ci]' ";
$res2 = $mysqli->query($query2);
$row2 = $res2->fetch_array(MYSQLI_ASSOC);
$res3 = $mysqli->query($query3);
$row3 = $res3->fetch_array(MYSQLI_ASSOC);
$pacnom = utf8_decode($row2['nombre']);
$pacape = utf8_decode($row2['apellido']);
$pacgen = utf8_decode($row2['genero']);
if($pacgen == 'H')
$premis0r='se refiere al ciudadano previamente mencionado';
if($pacgen == 'M')
$premis0r='se refiere a la ciudadana previamente mencionada';
$paceda = utf8_decode($row2['edad']);
$paccar = utf8_decode($row3['carrera']);
$paccan = utf8_decode($row3['carnet']);
$pachis = utf8_decode($row3['id_historia']);
$titulo=utf8_decode('REFERENCIA MÉDICO ODONTOLÓGICA');
$pdf->Cell(0,25,$titulo,0,1,'C');
$pdf->Cell(0,5,'',0,1);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$query = "SELECT nombre, apellido, genero FROM persona WHERE cedula = '$_SESSION[trabajador]'  ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$odonom = utf8_decode($row['nombre']);
$odoape = utf8_decode($row['apellido']);
$gendoc = $row['genero'];
$miespec = utf8_decode($_POST['miespec']);
$emis0r = utf8_decode('Unidad que refiere:');
$pdf->Ln(2);
$destinatario2=utf8_decode($_POST['dr']);
if($_POST['dr'] == '_______________________________')
$destinatario=utf8_decode('Médico que acepta la referencia:');
else
$destinatario=utf8_decode('Médico referido:');
$pdf->Cell(0,0,$destinatario,0,1,'L');
$atencion= utf8_decode('Tipo de atención requerida:');
$pdf->Cell(0,0,$atencion,0,1,'R');
if($destinatario==utf8_decode('Médico que acepta la referencia:'))
$pdf->Ln(9);
else
$pdf->Ln(7);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0,'   Dr(a). ',0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,0,'              '.$destinatario2,0,1,'L');
$destinatario=utf8_decode($_POST['servicio']);
$pdf->Cell(0,0,$destinatario,0,1,'R');
$pdf->Ln(10);
if($gendoc=='H')
$gendoc='   Dr. ';
else
$gendoc='   Dra.';
$pdf->SetFont('Arial','B',12);
$remitente=utf8_decode('Médico que refiere:');
$pdf->Cell(0,0,$remitente,0,1,'L');
$pdf->SetFont('Arial','B',12);
$pdf->Ln(7);
$pdf->Cell(0,0,$gendoc,0,1,'L');
$pdf->SetFont('Arial','',12);
if($gendoc=='H')
$pdf->Cell(0,0,'          '.$odonom.' '.$odoape,0,1,'L');
else
$pdf->Cell(0,0,'            '.$odonom.' '.$odoape,0,1,'L');
$remitente=utf8_decode($_POST['servicio']);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(129,0,'Especialidad:',0,1,'R');
$pdf->SetFont('Arial','',12);
$pdf->Cell(170,0,$miespec,0,1,'R');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0,$emis0r,0,1,'L');
$pdf->SetFont('Arial','',12);
$emis0r = utf8_decode('Servicio Odontológico "Kléber Ramírez"');
$pdf->Cell(0,0,'                                   '.$emis0r,0,1,'L');
if($pacgen == 'H')
$emis0r = utf8_decode('Nombres y Apellidos del Paciente: ');
if($pacgen == 'M')
$emis0r = utf8_decode('Nombres y Apellidos de la Paciente: ');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0,$emis0r,0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->SetX(93 , false);
$pdf->Cell(0,0,' '.$pacnom.' '.$pacape,0,1,'L');
$emis0r = utf8_decode('Cédula: ');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0,$emis0r,0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,0,'               '.$_POST['ci'],0,1,'L');
$emis0r = utf8_decode('Edad: ');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0,'                                        '.$emis0r,0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,0,'                                                    '.$paceda,0,1,'L');
$emis0r = utf8_decode('No de Historia Clínica: ');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0,'                                                                 '.$emis0r,0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,0,'                                                                                                         '.$pachis,0,1,'L');
$pdf->Ln(6);
$emis0r = utf8_decode(' bajo el presunto diagnóstico: ');
if(isset($_POST['pdiag'])){
$presuntod=$_POST['pdiag'];
$nuevopresuntod = filter_var($presuntod,FILTER_SANITIZE_STRING);
if(strlen($nuevopresuntod) > 0 && trim($nuevopresuntod))
$pdiag = utf8_decode($nuevopresuntod);
}
else
$pdiag = '';
$dias = utf8_decode(' días del mes ');
$año = utf8_decode(' del año ');
$fecha='A los '.date('d').$dias.date('m').$año.date('Y').', ';
$posemis0r = utf8_decode(', agradeciendo realizar valoración y atención odontológica requerida.');
$pdf->MultiCell(175,10,$fecha.$premis0r.$emis0r.$pdiag.$posemis0r);
$pdf->Ln(6);
if($_POST['re']=='si'){
$pdf->SetFont('Arial','B',12);
$emis0r = utf8_decode('Exámenes sugeridos: ');
$pdf->Cell(0,0,$emis0r,0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->Ln(4);
if(isset($_POST['exam'])){
$examen=$_POST['exam'];
$nuevoexamen = filter_var($examen,FILTER_SANITIZE_STRING);
if(strlen($nuevoexamen) > 0 && trim($nuevoexamen))
$exam = utf8_decode($nuevoexamen);
}
else
$exam = '';
$pdf->MultiCell(175,10,$exam.'.');
$pdf->Ln(10);
}
$emis0r = utf8_decode('Sin más nada que decir me despido de usted agradeciendo su colaboración.');
$pdf->Cell(0,0,$emis0r,0,1,'L');
$pdf->Ln(45);
$firma2=utf8_decode('Servicio Odontológico');
$firma3=utf8_decode('Kléber Ramírez');
$pdf->Cell(0,10,$firma2,0,1,'C');
$pdf->Cell(0,0,' "'.$firma3.'" ',0,1,'C');
mysqli_close($mysqli);
$pdf->Image("../../../src/img/membrete.png",12.5,15,-200);
$pdf->Output($dest='D', $name='Referencia de '.$pacnom.' '.$pacape.'.pdf', $isUTF8=false);
}
else
{
// Usuario que no se ha logueado
echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";
header('Refresh: 6; http://odontologia.uptm/SIWGO'); //redirect
}
?>