<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/materialize">
    <link rel="stylesheet" href="../src/css/style">
    <link rel="icon" href="../src/img/favicon.png" type="image/x-icon">
    <title>Recuperar Contraseña</title>
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
    {
    ?>
    <div class="row">
      <form id="formulario" class="col s12" method="post" action="recuperar2">
        <fieldset class="campo-morado">
          <h5 class="blanco">¿Olvidaste tu contraseña?</h5>
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
              <input id="anti" type="password" class="validate blanco" name="respuesta" maxlength="32" autocomplete="off" required="">
              <label for="anti">Respuesta de seguridad Anti-Phishing</label>
            </div>
            <div class="input-field col s6">
              <input id="password" type="password" class="validate blanco" name="clave" maxlength="32" autocomplete="off" required="">
              <label for="password">Nueva contraseña</label>
            </div>
          </div>
        </fieldset>
        <input id="recuperar" class="btn-azul in-right tooltipped" type="button" value="Recuperar contraseña" data-position="left" data-tooltip="Actualiza tu contraseña para que logres ingresar">
        <input class="btn-gris in-left tooltipped" type="reset" value="Borrar Formulario" data-position="right" data-tooltip="Vacia todos los campos del formulario">
      </form>
    </div>
    <?php
    }
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
    ?>
    <script src="../src/js/jquery-3.js"></script>
    <script src="../src/js/jquery-md5.js"></script>
    <script src="../src/js/jquery-mask.js"></script>
    <script src="../src/js/materialize.js"></script>
    <script src="../src/js/main.js"></script>
    <script src="../src/js/recovery.js"></script>
  </body>
</html>
