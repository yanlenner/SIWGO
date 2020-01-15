<!-- Release date: 23 de Diciembre del 2019 10:37 PM-->
<?php
session_start();
if(isset($_COOKIE[session_name()]))
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="icon" href="src/img/favicon.png" type="image/gif">
        <title>S.I.W.G.O.</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="src/css/bootstrap">
        <link rel="stylesheet" href="src/css/font-awesome">
        <link rel="stylesheet" href="src/css/ext">
    </head>
    <body>
        <script>this.top.location !== this.location && (this.top.location = this.location);</script>
        <?php
        $lunes = 1; $martes = 2; $miercoles = 3; $jueves = 4; $viernes = 5; # De Lunes a Viernes
        $desde = 7; # Desde las siete de la mañana
        $hasta = 18; # Hasta la seis de la tarde
        $dia_a = intval(date("w")); #Convertir siempre a entero para evitar errores
        $hora_a = intval(date("H"));
        if ($dia_a === $lunes || $dia_a === $martes || $dia_a === $miercoles || $dia_a === $jueves || $dia_a === $viernes) {
        if ($hora_a >= $desde && $hora_a < $hasta){  ?>
    <header align="center"><img src="src/img/banner.png" alt="Banner Institucional"></header>
    <div class="container">
        <div class="row">
            <div class="text-center col-12">
                <h4 class="titulo" id="messageLabel"></h4>
            </div>
            <div class="mx-auto col-5">
                <div class="text-center info" hidden="true">
                    <h6>Alerta</h6>
                    <p class="parp">
                    </p>
                </div>
                <form id="login" method="post" action="sesion/filtr0">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text basic-addon1"><i class="fa fa-lg fa-user-md" title="Usuario del sistema"></i></span>
                        </div>
                        <input id="usr" type="text" class="form-control" name="usr" maxlength="10" autocomplete="off" onkeyup="this.value=Valid(this.value)" required placeholder="Usuario del sistema">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text basic-addon1"><i class="fa fa-lg fa-lock" title="Contraseña de acceso"></i></span>
                        </div>
                        <input type="password" class="form-control" name="pss" placeholder="Contraseña de acceso" maxlength="32" autocomplete="off" required>
                    </div>
                    <button id="entrar" type="button" class="mx-auto btn btn-block" title="Permite ingresar al sistema">Ingresar</button>
                    <br>
                </form>
                <hr>
                <aside class="asider"> ¿Nuevo Usuario?<br>
                    <a class="reso" href="sesion/nuevo_usuario" title="Crear una cuenta">Registrarse</a>
                </aside>
                <aside class="asidel"> ¿Has Olvidado tu Contraseña?<br>
                    <a class="reso" href="sesion/recuperar_contraseña">Recuperarla</a>
                </aside>
            </div>
        </div>
    </div>
<footer>Programa Nacional de Formación en Informática &copy; <?php echo date('Y');?></footer>
<script src="src/js/jquery-3.js"></script>
<script src="src/js/jquery-mask.js"></script>
<script src="src/js/jquery-md5.js"></script>
<script src="src/js/typescript.js"></script>
<script src="src/js/login.js"></script>
</body>
</html>
<?php
}
else
echo "<marquee width='70%' style='font-size:1.5rem; font-family: Merienda, cursive;'>
S.I.W.G.O. No presta Servicios a esta hora del día</marquee><div class='carga' style='text-align: center;'>
<img class='diente2' src='src/img/baile.gif'/>
<br/><strong>Horario Laborable</strong><br>07:00 AM hasta 06:00 PM
</div>";
}else{
echo "<marquee width='70%' style='font-size:1.5rem; font-family: Merienda, cursive;'>S.I.W.G.O. No presta Servicios el día de hoy</marquee><div class='carga' style='text-align: center;'>
<img class='diente2' src='src/img/baile.gif'/>
<br/><strong>Horario Laborable</strong><br>Lunes a Viernes
</div>";
}
?>