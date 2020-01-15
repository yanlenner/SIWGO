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
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="stylesheet" href="../../../src/css/bootstrap">
		<link rel="stylesheet" href="../../../src/css/int">
	</head>
	<body>
		<?php
		error_reporting(0);
		include '../../../src/php/enlace.php';
		// parámetros de conexión
		$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		$enlace->set_charset('utf8');
		// revisar conexión
		if (!$enlace)
			die("Conexión Fallida: " . mysqli_connect_error());
		if(empty($_POST['search'])){
			die("<h2 style='text-align: center; margin-top: 12%;'> Parece que has querido eliminar un usuario, pero déjeme informarle que no hemos recibido este tipo de solicitud</h2><h4><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
		}
		//Comienza el proceso de eliminación del usuario
		$ci = $_POST['search'];
		$fecha = $_POST['fecha'];
		$fecha2 = date_create_from_format('d/m/Y', $fecha);
		$fecha = date_format($fecha2, 'Y-m-d');
		$checkusr ="SELECT * FROM persona WHERE cedula like '$_POST[search]' AND fecha = '$fecha'";
		$result = $enlace-> query($checkusr);
		$count = mysqli_num_rows($result);

			$usr = mysqli_query($enlace, "SELECT usuario FROM trabajador where cedula ='$ci'");			
        	$rusr = mysqli_fetch_assoc($usr);        	
			$url=substr($_SERVER['PHP_SELF'], 0,-4);  
			$usr=$rusr['usuario'];
			$rvisita = mysqli_query($enlace, "SELECT max(id_sesion) as id FROM sesion WHERE usuario = '$_SESSION[usuario]'");			    	
        	$rowan = mysqli_fetch_assoc($rvisita);
		if($count == 1)
		{
			$sql= "SET FOREIGN_KEY_CHECKS=0";
			mysqli_query($enlace, $sql);	
			$query = "DELETE FROM trabajador WHERE cedula = '$ci'";
			if(mysqli_query($enlace, $query)){
			$query = "DELETE FROM persona WHERE cedula = '$ci'";
			mysqli_query($enlace, $query);
			$sql= "SET FOREIGN_KEY_CHECKS=1";
			mysqli_query($enlace, $sql);  
			mysqli_query($enlace, "INSERT into registro_devisitas (id_sesion, enlace, tiempo) values('$rowan[id]','$url$usr.php','$ahora')");
			echo "<h2 style='text-align: center; margin-top: 12%;'> El usuario ha sido eliminado satisfactoriamente</h2><h4 style='text-align: center;'><a href='./' target='_top' style='color: #66328f;text-decoration: none;'>Continuar</a></h4>";
		}
		}
		else
			echo "<h2 style='text-align: center; margin-top: 12%;'> No se eliminó el usuario, porque se presentó una inconsistencia en uno de sus datos</h2><h4 style='text-align: center;'><a href='./' target='_top' style='color: #66328f;text-decoration: none;'>Continuar</a></h4>";
		mysqli_close($enlace);
		?>
		<script type="text/javascript">document.oncontextmenu = function(){return false;}</script>
	</body>
</html>
<?php
}
else
{
// Usuario que no se ha logueado
echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";
header('Refresh: 6; http://odontologia.uptm/SIWGO'); //redirect
}
?>