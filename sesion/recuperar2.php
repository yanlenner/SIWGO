<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../src/img/favicon.png" type="image/gif">
        <link rel="stylesheet" href="../src/css/int">
        <title>Respuesta de la Conexión</title>
    </head>
    <body>
        <?php
        error_reporting(0);
        $lunes = 1; $martes = 2; $miercoles = 3; $jueves = 4; $viernes = 5; # De Lunes a Viernes
        $desde = 7; # Desde las siete de la mañana
        $hasta = 18; # Hasta la seis de la tarde
        $dia_actual = intval(date("w")); #Convertir siempre a entero para evitar errores
        $hora_actual = intval(date("H"));
        if($dia_actual === $lunes || $dia_actual === $martes || $dia_actual === $miercoles || $dia_actual === $jueves || $dia_actual === $viernes)
        {
        if($hora_actual >= $desde && $hora_actual < $hasta)
        {
        include '../src/php/enlace.php';
        // parámetros de conexión
        $enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        $enlace->set_charset('utf8');
        // revisar conexión
        if (!$enlace)
        die("Conexión Fallida: " . mysqli_connect_error());
        if(empty($_POST['cedula']))
        die("<h2 style='text-align: center; margin-top: 12%;'> Primero tendrás que llenar unos datos para confirmar que el usuario es tuyo</h2><h4><a href='recuperar_contraseña' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
        $fecha = $_POST['fecha'];
        $fecha = date_create_from_format('d/m/Y', $fecha);
        $fecha = date_format($fecha, 'Y-m-d');
        $consulta = mysqli_query($enlace, "SELECT cedula FROM persona WHERE cedula like '$_POST[cedula]' AND fecha = '$fecha'");
        $consulta2 = mysqli_query($enlace, "SELECT respuesta FROM trabajador WHERE cedula like '$_POST[cedula]'");
        $resultado = mysqli_num_rows($consulta);
        $resulta2 = mysqli_fetch_assoc($consulta2);
        if($resultado == 1)
        {
        if(md5($_POST['respuesta']) == $resulta2['respuesta'])
        {
        mysqli_query($enlace, "UPDATE trabajador SET password = md5('$_POST[clave]') WHERE cedula = '$_POST[cedula]'");
        echo "<h2 style='text-align: center; margin-top: 12%;'>Su contraseña ha sido reestablecida éxitosamente</h2><h4><a href='../' target='_top' style='color: #66328f; text-decoration: none;'>Iniciar Sesión!</a></h4>";
        }
        else
        echo "<h2 style='text-align: center; margin-top: 12%;'>  Respuesta de Seguridad Anti-Phishing Inválida </h2><h4><a href='recuperar_contraseña.php' target='_top' style='color:#66328f;text-decoration: none;'>Intente otra vez!</a></h4>";
        }
        else
        echo "<h2 style='text-align: center; margin-top: 12%;'> El Usuario no está registrado </h2><h4 style='text-align:center;'><a href='recuperar_contraseña.php' target='_top' style='color: #66328f;text-decoration: none;'>Intente otra vez!</a></h4>";

        mysqli_close($enlace); ?><?php
        }
        else
        echo "<marquee width='70%' style='font-size:1.5rem; font-family: Merienda, cursive;'>
        S.I.W.G.O. No presta Servicios a esta hora del día</marquee><div class='carga' style='text-align: center;'>
            <img class='diente2' src='../src/img/baile.gif'/>
            <br/><strong>Horario Laborable</strong><br>07:00 AM hasta 06:00 PM
        </div>";
        }else
        echo "<marquee width='70%' style='font-size:1.5rem; font-family: Merienda, cursive;'>S.I.W.G.O. No presta Servicios el día de hoy</marquee><div class='carga' style='text-align: center;'>
            <img class='diente2' src='../src/img/baile.gif'/>
            <br/><strong>Horario Laborable</strong><br>Lunes a Viernes
        </div>";
        ?>
    </body>
</html>
