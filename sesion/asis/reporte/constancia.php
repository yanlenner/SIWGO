<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['nivel'] =='a'){
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
    <meta charset="utf-8" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../src/css/font-awesome">
    <link rel="stylesheet" href="../../../src/css/materialize">
    <link rel="stylesheet" href="../../../src/css/style2">
    <link rel="stylesheet" href="../../../src/css/navbar">
  </head>
  <body>
    <header>
      <h2>Sistema de Información Web para la Gestión de Pacientes del Servicio Odontológico "Kléber Ramírez"</h2>
      <nav class="fill">
        <ul class="right">
          <li><a href="../perfil">Gestionar Perfil del Paciente</a></li>
          <li><a id="puesto">Emisión de Reportes</a></li>
          <li><a href="../salir">Terminar Sesión</a></li>
        </ul>
      </nav>
    </header>
    <ul id="slide-out" class="sidenav">
      <li><a href="historia" class="tooltipped" data-position="right" data-tooltip="Muestra todos los registros vinculados al paciente"><i class="fa fa-lg fa-book"></i> Historia Clínica</a></li>
      <li><a href="constancia" class="tooltipped" data-position="right" data-tooltip="Facilita la certificación de constancia para uso del paciente"><i class="fa fa-lg fa-file-pdf-o"></i> Constancia</a></li>
      <li><a href="estadistica" class="tooltipped" data-position="right" data-tooltip="Realiza consultas para proporcionar datos estadisticos confiables"><i class="fa fa-lg fa-line-chart"></i> Estadística</a></li>
      <li><a class="tooltipped" data-position="right" data-tooltip="Regresa al menú principal" style="cursor: pointer;" onclick="top.location.href = '../'"><i class="fa fa-lg fa-arrow-left"></i> Volver</a></li>
    </ul>
    <br><br>
    <div class="row">
      <form class="col s12" method="post" action="c0ns">
        <fieldset class="campo-morado">
          <a data-target="slide-out" class="sidenav-trigger">
            <h5 class="blanco"><img class="tooltipped menui" src="../../../src/img/menurep.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Datos para la Constancia</h5>
          </a>
          <div class="row">
            <div class="input-field col s6">
              <input id="cedula" type="text" class="validate identificacion blanco" name="ci" autocomplete="off" required="">
              <label for="cedula"> Número de cédula</label>
            </div>
            <div class="input-field col s6">
              <p>
                <label>
                  <input class="with-gap" name="rt" type="radio" value="no" checked="" />
                  <span class="gen"> No </span>
                </label>
                <i class="fa fa-2x fa-user-md tooltipped" style="margin-left: 10%; margin-right: 10%;" data-position="top" data-tooltip="¿Se le ha indicado tratamiento al paciente?"></i>
                <label>
                  <input class="with-gap" name="rt" type="radio" value="si"/>
                  <span class="gen"> Si </span>
                </label>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="result" type="text" class="validate blanco" maxlength="30" autocomplete="off" onkeyup="this.value=Letras(this.value)" required="" readonly="">
              <label for="result">Nombres</label>
            </div>
            <div class="input-field col s6">
              <input id="date" type="text" class="validate blanco" maxlength="2" autocomplete="off" onkeyup="this.value=Numeros(this.value)" required="" readonly="">
              <label for="date">Edad</label>
            </div>
          </div>
          <div class="row">
            <div id="dias" class="input-field col s6" hidden>
              <input id="dias" type="text" class="validate blanco" name="dias" autocomplete="off" onkeyup="this.value=Reposo(this.value)" maxlength="1">
              <label for="dias"> Días de reposo</label>
            </div>
            <div class="input-field col s6">
              <p>
                <label>
                  <input class="with-gap" name="rr" type="radio" value="no" checked="" />
                  <span class="gen"> No </span>
                </label>
                <i class="fa fa-2x fa-hotel tooltipped" style="margin-left: 10%; margin-right: 10%;" data-position="top" data-tooltip="¿El paciente amerita reposo?"></i>
                <label>
                  <input class="with-gap" name="rr" type="radio" value="si"/>
                  <span class="gen"> Si </span>
                </label>
              </p>
            </div>
          </div>
        </fieldset>
        <input class="btn-azul in-right tooltipped" type="submit" disabled value="Emitir Constancia" data-position="left" data-tooltip="En formato de impresión">
        <input class="btn-azul in-left tooltipped" type="button" onclick="atend(); buscar(); verificar();"  value="Buscar" data-position="bottom" data-tooltip="Comprueba sí el paciente ya esta registrado y también si ha sido atendido">
        <input class="btn-gris in-left2 tooltipped" type="reset" onclick="desactivar(); hr();" value="Borrar Formulario" data-position="right" data-tooltip="Vacia todos los campos del formulario">
      </form>
    </div>
    <script src="../../../src/js/jquery-3.js"></script>
    <script src="../../../src/js/jquery-mask.js"></script>
    <script src="../../../src/js/materialize.js"></script>
    <script src="../../../src/js/main.js"></script>
    <script src="../../../src/js/pac.js"></script>
    <script src="../../../src/js/atendido.js"></script>
    <script src="../../../src/js/constancia.js"></script>
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