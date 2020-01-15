<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['nivel'] =='o'){
$fechaGuardada = $_SESSION['ultimoAcceso'];
$ahora = date('Y-n-j H:i:s');
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
$_SESSION['ultimoAcceso'] = $ahora;?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/css/font-awesome">
    <link rel="stylesheet" href="../../../src/css/materialize">
    <link rel="stylesheet" href="../../../src/css/style">
    <link rel="stylesheet" href="../../../src/css/navbar">
  </head>
  <body>
    <header>
      <h2>Sistema de Información Web para la Gestión de Pacientes del Servicio Odontológico "Kléber Ramírez"</h2>
      <nav class="fill">
        <ul class="right">
          <li><a href="../usuario">Gestión de Usuarios</a></li>
          <li><a href="../perfil">Gestionar Perfil del Paciente</a></li>
          <li><a href="../consulta">Registro de Consultas</a></li>
          <li><a id="puesto">Emisión de Reportes</a></li>
          <li><a href="../datos">Gestión de Datos</a></li>
          <li><a href="../salir">Terminar Sesión</a></li>
        </ul>
      </nav>
    </header>
    <ul id="slide-out" class="sidenav">
      <li><a href="historia" class="tooltipped" data-position="right" data-tooltip="Muestra todos los registros vinculados al paciente"><i class="fa fa-lg fa-book"></i> Historia Clínica</a></li>
      <li><a href="referencia" class="tooltipped" data-position="right" data-tooltip="Proporciona el elemento necesario para que el paciente sea referido hacia otro servicio"><i class="fa fa-lg fa-file-text"></i> Referencia Médica</a></li>
      <li><a href="constancia" class="tooltipped" data-position="right" data-tooltip="Facilita la certificación de constancia para uso del paciente"><i class="fa fa-lg fa-file-pdf-o"></i> Constancia</a></li>
      <li><a href="tratamiento" class="tooltipped" data-position="right" data-tooltip="Permite generarle al paciente su tratamiento"><i class="fa fa-lg fa-columns"></i> Tratamiento</a></li>
      <li><a href="estadistica" class="tooltipped" data-position="right" data-tooltip="Realiza consultas para proporcionar datos estadisticos confiables"><i class="fa fa-lg fa-line-chart"></i> Estadística</a></li>
      <li><a class="tooltipped" data-position="right" data-tooltip="Regresa al menú principal" style="cursor: pointer;" onclick="top.location.href = '../'"><i class="fa fa-lg fa-arrow-left"></i> Volver</a></li>
    </ul>
    <br><br>
    <div class="row">
      <form class="col s12" method="post" action="e5ta">
        <fieldset class="campo-morado">
          <a data-target="slide-out" class="sidenav-trigger">
            <h5 class="blanco"><img class="tooltipped menui" src="../../../src/img/menurep.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Condición para la Estadística Descriptiva</h5>
          </a>
          <div class="row">
            <div id='e1' class="input-field col s12">
              <p>
                <label>
                  <input class="with-gap" name="tipo_reporte" type="radio" value="G"/>
                  <span class="gen"> General </span>
                </label>
                <label style='margin-left: 31%;'>
                  <input class="with-gap" name="tipo_reporte" type="radio" value="E"/>
                  <span class="gen"> Búsqueda </span>
                </label>
              </p>
            </div>
            <div id='e2' class='input-field col s12' hidden=''>
              <p class="right"><label>
                <input class="with-gap" name="e1" type="radio" value="genero"/>
                <span> Consulta por Género </span>
              </label>
              <br><br>
              <label>
                <input class="with-gap" name="e1" type="radio" value="edad"/>
                <span> Consulta por Edad </span>
              </label>
            </p>
            <p class="left">
              <label>
                <input class="with-gap" name="e2" type="radio" value="carreras"/>
                <span class="gen"> Carrera del Paciente afiliado al servicio </span>
              </label>
              <br><br>
              <label>
                <input class="with-gap" name="e2" type="radio" value="antecedentes"/>
                <span class="gen"> Antecedentes del Paciente</span>
              </label>
              <br><br>
              <label>
                <input class="with-gap" name="e2" type="radio" value="atendidos"/>
                <span class="gen"> Pacientes Atendidos</span>
              </label>
              <br><br>
              <label>
                <input class="with-gap" name="e2" type="radio" value="diagnosticos"/>
                <span class="gen"> Diagnósticos más frecuentes</span>
              </label>
              <br><br>
              <label>
                <input class="with-gap" name="e2" type="radio" value="preescripcion"/>
                <span class="gen"> Preescripciones expedidas</span>
              </label>
              <br><br>
              <label>
                <input class="with-gap" name="e2" type="radio" value="atencion"/>
                <span class="gen"> Tipo de Atención prestada</span>
              </label>
            </p>
          </div>
          <div id='e3' class='input-field col s12 center order-first' hidden=''>
          </div>
        </div>
      </fieldset>
      <input class="boton1 btn-azul in-right tooltipped" hidden data-position="left" data-tooltip="Opción seleccionada" name='opcion' value="opcion">
      <input class="boton3 btn-gris in-left tooltipped" type="reset" value="Limpiar Formulario" data-position="right" data-tooltip="Regresa al formulario a su estado inicial">
    </form>
  </div>
  <script  src='../../../src/js/jquery-3.js'></script>
  <script  src='../../../src/js/materialize.js'></script>
  <script  src='../../../src/js/main.js'></script>
  <script  src='../../../src/js/estao.js'></script>
  <script  src='../../../src/js/esta.js'></script>
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