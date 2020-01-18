<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['nivel'] =='o'){
	$fechaGuardada = $_SESSION['ultimoAcceso'];
	$ahora = date('Y-n-j H:i:s');
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
$_SESSION['ultimoAcceso'] = $ahora;?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>SIWGO - Listado de atenciones al paciente</title>
		<link rel="stylesheet" type="text/css" href="../../../src/css/jquery-ui">
		<link rel="stylesheet" type="text/css" href="../../../src/css/datatables">
		<link rel="stylesheet" type="text/css" href="../../../src/css/responsivejqueryui">
		<link rel="stylesheet" type="text/css" href="../../../src/css/datatablesui">
		<script type="text/javascript" charset="utf8" src="../../../src/js/jquery-3.js"></script>
		<script type="text/javascript" charset="utf8" src="../../../src/js/datatables.js"></script>
		<script type="text/javascript" charset="utf8" src="../../../src/js/datatablesresponsive.js"></script>
		<script type="text/javascript" charset="utf8" src="../../../src/js/responsivejqueryui.js"></script>
		<script type="text/javascript" charset="utf8" src="../../../src/js/datatablesui.js"></script><style type="text/css">
		.text-center{
		text-align: center !important;
		}
		</style>
	</head>
	<body>
		<div class="container">
			<table id="my-example" class="display text-center" data-order='[[ 0, "asc" ]]' data-page-length='6'>
				<thead>
					<tr>
						<th>Número de consulta</th>
						<th>Pieza</th>
						<th>Diagnostico</th>
						<th>Tipo de consulta</th>
						<th>Fecha de la consulta</th>
						<th data-class-name="priority">Atendido por</th>
					</tr>
				</thead>
			</table>
		</div>
		<script type="text/javascript">
			document.oncontextmenu = function(){return false;}
			$(document).ready(function() {
				var cedula = window.opener.paciente.value;
				$('#my-example').dataTable({
					"bProcessing": true,
					"sAjaxSource": "../../../src/php/fin_consultaspac.php",
					"fnServerParams": function (aoData){
						aoData.push({"name": 'paciente', "value": cedula});
					},
					"sServerMethod": "POST",
					"aoColumns": [
					{ mData: 'id_consulta' } ,
					{ mData: 'pieza' },
					{ mData: 'diagnostico' },
					{ mData: 'tipo_consulta' },
					{ mData: 'fecha' },
					{ mData: 'doctor' }
					],
				});
			});
			
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