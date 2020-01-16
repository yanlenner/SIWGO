<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/img/favicon.png" type="image/gif">
    <link rel="stylesheet" href="../src/css/int">
    <title>S.I.W.G.O.</title>
</head>
<body>
    <?php
    
    if(empty($_POST['usr']))
        header('Location: http://odontologia.uptm/SIWGO');
    include '../src/php/enlace.php';
    $enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $enlace->set_charset('utf8');
    if (!$enlace) die("Conexión fallida: " . mysqli_connect_error());
    $usuario=lenner($_POST['usr']);
    $result = mysqli_query($enlace, "SELECT cedula, usuario, password, nivel FROM trabajador WHERE usuario = '$usuario'");
    $row = mysqli_fetch_assoc($result);
    function spar(int $b)
    {
        if($b % 2 == 0)
            return true;
        else
            return false;
    }
    function lenner(string $a)
    {
        $sz = strlen($a);
        $vector;
        $b;
        $i;
        $x;
        for($i=0; $i<$sz; $i++)
            $vector[$i]=ord($a[$i]);

        for($i=0; $i<$sz; $i++){
            $x=$vector[$i];

            if(spar($x)){
                $vector[$i]+=5;
            }
            else
                $vector[$i]+=1;
        }
        for($i=0; $i<$sz; $i++){
            $b[$i]=chr($vector[$i]);
            $cadena .=$b[$i];
        }
        return $cadena;
    }
    if($row == 0)
        echo "<h2 style='text-align: center; margin-top: 12%;'> El Usuario con el que intentas acceder no está registrado </h2><h4 style='text-align:center;'><a href='../' style='color: #66328f;text-decoration: none;'>Intente otra vez!</a></h4>";
    else
    {
        if (md5($_POST['pss']) == $row['password'] and $usuario == $row['usuario'])
        {
            if($row['nivel']=='ae'){
                session_start();
                $_SESSION['usuario'] = $usuario;
                $_SESSION['ultimoAcceso']= date("Y-n-j H:i:s");
                $query = mysqli_query($enlace, "INSERT into sesion (usuario, inicio) values ('$usuario','$_SESSION[ultimoAcceso]')");
                $_SESSION['nivel'] = 'a';
                header("Location: asis/",TRUE,301);
            }
            else if($row['nivel']=='oo'){
                session_start();
                $_SESSION['usuario'] = $usuario;
                $_SESSION['trabajador'] = $row['cedula'];
                $_SESSION['ultimoAcceso']= date("Y-n-j H:i:s");
                $query = mysqli_query($enlace, "INSERT into sesion (usuario, inicio) values ('$usuario','$_SESSION[ultimoAcceso]')");
                $_SESSION['nivel'] = 'o';
                header("Location: odon/",TRUE,301);
            }
            else
                echo "<h2 style='text-align: center; margin-top: 12%;'> Parece ser que tu usuario no tiene permisos </h2><h4 style='text-align:center;'><a href='../' style='color: #66328f;text-decoration: none;'>Reintentar!</a></h4>";
        }
        else
            echo "<h2 style='text-align: center; margin-top: 12%;'> Usuario del sistema / Contraseña de acceso inválid@ </h2><h4 style='text-align:center;'><a href='../' style='color: #66328f;text-decoration: none;'>Intente otra vez!</a></h4>";
        
    }
    mysqli_close($enlace);
    ?>
    <script type="text/javascript">document.oncontextmenu = function(){return false;}</script>
</body>
</html>