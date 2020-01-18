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
		<meta charset="UTF-8" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../../../src/css/font-awesome">
		<link rel="stylesheet" href="../../../src/css/materialize">
		<link rel="stylesheet" href="../../../src/css/style2">
		<link rel="stylesheet" href="../../../src/css/trata">
		<link rel="stylesheet" href="../../../src/css/navbar">
	</head>
	<body>
		<header>
      <h2>Sistema de Información Web para la Gestión de Pacientes del Servicio Odontológico "Kléber Ramírez"</h2>
      <nav class="fill">
        <ul class="right">
          <li><a href="../usuario">Gestión de Usuarios</a></li>
          <li><a href="../perfil">Gestionar Perfil del Paciente</a></li>
          <li><a id="puesto">Registro de Consultas</a></li>
          <li><a href="../reporte">Emisión de Reportes</a></li>
          <li><a href="../datos">Gestión de Datos</a></li>
          <li><a href="../salir">Terminar Sesión</a></li>
        </ul>
      </nav>
    </header>
		<script  src='../../../src/js/jquery-3.js'></script>
		<ul id="slide-out" class="sidenav">
			<li><a href="registrar" class="tooltipped" data-position="right" data-tooltip="Permite el registro de una atención odontológica ofrecida en este servicio"><i class="fa fa-lg fa-stethoscope"></i> Registrar Consulta</a></li>
			<li><a href="registrar_informe" class="tooltipped" data-position="right" data-tooltip="Permite el registro de cualidades especiales de un paciente"><i class="fa fa-lg fa-pencil"></i> Registrar Informe</a></li>
			<li><a href="actualizar_informe" class="tooltipped" data-position="right" data-tooltip="Busca un paciente en los registros y permite actualizar su informe"><i class="fa fa-lg fa-refresh"></i> Actualizar Informe</a></li>
			<li><a class="tooltipped" data-position="right" data-tooltip="Regresa al menú principal" style="cursor: pointer;" onclick="top.location.href = '../'"><i class="fa fa-lg fa-arrow-left"></i> Volver</a></li>
		</ul>
		<br><br>
		<div class="row">
			<form id="formulario" class="col s12" method="post" action="create">
				<!--Progressbar-->
				<ul class='progress'>
					<li class="active f1">Identificación del Paciente</li>
					<li>Selección de la Pieza Dental</li>
					<li>Registrar Consulta</li>
				</ul>
				<br><br>
				<fieldset class="campo-morado">
					<a data-target="slide-out" class="sidenav-trigger">
						<h5 class="blanco f1"><img class="tooltipped menui" src="../../../src/img/menutra.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Identificación del Paciente</h5>
					</a>
					<div class="row">
						<div class="input-field col s6">
							<input id="cedula" type="text" class="validate identificacion blanco" name="ci" autocomplete="off" required="">
							<label for="cedula">Número de cédula</label>
						</div>
						<div class="input-field col s6">
							<input id="result" type="text" class="validate blanco" onkeyup="this.value=Letras(this.value)" maxlength="30" name="nombre" autocomplete="off" required="" readonly="">
							<label for="result"> Nombres</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<input id="ape" type="text" hidden="true">
						</div>
						<div class="input-field col s6">
							<input id="date" type="text" class="validate blanco" onkeyup="this.value=Numeros(this.value)" autocomplete="off" required="" readonly="">
							<label for="date"> Edad</label>
						</div>
					</div>
					<input id="t1" disabled="disabled" class="btn-verde in-right siguiente sp tooltipped" type="button" value="Siguiente" data-position="left" data-tooltip="Avanza hacia el siguiente recuadro">
					<input class="btn-azul in-left tooltipped" type="button" onclick="buscar(); activarbt1();"  value="Buscar" data-position="bottom" data-tooltip="Comprueba sí el paciente ya esta registrado">
					<input class="btn-gris in-left2 tooltipped" type="reset" value="Borrar Formulario" data-position="right" data-tooltip="Vacia todos los campos del formulario" onclick="desactivarbt1();">
				</fieldset>
				<fieldset class="campo-morado" style="display: none;">
					<h5 class="blanco">Selección de la Pieza Dental</h5>
					<div class='row center-block center'>
						<div class='col s12'>
							<img id='odonto' src='../../../src/img/odontodiagrama.png' width='716' height='349' usemap='#odontodiagrama' alt="" onmouseover="$('img[usemap]').rwdImageMaps();">
							<map name='odontodiagrama'>
								<area onclick='paso1(); pieza(18);' title='TMSI-18' alt='TMSI-18' shape='circle' coords='25,95,12' href='#'>
								<area onclick='paso1(); pieza(17);' title='SMSI-17' shape='circle' coords='78,94,12' href='#'>
								<area onclick='paso1(); pieza(16);' title='PMSI-16' shape='circle' coords='134,93,13' href='#'>
								<area onclick='paso1(); pieza(15);' title='SPSI-15' shape='circle' coords='179,95,10' href='#'>
								<area onclick='paso1(); pieza(14);' title='PPSI-14' shape='circle' coords='215,96,10' href='#'>
								<area onclick='paso1(); pieza(13);' title='CSI-13' shape='circle' coords='259,94,12' href='#'>
								<area onclick='paso1(); pieza(12);' title='SISI-12' shape='circle' coords='300,95,12' href='#'>
								<area onclick='paso1(); pieza(11);' title='PISI-11' shape='circle' coords='340,95,12' href='#'>
								<area onclick='paso1(); pieza(28);' title='TMSD-28' shape='circle' coords='692,95,12' href='#'>
								<area onclick='paso1(); pieza(27);' title='SMSD-27' shape='circle' coords='640,94,12' href='#'>
								<area onclick='paso1(); pieza(26);' title='PMSD-26' shape='circle' coords='584,94,13' href='#'>
								<area onclick='paso1(); pieza(25);' title='SPSD-25' shape='circle' coords='539,96,10' href='#'>
								<area onclick='paso1(); pieza(24);' title='PPSD-24' shape='circle' coords='502,96,10' href='#'>
								<area onclick='paso1(); pieza(23);' title='CSD-23' shape='circle' coords='459,94,12' href='#'>
								<area onclick='paso1(); pieza(22);' title='SISD-22' shape='circle' coords='418,95,12' href='#'>
								<area onclick='paso1(); pieza(21);' title='PISD-21' shape='circle' coords='378,95,12' href='#'>
								<area onclick='paso1(); pieza(38);' title='TMID-38' shape='circle' coords='688,257,12' href='#'>
								<area onclick='paso1(); pieza(37);' title='SMID-37' shape='circle' coords='636,258,12' href='#'>
								<area onclick='paso1(); pieza(36);' title='PMID-36' shape='circle' coords='579,257,13' href='#'>
								<area onclick='paso1(); pieza(35);' title='SPID-35' shape='circle' coords='529,258,10' href='#'>
								<area onclick='paso1(); pieza(34);' title='PPID-34' shape='circle' coords='495,259,10' href='#'>
								<area onclick='paso1(); pieza(33);' title='CID-33' shape='circle' coords='456,257,12' href='#'>
								<area onclick='paso1(); pieza(32);' title='SIID-32' shape='circle' coords='418,257,12' href='#'>
								<area onclick='paso1(); pieza(31);' title='PIID-31' shape='circle' coords='381,257,12' href='#'>
								<area onclick='paso1(); pieza(48);' title='TMII-48' shape='circle' coords='27,257,12' href='#'>
								<area onclick='paso1(); pieza(47);' title='SMII-47' shape='circle' coords='81,259,12' href='#'>
								<area onclick='paso1(); pieza(46);' title='PMII-46' shape='circle' coords='138,257,13' href='#'>
								<area onclick='paso1(); pieza(45);' title='SPII-45' shape='circle' coords='186,258,10' href='#'>
								<area onclick='paso1(); pieza(44);' title='PPII-44' shape='circle' coords='220,259,10' href='#'>
								<area onclick='paso1(); pieza(43);' title='CII-43' shape='circle' coords='260,258,12' href='#'>
								<area onclick='paso1(); pieza(42);' title='SIII-42' shape='circle' coords='299,257,12' href='#'>
								<area onclick='paso1(); pieza(41);' title='PIII-41' shape='circle' coords='336,257,12' href='#'>
							</map>
						</div>
						<div class='col s12' style='margin-top: 4%;'>
							<button type='button' id='pieza' class='btn-verde' onclick='paso2();' hidden style="float: none;"></button>
							<input type='hidden' id='pieza2' name='pieza'>
						</div>
					</div>
					<input id="t2" disabled="disabled" class="btn-azul in-right siguiente tooltipped" type="button" disable value="Siguiente" data-position="left" data-tooltip="Avanza hacia el siguiente recuadro">
					<input class="btn-verde in-left atras tooltipped" type="button" value="Atras" data-position="right" data-tooltip="Regresa hacia el recuadro anterior">
				</fieldset>
				<fieldset class="campo-morado" style="display: none;">
					<div class="row">
						<div class='input-field box mx-auto center col s12'>
							<label class="checki custom-checkbox" style="margin-left: 5%;">
								<input type="hidden"/>
								<input class="custom-checkbox-input conditional-check" name="restrict_access" id="restrict_access" type="checkbox">
								<span class="checkmark consultD"></span><span id="paciente" class="custom-checkbox-text blanco"></span>
							</label>
						</div>
					</div>
					<br><br>
					<div class="row">
						<div class="dropdown input-field col s12 conditional hidden" id='conditional' style="margin-bottom: -5%;margin-top: -3.5%;">
							<select name='country_list' id='TrataList' class='browser-default trata-list rounded-bottom'>
								<optgroup label="Seleccionar operaciones" selected>
									<option value='Atención de Emergencia'>Atención de Emergencia</option>
									<option value='Operatorias Dental'>Operatorias Dental</option>
									<option value='Sellantes de Fosa y Fisura'>Sellantes de Fosa y Fisura</option>
									<option value='Endodoncia'>Endodoncia</option>
									<option value='Cirugia Dental'>Cirugia Dental</option>
									<option value='Profilaxis'>Profilaxis</option>
									<option value='Tratectomia'>Tratectomia</option>
									<option value='Raspado y Alisado'>Raspado y Alisado</option>
									<option value='Topificación de Flúor'>Topificación de Flúor</option>
									<option value='Control Dental Preventivo'>Control Dental Preventivo</option>
									<option value='Administración de Medicamento'>Administración de Medicamento</option>
									<option value='Radiagrofia Panóramica'>Radiagrofia Panóramica</option><!--OTRO TIPO DE RADIOGRAFIA-->
								</optgroup>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="input-field center blanco col s12">
							<p class='avisog text-center rounded-right'><strong style="font-size: 15px;">La Siguiente Consulta será registrada sobre la pieza:</strong><br><strong id='diente' class='aviso'></strong></p>
							<div class='tratamientos rounded-top' id='tratamientos'></div>
						</div>
					</div>
					<br><br>
					<div class="row">
						<div class="input-field col s12">
							<textarea id='tdiag11' class='materialize-textarea blanco' required="" autocomplete='off' rows='3' name='diagnostico1' maxlength='135'></textarea>
							<label for="tdiag11">Diagnóstico</label>
						</div>
					</div>
					<div id="diag2" class="row" hidden="">
						<div class="input-field col s12">
							<textarea id='tdiag21' class='materialize-textarea blanco' autocomplete='off' rows='3' name='diagnostico2' maxlength='135'></textarea>
							<label for="tdiag21">Diagnóstico 2</label>
						</div>
					</div>
					<div id="diag3" class="row" hidden="">
						<div class="input-field col s12">
							<textarea id='tdiag31' class='materialize-textarea blanco' autocomplete='off' rows='3' name='diagnostico3' maxlength='135'></textarea>
							<label for="tdiag31">Diagnóstico 3</label>
						</div>
					</div>
					<input id="registrarc" class="btn-azul in-right tooltipped" type="submit" value="Registrar" data-position="left" data-tooltip="Registra los datos proporcionados">
					<input class="btn-verde in-left atras tooltipped" type="button" value="Atras" data-position="right" data-tooltip="Regresa hacia el recuadro anterior">
				</fieldset>
			</form>
		</div>
		<script src="../../../src/js/jquery-mask.js"></script>
		<script src="../../../src/js/materialize.js"></script>
		<script src="../../../src/js/main.js"></script>
		<script src="../../../src/js/pac.js"></script>
		<script src="../../../src/js/trata.js"></script>
		<script src="../../../src/js/tratado.js"></script>
		<script  src='../../../src/js/rwdImageMaps.js'></script>
	</body>
	</html>
	<?php
}
else
{	// Usuario que no se ha logueado
	echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";									header('Refresh: 5; http://odontologia.uptm/SIWGO'); //redirect
}?>
