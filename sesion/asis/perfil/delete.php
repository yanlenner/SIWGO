<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['nivel'] =='a'){
$fechaGuardada = $_SESSION["ultimoAcceso"];
$ahora = date("Y-n-j H:i:s");
$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
//comparamos el tiempo transcurrido
if($tiempo_transcurrido < 0 || $tiempo_transcurrido > 599)
{
//si pasaron 10 minutos o más
include '../../../src/php/enlace.php';
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
header("Location:../../../",TRUE,301);
mysqli_close($enlace);
}
else
$_SESSION["ultimoAcceso"] = $ahora;?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../../../src/img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="../../../src/css/int">
    </head>
    <body><?php
        
        if(empty($_POST['ci']))
        die("<h2 style='text-align: center; margin-top: 12%;'> No podemos vaciar los datos del estudiante sin la supervisión del Asistente</h2><h4><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
        include '../../../src/php/enlace.php';
        // parámetros de conexión
        $enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        $enlace->set_charset('utf8');
        // revisar conexión
        if (!$enlace) {
        die("Conexión Fallida: " . mysqli_connect_error()); }
        //Comienza el proceso de eliminación del usuario
        $ci = $_POST['ci'];
        
        $estudiante = $enlace->query("SELECT id_historia, carrera, carnet FROM estudiante WHERE cedula = '$ci'");
        $e = $estudiante->fetch_assoc();
        $hist=$e['id_historia'];
        $query  = "DELETE FROM antecedente where id_historia like '$hist';";
        $query .= "UPDATE estudiante set carrera=null, carnet=null where cedula='$ci';";
        $query .= "UPDATE persona set nombre=null, apellido=null, genero=null, telefono=null, fecha=null, correo=null, direccion=null where cedula='$ci';";        
        $url=substr($_SERVER['PHP_SELF'], 0,-4);      
        $result = mysqli_query($enlace, "SELECT max(id_sesion) as id FROM sesion WHERE usuario = '$_SESSION[usuario]'");
        $row = mysqli_fetch_assoc($result);
        $query .= "INSERT into registro_devisitas (id_sesion, enlace, tiempo) values('$row[id]','$url$hist.php','$ahora');"; 
        if($enlace->multi_query($query)){
        echo "<h2 style='text-align: center; margin-top: 12%;'> El perfil del paciente ha sido vaciado</h2><h4 style='text-align: center;'><a href='./' target='_top' style='color: #66328f;text-decoration: none;'>Continuar</a></h4>";
        }
        else
        echo "<h2 style='text-align: center; margin-top: 12%;'> El perfil del paciente no ha sido vaciado</h2><h4 style='text-align: center;'><a href='./' target='_top' style='color: #66328f;text-decoration: none;'>Reintentar</a></h4>";
        mysqli_close($enlace);?>
        <script type="text/javascript">document.oncontextmenu = function(){return false;}</script>
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