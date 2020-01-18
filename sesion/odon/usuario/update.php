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
$_SESSION["ultimoAcceso"] = $ahora;?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="stylesheet" href="../../../src/css/bootstrap">
		<link rel="stylesheet" href="../../../src/css/int">
	</head>
	<body>
		<?php
		
		include '../../../src/php/enlace.php';
		$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		$enlace->set_charset('utf8');
		if (!$enlace) {
			die("Conexión fallida: " . mysqli_connect_error());
		}
		if(empty($_POST['ci']))
			die("<h2 style='text-align: center; margin-top: 12%;'> No podemos efectuar actualizaciones de usuario de esta manera</h2><h4><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
		$mysql = mysqli_query($enlace, "UPDATE persona SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]' WHERE cedula = '$_POST[ci]'");
		if($mysql){
			if(empty($_POST['secu']) && !empty($_POST['clave'])){
			$mysql = mysqli_query($enlace, "UPDATE trabajador SET password = md5('$_POST[clave]'),  nivel = '$_POST[type]', mpps= '$_POST[mpps]' WHERE cedula = '$_POST[ci]'");
				echo "<h2 style='text-align: center; margin-top: 12%;'> Los datos del usuario $_POST[usr] han sido actualizados satisfactoriamente</h2><h4><a href='./' style='color:#66328f;text-decoration: none;'>Continuar</a></h4>";
		  }
			elseif(empty($_POST['clave']) && !empty($_POST['secu'])){
			$mysql = mysqli_query($enlace, "UPDATE trabajador SET respuesta = md5('$_POST[secu]'),  nivel = '$_POST[type]', mpps= '$_POST[mpps]' WHERE cedula = '$_POST[ci]'");
				echo "<h2 style='text-align: center; margin-top: 12%;'> Los datos del usuario $_POST[usr] han sido actualizados satisfactoriamente</h2><h4><a href='./' style='color:#66328f;text-decoration: none;'>Continuar</a></h4>";
			}
			elseif(empty($_POST['clave']) && empty($_POST['secu'])){
			$mysql = mysqli_query($enlace, "UPDATE trabajador SET nivel = '$_POST[type]', mpps= '$_POST[mpps]' WHERE cedula = '$_POST[ci]'");
				echo "<h2 style='text-align: center; margin-top: 12%;'> Los datos del usuario $_POST[usr] han sido actualizados satisfactoriamente</h2><h4><a href='./' style='color:#66328f;text-decoration: none;'>Continuar</a></h4>";
			}
			else{
			$mysql = mysqli_query($enlace, "UPDATE trabajador SET password = md5('$_POST[clave]'), respuesta = md5('$_POST[secu]'),  nivel = '$_POST[type]', mpps= '$_POST[mpps]' WHERE cedula = '$_POST[ci]'");
				echo "<h2 style='text-align: center; margin-top: 12%;'> Los datos del usuario $_POST[usr] han sido actualizados satisfactoriamente</h2><h4><a href='./' style='color:#66328f;text-decoration: none;'>Continuar</a></h4>";
			}
		}
		mysqli_close($enlace); ?>
		<script type="text/javascript">document.oncontextmenu = function(){return false;}</script>
	</body>
</html>
<?php
}
else
{
// Usuario que no se ha logueado
echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";
header('Refresh: 5; http://odontologia.uptm/SIWGO'); //redirect
}
?>
