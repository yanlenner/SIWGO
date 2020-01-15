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
        <link rel="stylesheet" href="../../../src/css/bootstrap">
        <link rel="stylesheet" href="../../../src/css/int">
    </head>
    <body>
        <?php
        error_reporting(0);
        if(empty($_POST['ci']))
        die("<h2 style='text-align: center; margin-top: 12%;'> Sólo se permite actualizar un perfil cuando tu llenas todos los campos requeridos en el formulario</h2><h4><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
        include '../../../src/php/enlace.php';
        function generateRandomString($length = 10) {
        return substr(str_shuffle("1234567890ABCDEF"), 0, $length);
        }
        // parámetros de conexión
        $enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        $enlace->set_charset('utf8');
        // revisar conexión
        if (!$enlace) {
        die("Conexión Fallida: " . mysqli_connect_error());
        }
        
        //Comienza el proceso de actualizacion del paciente
        
        $cedula = $_POST['ci'];
        $npac = $_POST['nombre'];
        $telef = $_POST['telefono'];
        $carne=$_POST['ce'];
        $apac = $_POST['apellido'];
        $ema = $_POST['correo'];
        $nac = $_POST['nacimiento'];
        $gen = $_POST['sex'];
        $dom = $_POST['domicilio'];
        $car = $_POST['carrera'];
        $nac = date_create_from_format('d/m/Y', $nac);
        $nac = date_format($nac, 'Y-m-d');
        $estudiante = $enlace->query("SELECT id_historia FROM estudiante WHERE cedula = '$cedula'");
        $e = $estudiante->fetch_assoc();
        $hist=$e['id_historia'];
        $delete  = "DELETE FROM antecedente WHERE id_historia = '$hist'";
        $update  = "UPDATE persona SET nombre = '$npac', apellido = '$apac', genero = '$gen', telefono = '$telef', fecha = '$nac', correo = '$ema', direccion = '$dom' WHERE cedula = '$cedula';";
        $update  .= "UPDATE estudiante SET carnet = '$carne', carrera = '$car' WHERE id_historia = '$hist';";
        
        mysqli_query($enlace, $delete);
        while(list($key,$value) = each($_POST['antecedente'])){
        do{
        $antecedente = generateRandomString();
        $check_hist2 ="SELECT id_historia FROM antecedente WHERE id_antecedente like '$antecedente'";
        $result4 = $enlace-> query($check_hist2);
        $count4 = mysqli_num_rows($result4);
        }while($count4 == 1);
        $cancer = "INSERT INTO antecedente VALUES ('$antecedente','$hist','$value')";
        mysqli_query($enlace, $cancer);
        }
        $enlace->multi_query($update);
        echo "<h2 style='text-align: center; margin-top: 12%;'> El perfil del paciente <br> $npac ha sido actualizado </h2><h4><a href='consultar' style='color:#6f42c1;text-decoration: none;'>Continuar</a></h4>";
        
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