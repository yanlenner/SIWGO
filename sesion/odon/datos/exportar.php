<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['nivel'] =='o'){
	$fechaGuardada = $_SESSION["ultimoAcceso"];
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
include '../../../src/php/enlace.php';
$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$enlace->set_charset('utf8');
if (!$enlace) die("Conexión fallida: " . mysqli_connect_error());
$result = mysqli_query($enlace, "SELECT max(id_sesion) as id FROM sesion WHERE usuario = '$_SESSION[usuario]'");
$row = mysqli_fetch_assoc($result);
$query = mysqli_query($enlace, "INSERT into registro_devisitas (id_sesion, enlace, tiempo) values('$row[id]','$_SERVER[PHP_SELF]','$ahora')");
//comparamos el tiempo transcurrido
if($tiempo_transcurrido < 0 || $tiempo_transcurrido > 599)
{
//si pasaron 10 minutos o más
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
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../../../src/css/font-awesome">
		<link rel="stylesheet" type="text/css" href="../../../src/css/materialize">
		<link rel="stylesheet" type="text/css" href="../../../src/css/style">
		<link rel="stylesheet" type="text/css" href="../../../src/css/navbar">
	</head>
	<body>
		<header>
      <h2>Sistema de Información Web para la Gestión de Pacientes del Servicio Odontológico "Kléber Ramírez"</h2>
      <nav class="fill">
        <ul class="right">
          <li><a href="../usuario">Gestión de Usuarios</a></li>
          <li><a href="../perfil">Gestionar Perfil del Paciente</a></li>
          <li><a href="../consulta">Registro de Consultas</a></li>
          <li><a href="../reporte">Emisión de Reportes</a></li>
          <li><a id="puesto">Gestión de Datos</a></li>
          <li><a href="../salir">Terminar Sesión</a></li>
        </ul>
      </nav>
    </header>
		<div id="loader6"></div>
		<ul id="slide-out" class="sidenav">
			<li><a href="exportar" class="tooltipped" data-position="right" data-tooltip="Extrae todos los registros de la base de datos y los guarda en un archivo de texto"><i class="fa fa-lg fa-database"></i> Exportar registros</a></li>
			<li><a href="importar" class="tooltipped" data-position="right" data-tooltip="Inserta en la base de datos el contenido de un archivo de texto"><i class="fa fa-lg fa-upload"></i> Importar registros</a></li>
			<li><a href="bitacora" class="tooltipped" data-position="right" data-tooltip="Muestra las visitas de los usuarios al sistema"><i class="fa fa-lg fa-globe"></i> Bitácora de navegación</a></li>
			<li><a href="listado" class="tooltipped" data-position="right" data-tooltip="Purga el listado de estudiantes regulares"><i class="fa fa-lg fa-group"></i> Actualizar listado de estudiantes regulares</a></li>
			<li><a class="tooltipped" data-position="right" data-tooltip="Regresa al menú principal" style="cursor: pointer;" onclick="top.location.href = '../'"><i class="fa fa-lg fa-arrow-left"></i> Volver</a></li>
		</ul>
		<br><br>
		<div class="row">
			<form class="col s12" method="post" action="export">
				<fieldset class="campo-morado">
					<a data-target="slide-out" class="sidenav-trigger">
						<h5 class="blanco"><img class="tooltipped menui" src="../../../src/img/menudat.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Exportar registros de la base de datos</h5>
					</a>
					<div class="row">
						<div class="input-field col s6">
							<input id="username" type="text" class="validate blanco" name="username" maxlength="11" autocomplete="off" required="">
							<label for="username">Usuario de la Base de Datos</label>
						</div>
						<div class="input-field col s6">
							<input id="password" type="text" class="validate blanco" name="password" autocomplete="off" required="">
							<label for="password">Contraseña de Acceso</label>
						</div>
					</div>
				</fieldset>
				<input name="backup" class="btn-azul in-right tooltipped" type="submit" value="Exportar" data-position="left" data-tooltip="Descarga una copia de la base de datos">
			</form>
		</div>
		<script  src='../../../src/js/jquery-3.js'></script>
		<script  src='../../../src/js/materialize.js'></script>
		<script  src='../../../src/js/main.js'></script>
		<script type="text/javascript">
			document.oncontextmenu = function(){return false;}
			function inputin(){
				$('input').each(function() {
		this.focus();
		});
			}
			$(document).ready(function(){
				inputin();});
		</script>
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
