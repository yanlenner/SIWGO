<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/materialize">
    <link rel="stylesheet" href="../src/css/style">
  </head>
  <body>
    <?php
    $lunes = 1; $martes = 2; $miercoles = 3; $jueves = 4; $viernes = 5; # De Lunes a Viernes
    $desde = 7; # Desde las siete de la mañana
    $hasta = 18; # Hasta la seis de la tarde
    $dia_actual = intval(date("w")); #Convertir siempre a entero para evitar errores
    $hora_actual = intval(date("H"));
    if ($dia_actual === $lunes || $dia_actual === $martes || $dia_actual === $miercoles || $dia_actual === $jueves || $dia_actual === $viernes) {
    if ($hora_actual >= $desde && $hora_actual < $hasta)
    {?>
    <div class="row">
      <form id="formulario" class="col s12" method="post" action="nuevo2">
        <ul class='progress'>
          <li class="active">Datos personales</li>
          <li>Datos de acceso</li>
        </ul>
        <br>
        <fieldset class="campo-morado">
          <h5 class="blanco">Datos personales</h5>
          <div class="row">
            <div class="input-field col s6">
              <input id="ci" type="text" class="validate identificacion blanco" name="cedula" autocomplete="off" required="">
              <label for="ci">Número de cédula</label>
            </div>
            <div class="input-field col s6">
              <input id="fecha" type="text" class="validate datepicker blanco" name="fecha" onkeyup="this.value=NoEscribir(this.value)" autocomplete="off" required="">
              <label for="fecha">Fecha de nacimiento</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="nombre" type="text" class="validate blanco" name="nombre"  onkeyup="this.value=Letras(this.value)" maxlength="30" autocomplete="off" required="">
              <label for="nombre"> Nombres</label>
            </div>
            <div class="input-field col s6">
              <input id="apellido" type="text" class="validate blanco" name="apellido" onkeyup="this.value=Letras(this.value)" maxlength="30" autocomplete="off" required="">
              <label for="apellido"> Apellidos</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="numero" type="text" class="validate blanco" name="telefono" onkeyup="this.value=Numeros(this.value)" maxlength="12" autocomplete="off" required="">
              <label for="numero"> Número de celular/teléfono</label>
            </div>
            <div class="input-field col s6 demo-masked-input">
              <input id="email" type="text" class="validate blanco email" name="correo"  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" maxlength="30" autocomplete="off" required="">
              <label for="email"> Correo electrónico</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="codigo" type="text" class="validate blanco" name="mpps" onkeyup="this.value=Numeros(this.value)" maxlength="9" autocomplete="off">
              <label for="codigo"> Código M.P.P.S.</label>
            </div>
            <div class="input-field col s6">
              <p>
                <label>
                  <input class="with-gap" name="sex" type="radio" value="H" checked/>
                  <span class="gen"> Hombre </span>
                </label>
                <label>
                  <input class="with-gap" name="sex" type="radio" value="M" />
                  <span class="gen">Mujer</span>
                </label>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="direccion" type="text" class="validate blanco" name="domicilio" onkeyup="this.value=Dir(this.value)" maxlength="50" autocomplete="off" required="">
              <label for="direccion"> Dirección de domicilio</label>
            </div>
          </div>
          <input class="btn-verde in-right siguiente tooltipped" type="button" value="Siguiente" data-position="left" data-tooltip="Avanza hacia el siguiente recuadro">
          <input class="btn-gris in-left tooltipped" type="reset" value="Borrar Formulario" data-position="right" data-tooltip="Vacia todos los campos del formulario">
        </fieldset>
        <fieldset class="campo-morado" style="display: none;">
          <h5 class="blanco">Datos de acceso</h5>
          <div class="row">
            <div class="input-field col s6">
              <input id="usr" type="text" class="validate blanco" autocomplete="off" name="usuario" maxlength="10" onkeyup="this.value=Letras(this.value)" required>
              <label for="usr">Usuario</label>
            </div>
            <div class="input-field col s6">
              <input id="pass" type="password" class="validate blanco" autocomplete="off" name="clave" maxlength="32" required>
              <label for="pass">Contraseña</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
            </div>
            <div class="input-field col s6">
              <input id="respuesta" type="text" class="validate blanco" autocomplete="off" name="respuesta" maxlength="32" required>
              <label for="respuesta">Respuesta de seguridad Anti-Phishing</label>
            </div>
          </div>
          <input id="registrarse" class="btn-azul in-right tooltipped" type="button" value="Registrar Usuario" data-position="left" data-tooltip="Registra tus datos para luego acceder al sistema">
          <input class="btn-verde in-left atras tooltipped" type="button" value="Atras" data-position="right" data-tooltip="Regresa hacia el recuadro anterior">
        </fieldset>
      </form>
    </div>
  <?php }
    else
    echo "<marquee width='70%' style='font-size:1.5rem; font-family: Merienda, cursive;'>
    S.I.W.G.O. No presta Servicios a esta hora del día</marquee><div class='carga' style='text-align: center;'>
      <img class='diente2' src='../src/img/baile.gif'/>
      <br/><strong>Horario Laborable</strong><br>07:00 AM hasta 06:00 PM
    </div>";
    } else {
    echo "<marquee width='70%' style='font-size:1.5rem; font-family: Merienda, cursive;'>S.I.W.G.O. No presta Servicios el día de hoy</marquee><div class='carga' style='text-align: center;'>
      <img class='diente2' src='../src/img/baile.gif'/>
      <br/><strong>Horario Laborable</strong><br>Lunes a Viernes
    </div>";
    }
    ?>  <script src="../src/js/jquery-3.js"></script>
    <script src="../src/js/jquery-md5.js"></script>
    <script src="../src/js/jquery-inputmask.js"></script>
    <script src="../src/js/jquery-mask.js"></script>
    <script src="../src/js/materialize.js"></script>
    <script src="../src/js/main.js"></script>
    <script src="../src/js/new.js"></script>
    <script type="text/javascript">
$(function () {
  $('.demo-masked-input').find('.email').inputmask({
    alias: 'email'
  })
}),
$('email').mouseout(function () {
  $(this).val(),
  new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/)
})
    </script>
  </body>
</html>
