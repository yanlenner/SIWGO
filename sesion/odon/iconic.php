<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['nivel'] =='o'){
  $fechaGuardada = $_SESSION["ultimoAcceso"];
  $ahora = date("Y-n-j H:i:s");
  $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
//comparamos el tiempo transcurrido
  if($tiempo_transcurrido < 0 || $tiempo_transcurrido > 599)
  {
//si pasaron 10 minutos o más
    include '../../src/php/enlace.php';
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
    header("Location:../../",TRUE,301);
    mysqli_close($enlace);
  }
  else
    $_SESSION["ultimoAcceso"] = $ahora;
  ?>
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="utf-8" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/css/bootstrap">
    <style type="text/css">
      ul{list-style-type:none}a,a:focus,a:hover,a:visited{text-decoration:none}nav{position:relative;width:70vmin;height:70vmin;min-width:500px;min-height:500px;margin:0 auto;overflow:hidden}#menuBtn{position:absolute;top:45%;left:45%;width:10%;height:10%;z-index:2;will-change:transform}#menuBtn svg{display:block}#menuBtn svg polygon:hover{-webkit-animation:hexHover .7s;animation:hexHover .7s;cursor:pointer}#menuBtn span{position:absolute;top:50%;left:50%;width:20px;height:2px;padding:8px 0;background-clip:content-box;background-color:#585247;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);transition:background-color .3s;pointer-events:none}#menuBtn span:after,#menuBtn span:before{position:absolute;background-color:#585247;content:'';width:20px;height:2px;transition:-webkit-transform .3s;transition:transform .3s;transition:transform .3s,-webkit-transform .3s}#menuBtn span:before{top:0}#menuBtn span:after{bottom:0}@-webkit-keyframes hexHover{0%{stroke-dasharray:0,0,300}10%{stroke-dasharray:0,20,300}100%{stroke-dasharray:300,20,300}}@keyframes hexHover{0%{stroke-dasharray:0,0,300}10%{stroke-dasharray:0,20,300}100%{stroke-dasharray:300,20,300}}#hex{position:absolute;top:0;left:0;width:100%;height:100%;-webkit-transform:scale(.1) translatez(0);transform:scale(.1) translatez(0);transition:-webkit-transform 50ms .3s;transition:transform 50ms .3s;transition:transform 50ms .3s,-webkit-transform 50ms .3s}.tr{position:absolute;left:50%;bottom:50%;width:34.6%;height:40%;-webkit-transform-origin:0 100%;transform-origin:0 100%;overflow:hidden;-webkit-transform:skewY(-30deg);transform:skewY(-30deg);opacity:0}.tr:nth-child(1){-webkit-transform:rotate(0) skewY(-30deg);transform:rotate(0) skewY(-30deg);transition:opacity .3s,-webkit-transform .3s;transition:opacity .3s,transform .3s;transition:opacity .3s,transform .3s,-webkit-transform .3s}.tr:nth-child(1) .clip{-webkit-transform:skewY(30deg) rotate(30deg);transform:skewY(30deg) rotate(30deg)}.tr:nth-child(1) .content{-webkit-transform:rotate(-30deg);transform:rotate(-30deg);-webkit-transform-origin:0 0;transform-origin:0 0;padding-left:15%;-webkit-perspective-origin:30% 70%;perspective-origin:30% 70%}.active .tr:nth-child(1){-webkit-transform:rotate(0) skewY(-30deg) translate(10%,-10%);transform:rotate(0) skewY(-30deg) translate(10%,-10%);transition:opacity .3s 50ms,-webkit-transform .3s 50ms cubic-bezier(0,2.3,.8,1);transition:opacity .3s 50ms,transform .3s 50ms cubic-bezier(0,2.3,.8,1);transition:opacity .3s 50ms,transform .3s 50ms cubic-bezier(0,2.3,.8,1),-webkit-transform .3s 50ms cubic-bezier(0,2.3,.8,1)}.tr:nth-child(2){-webkit-transform:rotate(60deg) skewY(-30deg);transform:rotate(60deg) skewY(-30deg);transition:opacity .3s,-webkit-transform .3s;transition:opacity .3s,transform .3s;transition:opacity .3s,transform .3s,-webkit-transform .3s}.tr:nth-child(2) .clip{-webkit-transform:skewY(30deg) rotate(30deg);transform:skewY(30deg) rotate(30deg)}.tr:nth-child(2) .content{-webkit-transform:rotate(-90deg);transform:rotate(-90deg);top:-8%;left:6.67%;padding-left:30%;-webkit-perspective-origin:30% 50%;perspective-origin:30% 50%}.active .tr:nth-child(2){-webkit-transform:rotate(60deg) skewY(-30deg) translate(15%,-15%);transform:rotate(60deg) skewY(-30deg) translate(15%,-15%);transition:opacity .3s 80ms,-webkit-transform .3s 80ms cubic-bezier(0,2.3,.8,1);transition:opacity .3s 80ms,transform .3s 80ms cubic-bezier(0,2.3,.8,1);transition:opacity .3s 80ms,transform .3s 80ms cubic-bezier(0,2.3,.8,1),-webkit-transform .3s 80ms cubic-bezier(0,2.3,.8,1)}.tr:nth-child(3){-webkit-transform:rotate(120deg) skewY(-30deg);transform:rotate(120deg) skewY(-30deg);transition:opacity .3s,-webkit-transform .3s;transition:opacity .3s,transform .3s;transition:opacity .3s,transform .3s,-webkit-transform .3s}.tr:nth-child(3) .clip{-webkit-transform:skewY(30deg) rotate(30deg);transform:skewY(30deg) rotate(30deg)}.tr:nth-child(3) .content{-webkit-transform:rotate(-150deg);transform:rotate(-150deg);-webkit-transform-origin:42.3% 36.5%;transform-origin:42.3% 36.5%;padding-left:10%;-webkit-perspective-origin:30% 30%;perspective-origin:30% 30%}.active .tr:nth-child(3){-webkit-transform:rotate(120deg) skewY(-30deg) translate(10%,-10%);transform:rotate(120deg) skewY(-30deg) translate(10%,-10%);transition:opacity .3s .11s,-webkit-transform .3s .11s cubic-bezier(0,2.3,.8,1);transition:opacity .3s .11s,transform .3s .11s cubic-bezier(0,2.3,.8,1);transition:opacity .3s .11s,transform .3s .11s cubic-bezier(0,2.3,.8,1),-webkit-transform .3s .11s cubic-bezier(0,2.3,.8,1)}.tr:nth-child(4){-webkit-transform:rotate(180deg) skewY(-30deg);transform:rotate(180deg) skewY(-30deg);transition:opacity .3s,-webkit-transform .3s;transition:opacity .3s,transform .3s;transition:opacity .3s,transform .3s,-webkit-transform .3s}.tr:nth-child(4) .clip{-webkit-transform:skewY(30deg) rotate(30deg);transform:skewY(30deg) rotate(30deg)}.tr:nth-child(4) .content{-webkit-transform:rotate(-210deg);transform:rotate(-210deg);-webkit-transform-origin:65.4% 38.4%;transform-origin:65.4% 38.4%;padding-left:30%;-webkit-perspective-origin:70% 30%;perspective-origin:70% 30%}.active .tr:nth-child(4){-webkit-transform:rotate(180deg) skewY(-30deg) translate(10%,-10%);transform:rotate(180deg) skewY(-30deg) translate(10%,-10%);transition:opacity .3s .14s,-webkit-transform .3s .14s cubic-bezier(0,2.3,.8,1);transition:opacity .3s .14s,transform .3s .14s cubic-bezier(0,2.3,.8,1);transition:opacity .3s .14s,transform .3s .14s cubic-bezier(0,2.3,.8,1),-webkit-transform .3s .14s cubic-bezier(0,2.3,.8,1)}.tr:nth-child(5){-webkit-transform:rotate(240deg) skewY(-30deg);transform:rotate(240deg) skewY(-30deg);transition:opacity .3s,-webkit-transform .3s;transition:opacity .3s,transform .3s;transition:opacity .3s,transform .3s,-webkit-transform .3s}.tr:nth-child(5) .clip{-webkit-transform:skewY(30deg) rotate(30deg);transform:skewY(30deg) rotate(30deg)}.tr:nth-child(5) .content{-webkit-transform:rotate(-270deg);transform:rotate(-270deg);top:-8%;left:6.67%;padding-left:15%;-webkit-perspective-origin:70% 50%;perspective-origin:70% 50%}.active .tr:nth-child(5){-webkit-transform:rotate(240deg) skewY(-30deg) translate(20%,-10%);transform:rotate(240deg) skewY(-30deg) translate(20%,-10%);transition:opacity .3s .17s,-webkit-transform .3s .17s cubic-bezier(0,2.3,.8,1);transition:opacity .3s .17s,transform .3s .17s cubic-bezier(0,2.3,.8,1);transition:opacity .3s .17s,transform .3s .17s cubic-bezier(0,2.3,.8,1),-webkit-transform .3s .17s cubic-bezier(0,2.3,.8,1)}.tr:nth-child(6){-webkit-transform:rotate(300deg) skewY(-30deg);transform:rotate(300deg) skewY(-30deg);transition:opacity .3s,-webkit-transform .3s;transition:opacity .3s,transform .3s;transition:opacity .3s,transform .3s,-webkit-transform .3s}.tr:nth-child(6) .clip{-webkit-transform:skewY(30deg) rotate(30deg);transform:skewY(30deg) rotate(30deg)}.tr:nth-child(6) .content{-webkit-transform:rotate(-330deg);transform:rotate(-330deg);-webkit-transform-origin:106.7% 25.2%;transform-origin:106.7% 25.2%;padding-left:30%;-webkit-perspective-origin:70% 70%;perspective-origin:70% 70%}.active .tr:nth-child(6){-webkit-transform:rotate(300deg) skewY(-30deg) translate(10%,-10%);transform:rotate(300deg) skewY(-30deg) translate(10%,-10%);transition:opacity .3s .2s,-webkit-transform .3s .2s cubic-bezier(0,2.3,.8,1);transition:opacity .3s .2s,transform .3s .2s cubic-bezier(0,2.3,.8,1);transition:opacity .3s .2s,transform .3s .2s cubic-bezier(0,2.3,.8,1),-webkit-transform .3s .2s cubic-bezier(0,2.3,.8,1)}.tr:nth-child(7){-webkit-transform:rotate(360deg) skewY(-30deg);transform:rotate(360deg) skewY(-30deg);transition:opacity .3s,-webkit-transform .3s;transition:opacity .3s,transform .3s;transition:opacity .3s,transform .3s,-webkit-transform .3s}.tr:nth-child(7) .clip{-webkit-transform:skewY(30deg) rotate(30deg);transform:skewY(30deg) rotate(30deg)}.tr:nth-child(7) .content{-webkit-transform:rotate(-390deg);transform:rotate(-390deg)}.active .tr:nth-child(7){-webkit-transform:rotate(360deg) skewY(-30deg) translate(10%,-10%);transform:rotate(360deg) skewY(-30deg) translate(10%,-10%);transition:opacity .3s .23s,-webkit-transform .3s .23s cubic-bezier(0,2.3,.8,1);transition:opacity .3s .23s,transform .3s .23s cubic-bezier(0,2.3,.8,1);transition:opacity .3s .23s,transform .3s .23s cubic-bezier(0,2.3,.8,1),-webkit-transform .3s .23s cubic-bezier(0,2.3,.8,1)}.clip{position:absolute;top:0;left:0;width:116%;height:86.66%;overflow:hidden;-webkit-transform-origin:0 0;transform-origin:0 0}.content{position:absolute;width:86.6%;height:116%;top:0;left:0;box-sizing:border-box;font-size:2vmin;-webkit-perspective:500px;perspective:500px;background:0 0}.content img{position:absolute;top:0;left:-50%;right:-50%;top:25%;bottom:25%;margin:auto;height:5rem;z-index:-1;transition:opacity .3s;pointer-events:none}.content h2,.content p{position:absolute;width:50%;line-height:1em;color:#000;background:#ffffff24;opacity:0;-webkit-transform:translateZ(-50px);transform:translateZ(-50px)}.content h2{bottom:35%;text-transform:uppercase;font-weight:400;font-size:1rem;transition:opacity .3s,-webkit-transform .3s cubic-bezier(0,2.3,.8,1);transition:transform .3s cubic-bezier(0,2.3,.8,1),opacity .3s;transition:transform .3s cubic-bezier(0,2.3,.8,1),opacity .3s,-webkit-transform .3s cubic-bezier(0,2.3,.8,1)}.content p{position:absolute;top:50%;font-size:1em;transition:opacity .3s 75ms,-webkit-transform .3s 75ms cubic-bezier(0,2.3,.8,1);transition:transform .3s 75ms cubic-bezier(0,2.3,.8,1),opacity .3s 75ms;transition:transform .3s 75ms cubic-bezier(0,2.3,.8,1),opacity .3s 75ms,-webkit-transform .3s 75ms cubic-bezier(0,2.3,.8,1)}.content:hover h2,.content:hover p{opacity:1;-webkit-transform:translatez(0);transform:translatez(0)}.content:hover img{opacity:.4}.active #menuBtn:hover svg polygon{-webkit-animation:none;animation:none}.active #menuBtn span{background-color:transparent}.active #menuBtn span:before{-webkit-transform:translatey(8px) rotate(45deg);transform:translatey(8px) rotate(45deg)}.active #menuBtn span:after{-webkit-transform:translatey(-8px) rotate(-45deg);transform:translatey(-8px) rotate(-45deg)}.active #hex{-webkit-transform:scale(.9) translatez(0);transform:scale(.9) translatez(0);transition:none;will-change:transform}.active .tr{opacity:1;will-change:transform}
    </style>
  </head>
  <body title="Menú Iconico">
    <div class="container">
      <div class="row">
        <nav id="hexNav">
          <div id="menuBtn">
            <svg viewbox="0 0 100 100" >
              <polygon points="50 2 7 26 7 74 50 98 93 74 93 26" fill="transparent" stroke-width="4" stroke="#585247" stroke-dasharray="0,0,300"/>
            </svg>
            <span></span>
          </div>
          <ul id="hex">
            <li class="tr">
              <div class="clip">
                <a href="reporte/" target="_parent" class="content">
                  <img src="../../src/img/doc.png">
                  <h2 class="title">Emisión de Reportes</h2>
                </a>
              </li>
              <li class="tr">
                <div class="clip">
                  <a href="datos/" target="_parent" class="content">
                    <img src="../../src/img/server.png">
                    <h2 class="title">Gestión de Datos</h2>
                  </a>
                </li>
                <li class="tr">
                  <div class="clip">
                    <a href="salir/" target="_parent" class="content">
                      <img src="../../src/img/exit.png">
                      <h2 class="title">Terminar Sesión</h2>
                    </a>
                  </li>
                  <li class="tr">
                    <div class="clip">
                      <a href="usuario/" target="_parent" class="content">
                        <img src="../../src/img/user.png">
                        <h2 class="title">Gestión de Usuarios</h2>
                      </a>
                    </li>
                    <li class="tr">
                      <div class="clip">
                        <a href="perfil/" target="_parent" class="content">
                          <img src="../../src/img/paci.png">
                          <h2 class="title">Gestionar Perfil del Paciente</h2>
                        </a>
                      </li>
                      <li class="tr">
                        <div class="clip">
                          <a href="consulta/" target="_parent" class="content">
                            <img src="../../src/img/trat.png">
                            <h2 class="title">Registro de Consultas</h2>
                          </a>
                        </li>
                      </ul>
                    </nav>                 
                  </div>
                </div>
                <script type="text/javascript">document.oncontextmenu = function(){return false;}
                var hexNav = document.getElementById('hexNav');
                document.getElementById('menuBtn').onclick = function() {
                  var className = ' ' + hexNav.className + ' ';
                  if ( ~className.indexOf(' active ') ) {
                    hexNav.className = className.replace(' active ', ' ');
                  } else {
                    hexNav.className += ' active';
                  }              
                }</script>
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