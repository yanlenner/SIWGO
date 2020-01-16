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
        $result = mysqli_query($enlace, "SELECT max(id_sesion) as id 
         sesion WHERE usuario = '$_SESSION[usuario]'");
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
    error_reporting(0);
    //include our function
function restore($server, $username, $password, $dbname, $location){
//connection
$conn = new mysqli($server, $username, $password, $dbname);
if(mysqli_connect_error($conn))
die("<h2 style='text-align: center; margin-top: 12%;'> Error de conexión: Parece que las credenciales de acceso a las bases de datos son nulas o inválidas </h2><h4><a href='exportar' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
else
$conn->set_charset('utf8'); 
//variable use to store queries from our sql file
$sql = '';

//get our sql file
$lines = file($location);
//return message
$output = array('error'=>false);

//loop each line of our sql file
foreach ($lines as $line){
//skip comments
if(substr($line, 0, 2) == '--' || $line == ''){
continue;
}
//add each line to our query
$sql .= $line;
//check if its the end of the line due to semicolon
if (substr(trim($line), -1, 1) == ';'){
//perform our query
$query = $conn->query($sql);
if(!$query){
    $output['error'] = true;
$output['message'] = $conn->error;
}
else{
    $output['message'] = 'Base de datos restaurada con éxito';
}
//reset our query variable
$sql = '';

}
}
return $output;
}
if(isset($_POST['restore'])){
    
        //get post data
    $server = 'odontologia.uptm';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dbname = 'odontologia';
        //moving the uploaded sql file
    $filename = $_FILES['sql']['name'];
        //restore database using our function
    $restore = restore($server, $username, $password, $dbname, $filename);
    if ($restore->connect_error) {
        $_SESSION['error'] = 'Acceso Denegado';
        if(isset($_SESSION['error'])){
            ?>
            <div class="alert alert-danger text-center col-12">
                <?php echo $_SESSION['error']; ?>
            </div>
            <?php
            unset($_SESSION['error']);
        }
    }
    else
        $_SESSION['success'] = $restore['message'];
    
}
else
    $_SESSION['error'] = 'Rellena las credenciales de la base de datos';

header('location:importar.php');
}
else{
    // Usuario que no se ha logueado
    echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";
    header('Refresh: 6; http://odontologia.uptm/SIWGO'); //redirect
}
?>