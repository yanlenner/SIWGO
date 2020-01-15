<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/img/favicon.png" type="image/x-icon">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="../src/css/font-awesome">
    <link rel="stylesheet" href="../src/css/int">
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
    ?><header><a href="../"><img src="../src/img/banner.png"></a>
    <h1>Servicio Odontológico "Kléber Ramírez"</h1>
  </header>
  <a href="javascript:" id="return-to-top"><i class="fa fa-lg fa-chevron-up" title="Subir"></i></a>
  <iframe class="embed-responsive" style="margin-top: 5%; border: none; width:100%; height: 62rem;" src="nuevo"></iframe>
  <footer>
    <a id="pie" href="../">Programa Nacional de Formación en Informática &copy; 2019</a>
  </footer>
  <script src="../src/js/jquery-3.js"></script>
  <script type="text/javascript">
  document.oncontextmenu = function(){return false;}
  var d = new Date();
  var mes = (d.getMonth()+1);
  var dia = (d.getDate());
  if (mes == 12)
  $('img').attr('src','../src/img/bannernav.png');
  if (mes == 10 && dia == 3)
  $('img').attr('src','../src/img/bannerodo.png');
  if (mes ==  8 || mes == 7)
  $('img').attr('src','../src/img/bannerver.png');
  // ===== Scroll to Top ====
  $(window).scroll(function () {
  if ($(this).scrollTop() >= 155) { // If page is scrolled more than 155px
  $('#return-to-top').fadeIn(200); // Fade in the arrow
  } else {
  $('#return-to-top').fadeOut(200); // Else fade out the arrow
  }
  });
  $('#return-to-top').click(function () { // When arrow is clicked
  $('body,html').animate({
  scrollTop: 0 // Scroll to top of body
  }, 500);
  });
  </script>
</body>
</html>
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
