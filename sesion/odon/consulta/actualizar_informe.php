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
    <ul id="slide-out" class="sidenav">
      <li><a href="registrar" class="tooltipped" data-position="right" data-tooltip="Permite el registro de una atención odontológica ofrecida en este servicio"><i class="fa fa-lg fa-stethoscope"></i> Registrar Consulta</a></li>
      <li><a href="registrar_informe" class="tooltipped" data-position="right" data-tooltip="Permite el registro de cualidades especiales de un paciente"><i class="fa fa-lg fa-pencil"></i> Registrar Informe</a></li>
      <li><a href="actualizar_informe" class="tooltipped" data-position="right" data-tooltip="Busca un paciente en los registros y permite actualizar su informe"><i class="fa fa-lg fa-refresh"></i> Actualizar Informe</a></li>
      <li><a class="tooltipped" data-position="right" data-tooltip="Regresa al menú principal" style="cursor: pointer;" onclick="top.location.href = '../'"><i class="fa fa-lg fa-arrow-left"></i> Volver</a></li>
    </ul>
    <br><br>
    <div class="row">
      <form id="formulario" class="col s12" method="post" action="update_i">
        <!--Progressbar-->
        <ul class='progress'>
          <li class="active f1">Identificación del Paciente</li>
          <li>Redacción del Informe</li>
          <li>Finalizar Actualización</li>
        </ul>
        <br><br>
        <fieldset class="campo-morado">
          <a data-target="slide-out" class="sidenav-trigger">
            <h5 class="blanco f1"><img class="tooltipped menui" src="../../../src/img/menutra.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Identificación del Paciente</h5>
          </a>
          <div class="row">
            <div class="input-field col s6">
              <input id="cedula" type="text" class="validate identificacion blanco" name="ci" autocomplete="off" required="" onchange="desactivarbt1();">
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
          <h5 class="blanco">Actualización del Informe</h5>
          <div class='row center-block center'>
            <div class="input-field col s6">
              <textarea id="aspecto" class='materialize-textarea blanco' required autocomplete='off' name='aspecto' maxlength='535' value=''> </textarea>
              <label for="aspecto">Aspecto extraoral</label>
              
            </div>
            <div class="input-field col s6">
              <textarea id="hallazgo" class='materialize-textarea blanco' required autocomplete='off' name='hallazgo' maxlength='535' value=''> </textarea>
              
              <label for="hallazgo">Hallazgos clínicos bucales de importancia</label>
            </div>
          </div>
          <div class='row center-block center'>
            <div class="input-field col s6">
              <textarea id="observacion" class='materialize-textarea blanco' required autocomplete='off' name='observacion' maxlength='535' value=''> </textarea>
              <label for="observacion">Observaciones percibidas del paciente</label>
              
            </div>
            <div class="input-field col s6">
              <textarea id="respuesta" class='materialize-textarea blanco' required autocomplete='off' name='respuesta' maxlength='535' value=''> </textarea>
              
              <label for="respuesta">Respuestas positivas</label>
            </div>
            
          </div>
          <input id="ai" disabled="disabled" class="btn-azul in-right siguiente tooltipped" type="submit" value="Actualizar Informe" data-position="left" data-tooltip="Actualiza los datos escritos">
          <input class="btn-verde in-left atras tooltipped" type="button" value="Atras" data-position="right" data-tooltip="Regresa hacia el recuadro anterior">
        </fieldset>
        <fieldset class="campo-morado" style="display: none;">
          <h5 class="blanco">Finalizar Actualización</h5>
          <div align="center">
            <img src="../../../src/img/saltos.gif">
          </div>
          <input class="btn-verde in-left atras tooltipped" type="button" value="Atras"  data-position="right" data-tooltip="Regresa hacia el recuadro anterior">
        </fieldset>
      </form>
    </div>
    <script src='../../../src/js/jquery-3.js'></script>
    <script src="../../../src/js/jquery-mask.js"></script>
    <script src="../../../src/js/materialize.js"></script>
    <script src="../../../src/js/main.js"></script>
    <script src="../../../src/js/pac3.js"></script>
    <script src="../../../src/js/regularidad.js"></script>
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