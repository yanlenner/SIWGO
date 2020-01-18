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
include '../../../src/php/enlace.php';
$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$enlace->set_charset('utf8');
if (!$enlace) die("Conexión fallida: " . mysqli_connect_error());
$result = mysqli_query($enlace, "SELECT max(id_sesion) as id FROM bitacora WHERE usuario = '$_SESSION[usuario]'");
$row = mysqli_fetch_assoc($result);
$query = mysqli_query($enlace, "UPDATE bitacora set fin ='$ahora', minutos=TIMESTAMPDIFF(MINUTE,inicio,fin) where id_sesion = '$row[id]' and usuario like '$_SESSION[usuario]'");
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
    <link rel="stylesheet" href="../../../src/css/bootstrap">
    <link rel="stylesheet" href="../../../src/css/int">
  </head>
  <body>
    <?php
    
    include '../../../src/php/enlace.php';
    // parámetros de conexión
    $enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $enlace->set_charset('utf8');
    // revisar conexión
    if (!$enlace) {
    die("Conexión Fallida: " . mysqli_connect_error());
    }
    //Comienza el proceso de registro del paciente
    
    $cedula = $_POST['ci'];
    $persona = $enlace->query("SELECT nombre FROM persona WHERE cedula = '$cedula'");
    $p = $persona->fetch_assoc();
    $nombre=$p['nombre'];
    $aspecto = $_POST['aspecto'];
    $hallazgo = $_POST['hallazgo'];
    $observacion = $_POST['observacion']; 
    $respuesta = $_POST['respuesta'];
    $query = "UPDATE estudiante set aspecto ='$aspecto', hallazgo = '$hallazgo', observacion ='$observacion', respuesta = '$respuesta' where cedula = '$cedula'";
    if (mysqli_query($enlace, $query))
    echo "<h2 style='text-align: center; margin-top: 12%;'> Le has actualizado el informe a $nombre</h2><br><h4><a href='./' style='color:#66328f'>Continuar</a></h4>";
    else
    echo "<h2 style='text-align: center; margin-top: 12%;'> No se pudo actualizar el informe </h2><br><h4><a href='actualizar_informe' style='color:#6f42c1'>Volver</a></h4>";
    mysqli_close($enlace);
    ?>
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