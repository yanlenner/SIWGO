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
    <link rel="stylesheet" href="../../../src/css/bootstrap">
    <link rel="stylesheet" href="../../../src/css/int">
  </head>
  <body>
    <?php
    
    function generateRandomString($length = 10) {
    return substr(str_shuffle("0123456789ABCDEF"), 0, $length);
    }
    include '../../../src/php/enlace.php';
    // parámetros de conexión
    $enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $enlace->set_charset('utf8');
    // revisar conexión
    if (!$enlace) {
    die("Conexión Fallida: " . mysqli_connect_error());
    }
    //Comienza el proceso de registro del paciente
    if(empty($_POST['ci']))
    die("<h2 style='text-align: center; margin-top: 12%;'> Sólo se permite registrar nuevas consultas Odontológicas cuando tú llenas todos los campos requeridos en el formulario</h2><h4><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
    $cedula = $_POST['ci'];
    $persona = $enlace->query("SELECT nombre FROM persona WHERE cedula = '$cedula'");
    $p = $persona->fetch_assoc();
    $nombre=$p['nombre'];
    $estudiante = $enlace->query("SELECT id_historia FROM estudiante WHERE cedula = '$cedula'");
    $e = $estudiante->fetch_assoc();
    $hist=$e['id_historia'];
    $odontologo=$_SESSION['trabajador'];
    $pieza = $_POST['pieza'];
    $fecha = date("Y-m-d");
    $contadora=0;
    if(is_array($_POST['consulta']))
    {
    while(list($key,$value) = each($_POST['consulta']))
    {
    $tipo[] = $value;
    $contadora++;
    }
    }
    else{
    $contadora=1;
    $tipo[0]=$_POST['country_list'];}
    function consulta(){
    include '../../../src/php/enlace.php';
    // parámetros de conexión
    $enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    $enlace->set_charset('utf8');
    do{
    $consulta = generateRandomString();
    $chequear ="SELECT id_consulta FROM consulta WHERE id_consulta like '$consulta'";
    $resultado = $enlace-> query($chequear);
    $existe = mysqli_num_rows($resultado);
    }while($existe == 1);
    
    mysqli_close($enlace);
    return $consulta;
    }
    if(isset($_POST['diagnostico1']) && $contadora==1){
    $consulta = consulta();
    $query = "INSERT INTO consulta VALUES ('$hist','$odontologo','$consulta','$pieza','$_POST[diagnostico1]','$tipo[0]','$fecha')";
    if (mysqli_query($enlace, $query))
    echo "<h2 style='text-align: center; margin-top: 12%;'> Les has registrado $tipo[0]<br> a $nombre</h2><br><h4><a href='registrar' style='color:#66328f'>Continuar</a></h4>";
    else
    echo "<h2 style='text-align: center; margin-top: 12%;'> No se pudo registrar la consulta </h2><br><h4><a href='registrar' style='color:#6f42c1'>Volver</a></h4>";
    }
    if(isset($_POST['diagnostico1']) && isset($_POST['diagnostico2']) && $contadora == 2)
    {
    $consulta1 = consulta();
    $query1 = "INSERT INTO consulta VALUES ('$hist','$odontologo','$consulta1','$pieza','$_POST[diagnostico1]','$tipo[0]','$fecha')";
    $consulta2 = consulta();
    $query2 = "INSERT INTO consulta VALUES ('$hist','$odontologo','$consulta2','$pieza','$_POST[diagnostico2]','$tipo[1]','$fecha')";
    if (mysqli_query($enlace, $query1) && mysqli_query($enlace, $query2))
    echo "<h2 style='text-align: center; margin-top: 12%;'> Les has registrado $tipo[0], $tipo[1]<br> a $nombre</h2><br><h4><a href='registrar' style='color:#66328f'>Continuar</a></h4>";
    else
    echo "<h2 style='text-align: center; margin-top: 12%;'> No se pudo registrar la consulta </h2><br><h4><a href='registrar' style='color:#6f42c1'>Volver</a></h4>";
    }
    if(isset($_POST['diagnostico1']) && isset($_POST['diagnostico2']) && isset($_POST['diagnostico3']) && $contadora == 3){
    $consulta1 = consulta();
    $query1 = "INSERT INTO consulta VALUES ('$hist','$odontologo','$consulta1','$pieza','$_POST[diagnostico1]','$tipo[0]','$fecha')";
    $consulta2 = consulta();
    $query2 = "INSERT INTO consulta VALUES ('$hist','$odontologo','$consulta2','$pieza','$_POST[diagnostico2]','$tipo[1]','$fecha')";
    $consulta3 = consulta();
    $query3 = "INSERT INTO consulta VALUES ('$hist','$odontologo','$consulta3','$pieza','$_POST[diagnostico3]','$tipo[2]','$fecha')";
    if (mysqli_query($enlace, $query1) && mysqli_query($enlace, $query2) && mysqli_query($enlace, $query3))
    echo "<h2 style='text-align: center; margin-top: 12%;'> Les has registrado $tipo[0], $tipo[1], $tipo[2]<br> a $nombre</h2><br><h4><a href='./' style='color:#66328f'>Continuar</a></h4>";
    else
    echo "<h2 style='text-align: center; margin-top: 12%;'> No se pudo registrar la consulta </h2><br><h4><a href='registrar' style='color:#6f42c1'>Volver</a></h4>";
    }
    
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
header('Refresh: 6; http://odontologia.uptm/SIWGO'); //redirect
}
?>