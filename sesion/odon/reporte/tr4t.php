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
function generateRandomString($length = 10) {
return substr(str_shuffle("0123456789ABCDEF"), 0, $length);
}
require('../../../src/fpdf/fpdf.php');
class PDF extends FPDF
{
function RoundedRect($x, $y, $w, $h, $r, $style = '')
{
$k = $this->k;
$hp = $this->h;
if($style=='F')
$op='f';
elseif($style=='FD' || $style=='DF')
$op='B';
else
$op='S';
$MyArc = 4/3 * (sqrt(2) - 1);
$this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
$xc = $x+$w-$r ;
$yc = $y+$r;
$this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
$xc = $x+$w-$r ;
$yc = $y+$h-$r;
$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
$xc = $x+$r ;
$yc = $y+$h-$r;
$this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
$xc = $x+$r ;
$yc = $y+$r;
$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
$this->_out($op);
}
function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
{
$h = $this->h;
$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
}
}
require('../../../src/php/conexion.php');
$mysqli = getConnexion();
$query = "SELECT fecha from consulta where id_consulta like '$_POST[consulta]'";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$fechaconsulta = date_create_from_format('Y-m-d', $row['fecha']);
$fechaconsulta = date_format($fechaconsulta, 'd-m-Y');
error_reporting(0);
date_default_timezone_set('America/Caracas');
$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetMargins(20, 25 , 20);
$pdf->AddPage();
$pdf->SetFont('Times','B',11.5);
$pdf->setFillColor(255,255,255);
$titulo=utf8_decode('                    Unidad de Servicios Estudiantiles');
$pdf->Ln(14);
$pdf->MultiCell(290,5,$titulo,0,1,'L');
$titulo=utf8_decode('              Servicio Odontológico "Kléber Ramírez"');
$pdf->MultiCell(290,5,$titulo,0,1,'L');
$titulo=utf8_decode('Lugar:  Ciudad de Ejido              Fecha de Emisión: '.$fechaconsulta);
$pdf->Ln(6);
$pdf->SetFont('Times','',11.5);
$pdf->MultiCell(290,5,$titulo,0,1,'L');
$pdf->SetFont('Times','B',11.5);
$pdf->Ln(3);
if(empty($_POST['ci']))
	die("<h2 style='text-align: center; margin-top: 12%;'> Para generar el tratamiento, es obligatorio llenar los campos del formulario</h2><h4 style='text-align:center;'><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
$cedula = $_POST['ci'];
$query = "SELECT id_historia FROM estudiante WHERE cedula = '$cedula' ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$pachis = $row['id_historia'];
$query = "SELECT id_consulta, id_historia FROM tratamiento WHERE id_historia = '$pachis' and id_consulta like '$_POST[consulta]'";
$res = $mysqli->query($query);
$existe = mysqli_num_rows($res);
if($existe == 1)
	die("<h2 style='text-align: center; margin-top: 12%;'> Se ha comprobado que para este número de consulta ya fué generado un tratamiento</h2><h4 style='text-align:center;'><a href='./' style='color:#66328f;text-decoration: none;'>Valide e intente de nuevo</a></h4>");
do{
    $tratamiento = generateRandomString();
    $chequear ="SELECT id_tratamiento FROM tratamiento WHERE id_tratamiento like '$tratamiento'";
    $resultado = $mysqli-> query($chequear);
    $existe = mysqli_num_rows($resultado);
}while($existe == 1);
$query = "SELECT nombre, apellido, genero, TIMESTAMPDIFF(YEAR,fecha,CURDATE()) AS edad FROM persona WHERE cedula = '$cedula' ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$pacnom = utf8_decode($row['nombre']);
$pacape = utf8_decode($row['apellido']);
$pacgen = utf8_decode($row['genero']);
$edad = $row['edad'];
$query2 = "SELECT nombre, apellido FROM persona WHERE cedula = '$_SESSION[trabajador]' ";
$res2 = $mysqli->query($query2);
$row2 = $res2->fetch_array(MYSQLI_ASSOC);
$odonom = utf8_decode($row2['nombre']);
$odoape = utf8_decode($row2['apellido']);
$query2 = "SELECT mpps FROM trabajador WHERE cedula = '$_SESSION[trabajador]' ";
$res2 = $mysqli->query($query2);
$row2 = $res2->fetch_array(MYSQLI_ASSOC);
$odocod = utf8_decode($row2['mpps']);
if($pacgen == 'H')
$titulo=utf8_decode('Datos del Paciente');
if($pacgen == 'M')
$titulo=utf8_decode('Datos de la Paciente');
$pdf->Ln(1);
$pdf->MultiCell(290,5,$titulo,0,1,'L');
$pdf->Ln(3);
$pdf->SetFont('Times','',11.5);
$titulo=utf8_decode('Nombres y Apellidos:');
$pdf->MultiCell(290,5,$titulo,0,1,'L');
$pdf->Cell(0,-5,'                                     '.$pacnom.' '.$pacape,0,1,'L');
$pdf->Ln(9);
$titulo=utf8_decode('  Cédula de Identidad:                                 Edad:  ');
$pdf->MultiCell(290,5,$titulo,0,1,'L');
$pdf->Cell(0,-5,'                                     '.$cedula,0,1,'L');
$pdf->Cell(0,5,'                                                                               '.$edad,0,1,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',11.5);
$titulo=utf8_decode('Receta:');
$pdf->MultiCell(290,5,$titulo,0,1,'L');
if(isset($_POST['reci'])){
$reci=$_POST['reci'];
$nuevoreci = filter_var($reci,FILTER_SANITIZE_STRING);
if(strlen($nuevoreci) > 0 && trim($nuevoreci))
$recipe = $nuevoreci;
}
else
$recipe = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
$pdf->SetTopMargin(50);
$pdf->SetFont('Times','',11.5);
$pdf->Ln(1);
$recip = utf8_decode($recipe);
$pdf->MultiCell(108,5,$recip,0,1,'L');
$pdf->SetFont('Times','B',11.5);
if(isset($_POST['indi'])){
$indi=$_POST['indi'];
$nuevoindi = filter_var($indi,FILTER_SANITIZE_STRING);
if(strlen($nuevoindi) > 0 && trim($nuevoindi))
$indica = $nuevoindi;
}
else
$indica = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.';
$pdf->SetY(120 , false);
$pdf->SetX(20.5 , false);
$pdf->SetMargins(22, 25 , 20);
$titulo=utf8_decode('Indicaciones:');
$pdf->MultiCell(290,5,$titulo,0,1,'L');
$pdf->SetMargins(20, 25 , 20);
$pdf->SetFont('Times','',11.5);
$pdf->Ln(1);
$indic = utf8_decode($indica);
$pdf->MultiCell(108,5,$indic,0,1,'L');
$pdf->SetDrawColor(192, 0, 0);
$pdf->SetLineWidth(0.5);
$pdf->RoundedRect(12, 61, 120, 100, 1.5, 'D');
$pdf->SetY(165 , false);
$pdf->SetX(20 , false);
$pdf->SetMargins(20, 25 , 20);
$pdf->SetFont('Times','B',11.5);
$titulo=utf8_decode('Datos del Odontólogo');
$pdf->MultiCell(290,5,$titulo,0,1,'L');
$pdf->Ln(3);
$pdf->SetFont('Times','',11.5);
$titulo=utf8_decode('Nombres y Apellidos:');
$pdf->MultiCell(290,5,$titulo,0,1,'L');
$pdf->Ln(3);
$titulo=utf8_decode('  Cédula de Identidad:');
$pdf->MultiCell(290,5,$titulo,0,1,'L');
$pdf->SetY(173 , false);
$pdf->SetX(58, false);
$pdf->Cell(0,5,$odonom.' '.$odoape,0,1,'L');
$pdf->SetY(181 , false);
$pdf->SetX(58, false);
$pdf->Cell(0,5,$_SESSION['trabajador'],0,1,'L');
$pdf->SetY(181 , false);
$pdf->SetX(85, false);
$pdf->Cell(0,5,'M.P.P.S. '.$odocod,0,1,'L');
$pdf->SetY(181 , false);
$pdf->SetX(237, false);
$pdf->SetY(110 , false);
$pdf->SetX(20, false);
$titulo=utf8_decode('Duración del tratamiento:');
$duracion=utf8_decode($_POST['dura']);
$pdf->SetFont('Times','B',11.5);
$pdf->Cell(0,5,$titulo,0,1,'L');
$pdf->SetFont('Times','',11.5);
$pdf->SetY(110 , false);
$pdf->SetX(68, false);
$pdf->Cell(0,5,$duracion,0,1,'L');
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0);
$pdf->Line(148.5, 0, 148.5, 210);
$pdf->Image("../../../src/img/mre.png",7.5,14,-214);
$query = "SELECT fecha from consulta where id_consulta like '$_POST[consulta]'";
$res = $mysqli->query($query);
$count = mysqli_num_rows($res);
if($count != 1){
mysqli_close($mysqli);
echo "<!DOCTYPE html>
<html lang='es'>
		<head>
				<link rel='stylesheet' href='../../../src/css/bootstrap'>
				<link rel='stylesheet' href='../../../src/css/int'>
		</head>
		<body>
				<br><br><br><br>
				<h3 style='text-align:center; line-height: 1.6;'>El Número de consulta que usted ingresó<br> para justificar el tratamiento, en realidad no existe<br><a href='tratamiento' style='color: #66328f; text-decoration: none;'>porfavor revise e intente de nuevo!</a></h3>
		</body>
</html>
";
}
$query = "SELECT indicaciones from tratamiento where id_historia like '$pachis' and indicaciones = '$indica' and duracion = '$_POST[dura]' and medicamento = '$recipe'";
$res = $mysqli->query($query);
$count = mysqli_num_rows($res);
if($count != 1){
$query = "INSERT INTO tratamiento values ('$pachis','$_SESSION[trabajador]','$_POST[consulta]','$tratamiento','$indica','$recipe','$_POST[dura]')";
$res = $mysqli->query($query);
}
$pdf->Output($dest='D', $name='Recipe de '.$pacnom.' '.$pacape.'.pdf', $isUTF8=false);
mysqli_close($mysqli);
}
else
{
// Usuario que no se ha logueado
echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";
header('Refresh: 6; http://odontologia.uptm/SIWGO'); //redirect
}
?>