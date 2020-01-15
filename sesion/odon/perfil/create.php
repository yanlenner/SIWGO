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
		<meta charset="UTF-8" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="../../../src/img/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="../../../src/css/bootstrap">
		<link rel="stylesheet" href="../../../src/css/int">
	</head>
	<body>
		<?php
		error_reporting(0);
		function generateRandomString($length = 10) {
			return substr(str_shuffle("1234567890"), 0, $length);
		}
		include '../../../src/php/enlace.php';
		// parámetros de conexión
		$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		$enlace->set_charset('utf8');
		// revisar conexión
		if (!$enlace) {
			die("Conexión Fallida: " . mysqli_connect_error());
		}
		if(empty($_POST['ci']))
			die("<h2 style='text-align: center; margin-top: 12%;'> Sólo se permite registrar nuevos perfiles cuando tu llenas todos los campos requeridos en el formulario</h2><h4><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
		// Doble instrucción para verificar si el paciente ya esta registrado
		$checkusr ="SELECT cedula FROM persona WHERE cedula like '$_POST[ci]'";
		$carne=$_POST['ce'];
		$checkusr2 ="SELECT carnet FROM estudiante WHERE carnet like '$carne'";
		// La variable result retiene la instrucción checkusr y la conexión bd
		$result = $enlace-> query($checkusr);
		$result2 = $enlace-> query($checkusr2);
		// La variable count guarda el resultado de la busqueda
		$count = mysqli_num_rows($result);
		$count2 = mysqli_num_rows($result2);
		// Si la cuenta es 1 significa que el paciente ya esta registrado
		if ($count == 1 or $count2 == 1)
		{
			echo "<h2 style='text-align: center; margin-top: 12%;'>Error! <br> El paciente ya se encuentra registrado en el Sistema</h2><br><h4><a href='registrar' style='color:#66328f;text-decoration: none;'>Volver!</a></h4>";
		}
		else
		{
		//Comienza el proceso de registro del paciente
			
			$cedula = $_POST['ci'];
			$npac = $_POST['nombre'];
			$apac = $_POST['apellido'];
			$gen = $_POST['sex'];
			$telef = $_POST['telefono'];
			$nac = $_POST['nacimiento'];
			$nac = date_create_from_format('d/m/Y', $nac);
			$nac = date_format($nac, 'Y-m-d');
			$ema = $_POST['correo'];
			$dom = $_POST['domicilio'];
			
			$query = "INSERT INTO persona (cedula, nombre, apellido, genero, telefono, fecha, correo, direccion) VALUES ('$cedula','$npac','$apac','$gen','$telef','$nac','$ema','$dom')";
			if (mysqli_query($enlace, $query)){
				do{
					$historia = generateRandomString();
					$check_hist ="SELECT id_historia FROM estudiante WHERE id_historia like '$historia'";
					$result3 = $enlace-> query($check_hist);
					$count3 = mysqli_num_rows($result3);
				}while($count3 == 1);
				$carrera = $_POST['carrera'];
				$query = "INSERT INTO estudiante (cedula, id_historia, carrera, carnet, aspecto, hallazgo, observacion, respuesta) VALUES ('$cedula','$historia','$carrera','$carne', '', '', '' ,'')";
				mysqli_query($enlace, $query);
				if(is_array($_POST['antecedente']))
				{
		// realizamos el ciclo
					while(list($key,$value) = each($_POST['antecedente']))
					{
		///imprimimos el valor del actual checkbox
						do{
							$antecedente = generateRandomString();
							$check_hist2 ="SELECT id_historia FROM antecedente WHERE id_antecedente like '$antecedente'";
							$result4 = $enlace-> query($check_hist2);
							$count4 = mysqli_num_rows($result4);
						}while($count4 == 1);
						$ante = "INSERT INTO antecedente VALUES ('$antecedente','$historia','$value')";
						mysqli_query($enlace, $ante);
					}
				}
				echo "<h2 style='text-align: center; margin-top: 12%;'> Has registrado a $npac </h2><br><h4><a href='consultar' style='color:#66328f;text-decoration: none;'>Continuar</a></h4>";
			}
			else
				echo "<h2 style='text-align: center; margin-top: 12%;'> Uno de los datos personales escritos es erróneo</h2><br><h4><a href='registrar' style='color:#66328f;text-decoration: none;'>Volver!</a></h4>";
		}
		mysqli_close($enlace);
		?>
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