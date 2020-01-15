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
        die("<h2 style='text-align: center; margin-top: 12%;'> Sólo se permite registrar un nuevo usuario cuando tu llenas todos los campos requeridos en el formulario</h2><h4><a href='nuevo_usuario' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
        function spar(int $b){
            if($b % 2 == 0)
                return true;
            else
                return false;
        }

        function yan(string $a)
        {
            $sz = strlen($a);
            $vector;
            $cat;
            $b;
            $i;
            $x;

            for($i=0; $i<$sz; $i++)
                $vector[$i]=ord($a[$i]);

            for($i=0; $i<$sz; $i++){
                $x=$vector[$i];
                if(spar($x))
                    $vector[$i]+=5;
                else
                    $vector[$i]+=1;
            }

            for($i=0; $i<$sz; $i++){
                $b[$i]=chr($vector[$i]);
                $cadena .=$b[$i];
            }

            return $cadena;
        }
        // Doble consulta para verificar sí la persona y el usuario
        $checkusr ="SELECT cedula FROM persona WHERE cedula like '$_POST[cedula]'";
        $cryp0 = yan($_POST['usuario']);
        $checkusr2 ="SELECT usuario FROM trabajador WHERE usuario like '$cryp0'";
        // La variable result retiene la consulta checkusr y la conexión bd
        $result = $enlace-> query($checkusr);
        $result2 = $enlace-> query($checkusr2);
        // La variable count guarda el resultado de la consulta
        $count = mysqli_num_rows($result);
        $count2 = mysqli_num_rows($result2);
        // Si la cuenta es 1 significa que la persona ya esta registrada
        if($count == 1)
        echo "<h2 style='text-align: center; margin-top: 12%;'> Usted ya está registrado</h2><h4 style='text-align: center;'><a href='../' target='_top' style='color: #66328f; text-decoration: none;'>Iniciar Sesión!</a></h4>";
        else
        {
        // Si la cuenta es 1 significa que el usuario ya esta en uso
        if ($count2 == 1)
        echo "<h2 style='text-align: center; margin-top: 12%;'> El usuario ya está en uso</h2><h4 style='text-align: center;'><a href='nuevo_usuario' target='_top' style='color: #66328f; text-decoration: none;'>Reintentar!</a></h4>";

        else
        {
        //Comienza el proceso de creación del usuario
        $fecha = $_POST['fecha'];
        $fecha = date_create_from_format('d/m/Y', $fecha);
        $fecha = date_format($fecha, 'Y-m-d');
        if(is_null($_POST['mpps']))
        $_POST['mpps']='0';
        $query  = "INSERT INTO persona VALUES ('$_POST[cedula]','$_POST[nombre]','$_POST[apellido]','$_POST[sex]','$_POST[telefono]','$fecha','$_POST[correo]', '$_POST[domicilio]');";
        $query .= "INSERT INTO trabajador VALUES ('$_POST[cedula]','$cryp0',md5('$_POST[clave]'),md5('$_POST[respuesta]'),'ae','$_POST[mpps]');";
        $enlace->multi_query($query);
        echo "<h2 style='text-align: center; margin-top: 12%;'> El usuario $_POST[usuario] ya puede hacer uso del sistema</h2><h4 style='text-align: center;'><a href='../' target='_top' style='color: #66328f; text-decoration: none;'>Continuar</a></h4>";
        }
        }
        mysqli_close($enlace);
        }
        else
        echo "<marquee width='70%' style='font-size:1.5rem; font-family: Merienda, cursive;'>
        S.I.W.G.O. No presta Servicios a esta hora del día</marquee><div class='carga' style='text-align: center;'>
            <img class='diente2' src='../src/img/baile.gif'/>
            <br/><strong>Horario Laborable</strong><br>07:00 AM hasta 06:00 PM
        </div>";
        } else
        echo "<marquee width='70%' style='font-size:1.5rem; font-family: Merienda, cursive;'>S.I.W.G.O. No presta Servicios el día de hoy</marquee><div class='carga' style='text-align: center;'>
            <img class='diente2' src='../src/img/baile.gif'/>
            <br/><strong>Horario Laborable</strong><br>Lunes a Viernes
        </div>";
        ?>
        <script type="text/javascript">document.oncontextmenu = function(){return false;}</script>
    </body>
</html>
