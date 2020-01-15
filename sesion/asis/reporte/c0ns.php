<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['nivel'] =='a'){
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
?>
<?php
require('../../../src/fpdf/fpdf.php');
require('../../../src/php/conexion.php');
error_reporting(0);
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetMargins(20, 25 , 20);
$pdf->SetAutoPageBreak(true,25);
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Ln(26);
if(empty($_POST['ci']))
	die("<h2 style='text-align: center; margin-top: 12%;'> Para generar la constancia, es obligatorio llenar los campos del formulario</h2><h4 style='text-align:center;'><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
$mysqli = getConnexion();
$query2 = "SELECT nombre, apellido, genero FROM persona WHERE cedula = '$_POST[ci]' ";
$query3 = "SELECT carrera, carnet FROM estudiante WHERE cedula = '$_POST[ci]' ";
$query4 = "SELECT id_historia FROM estudiante WHERE cedula = '$_POST[ci]' ";
$res2 = $mysqli->query($query2);
$row2 = $res2->fetch_array(MYSQLI_ASSOC);
$res3 = $mysqli->query($query3);
$row3 = $res3->fetch_array(MYSQLI_ASSOC);
$res4 = $mysqli->query($query4);
$row4 = $res4->fetch_array(MYSQLI_ASSOC);
$pacnom = utf8_decode($row2['nombre']);
$pacape = utf8_decode($row2['apellido']);
$pacgen = utf8_decode($row2['genero']);
$paccar = utf8_decode($row3['carrera']);
$paccan = utf8_decode($row3['carnet']);
$pachis = utf8_decode($row4['id_historia']);
$query4 = "SELECT MAX(fecha) as fecha from consulta WHERE id_historia like '$pachis'";
$res4 = $mysqli->query($query4);
$row4 = $res4->fetch_array(MYSQLI_ASSOC);
$fecha = $row4['fecha'];
$query5 = "SELECT diagnostico, cedula from consulta WHERE id_historia like '$pachis' and fecha = '$fecha'";
$res5 = $mysqli->query($query5);
$row5 = $res5->fetch_array(MYSQLI_ASSOC);
$titulo=utf8_decode('CONSTANCIA DE ATENCIÓN ODONTOLÓGICA');
$pdf->Cell(0,30,$titulo,0,1,'C');
$pdf->Cell(0,5,'',0,1);
$pdf->Ln(10);
$pdf->SetFont('Arial','',12);
$diagnostico=utf8_decode($row5['diagnostico']);
$odontologo=utf8_decode($row5['cedula']);
$query = "SELECT nombre, apellido FROM persona WHERE cedula = '$odontologo' ";
$res = $mysqli->query($query);
$row = $res->fetch_array(MYSQLI_ASSOC);
$odonom = utf8_decode($row['nombre']);
$odoape = utf8_decode($row['apellido']);
$query2 = "SELECT mpps FROM trabajador WHERE cedula = '$odontologo' ";
$res2 = $mysqli->query($query2);
$row2 = $res2->fetch_array(MYSQLI_ASSOC);
$odocod = utf8_decode($row2['mpps']);
if(is_null($odonom) && is_null($odoape)){
$odonom=utf8_decode('El usuario que atendió al paciente fué eliminado, porfavor que el Odontólogo de turno');
$odoape=utf8_decode('Registre una nueva consulta sobre el paciente para obtener un mejor resultado.');
$pdf->MultiCell(175,10,$odonom.' '.$odoape);
mysqli_close($mysqli);
$pdf->Image("../../../src/img/membrete.png",12.5,15,-200);
$pdf->Output($dest='D', $name='Constancia de '.$pacnom.' '.$pacape.'.pdf', $isUTF8=false);
}
$texto0 = utf8_decode('    Quien Suscribe, ');
$texto1 = utf8_decode(', Odontólogo en ejercicio legal, ');
if($pacgen == 'H'){
$texto11 = utf8_decode('por medio de la presente hace constar que el ');
$texto44 = utf8_decode(', fué valorado');
}
else{
$texto11 = utf8_decode('por medio de la presente hace constar que  la ');
$texto44 = utf8_decode(', fué valorada');
}
$texto12 = utf8_decode('paciente ');
$texto2 = utf8_decode(' titular de la Cédula de Identidad número ');
$texto3 = utf8_decode(', estudiante regular de la Carrera ');
$texto4 = utf8_decode(', carnet número ');
$texto5 = utf8_decode(' en este Servicio Odontológico y se le diagnosticó: ');
if ($_POST['rt']=='si'){
$texto6 = utf8_decode('. Se indica tratamiento');
if ($_POST['rr']=='si')
$texto65 = utf8_decode(', ameritando reposo por: ');
else
$texto65 = utf8_decode('. Ameritando reposo por: ');
}
if ($_POST['rt']=='no'){
$texto6 = '';
if ($_POST['rr']=='si')
$texto65 = utf8_decode(', ameritando reposo por: ');
else
$texto65 = utf8_decode('. Ameritando reposo por: ');
}
if ($_POST['rr']=='si') {
$dias = utf8_decode($_POST['dias']);
$texto66 = utf8_decode(' días a partir de la presente fecha');
}
else{
$texto65 =''; $dias=''; $texto66='';
}
$texto7 = utf8_decode('. Constancia que se expide a petición de parte interesado(a) en la Ciudad de Ejido a los ');
$texto8 = utf8_decode(' días del mes ');
$texto9 = utf8_decode(' del año ');
$pdf->MultiCell(175,10,$texto0.$odonom.' '.$odoape.$texto1.utf8_decode('Código M.P.P.S. ').$odocod.' '.$texto11.$texto12.$pacnom.' '.$pacape.$texto2.$_POST['ci'].$texto3.$paccar.$texto4.$paccan.$texto44.$texto5.$diagnostico.$texto6.$texto65.$dias.$texto66.$texto7.date('d').$texto8.date('m').$texto9.date('Y').'.');
$pdf->Ln(35);
$firma2=utf8_decode('Servicio Odontológico');
$firma3=utf8_decode('Kléber Ramírez');
$pdf->Cell(0,10,$firma2,0,1,'C');
$pdf->Cell(0,0,' "'.$firma3.'" ',0,1,'C');
mysqli_close($mysqli);
$pdf->Image("../../../src/img/membrete.png",12.5,15,-200);
$pdf->Output($dest='D', $name='Constancia de '.$pacnom.' '.$pacape.'.pdf', $isUTF8=false);
?>
<?php
}
else
{
// Usuario que no se ha logueado
echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";
header('Refresh: 6; http://odontologia.uptm/SIWGO'); //redirect
}
?>