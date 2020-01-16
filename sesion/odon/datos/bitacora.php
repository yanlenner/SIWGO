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
		<style type="text/css">
		.col.blanco{
			font-size: 1.2rem !important;
		}
		</style>
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
		<ul id="slide-out" class="sidenav">
			<li><a href="exportar" class="tooltipped" data-position="right" data-tooltip="Extrae todos los registros de la base de datos y los guarda en un archivo de texto"><i class="fa fa-lg fa-database"></i> Exportar registros</a></li>
			<li><a href="importar" class="tooltipped" data-position="right" data-tooltip="Inserta en la base de datos el contenido de un archivo de texto"><i class="fa fa-lg fa-upload"></i> Importar registros</a></li>
			<li><a href="bitacora" class="tooltipped" data-position="right" data-tooltip="Muestra las visitas de los usuarios al sistema"><i class="fa fa-lg fa-globe"></i> Bitácora de navegación</a></li>
			<li><a href="listado" class="tooltipped" data-position="right" data-tooltip="Purga el listado de estudiantes regulares"><i class="fa fa-lg fa-group"></i> Actualizar listado de estudiantes regulares</a></li>
			<li><a class="tooltipped" data-position="right" data-tooltip="Regresa al menú principal" style="cursor: pointer;" onclick="top.location.href = '../'"><i class="fa fa-lg fa-arrow-left"></i> Volver</a></li>
		</ul>
		<br><br>
		<div class="row">
			<?php
			
			function spar(int $b){
				if($b % 2 == 0)
					return true;
				else
					return false;
			}
			function ofecha($f){
				$fecha2 = date_create_from_format('Y-m-d G:i:s', $f);
    			$fecha = date_format($fecha2, 'd/m/Y G:i:s');
    			return $fecha;
			}
			function lenner(string $a)
			{
				$sz = strlen($a);
				$vector;
				$cat;
				$b;
				$i;
				$x;
				for($i=0; $i<$sz; $i++)
					$vector[$i]=ord($a[$i]);

				for($i=0; $i<$sz; $i++){
					$x=$vector[$i];
					if(spar($x-5))
						$vector[$i]-=5;
					else
						$vector[$i]-=1;
				}
				for($i=0; $i<$sz; $i++){
					$b[$i]=chr($vector[$i]);
					$cadena .=$b[$i];
				}
				return $cadena;
			}
				//Conexión a la BD
			include '../../../src/php/enlace.php';
				// parámetros de conexión
			$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
			$enlace->set_charset('utf8');
				//Consulta la tabla:
			$usuarios = $enlace->query("SELECT id_sesion,usuario,inicio,fin,minutos FROM sesion order by id_sesion desc limit 13");
				//Crear la tabla de HTML en la que se muestran los datos:
			?>
			<div class="row">
				<fieldset class="campo-morado">
					<a data-target="slide-out" class="sidenav-trigger">
						<h5 class="blanco"><img class="tooltipped menui" src="../../../src/img/menudat.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Lista de sesiones</h5>
					</a>
					<div class="row">
						<div class="col s1 center" style="color: white; font-size: .8rem;">Sesión</div>
						<div class="col s3 center" style="color: white; font-size: .8rem;">Usuario</div>
						<div class="col s3 center" style="color: white; font-size: .8rem;">Entrada</div>
						<div class="col s3 center" style="color: white; font-size: .8rem;">Salida</div>
						<div class="col s2 center" style="color: white; font-size: .8rem;">Minutos</div>
					</div><?php while($u = $usuarios->fetch_assoc()){ ?>
					<div id="<?php echo $u[id_sesion]; ?>" onclick='mostrarc(this.id);' class="col s1 center blanco" style='cursor:pointer'><?php echo $u['id_sesion']; ?></div>
					<div class="col s3 center blanco ph"><?php 
					if(is_numeric($u['usuario']))
						$usuario=$u['usuario'];
					else
						$usuario=lenner($u['usuario']);
					echo $usuario; ?></div>
					<div class="col s3 center blanco"><?php echo ofecha($u['inicio']); ?></div>
					<div class="col s3 center blanco"><?php if(is_null($u['fin'])) echo 'Desconocida';
					else echo ofecha($u['fin']); ?></div>
					<div class="col s2 center blanco"><?php if(is_null($u['minutos'])) echo 'Incalculable<br>';
					else echo $u['minutos'].'<br>'; ?></div>
					<?php } ?>
				</fieldset>
				<?php mysqli_close($enlace);?>
			</div>
		</div>
		<script  src='../../../src/js/jquery-3.js'></script>
		<script  src='../../../src/js/materialize.js'></script>
		<script  src='../../../src/js/main.js'></script>
		<script type="text/javascript">
		function mostrarc(z) {
		setTimeout(function () {
		window.sesion = z;
		window.open('http://odontologia.uptm/SIWGO/sesion/odon/datos/visitas', 'nobody', 'width=1024,height=402,resizable=yes,centerscreen=yes,scrollbars=yes,status=1')
		}, 1111)
		}
		</script>
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
