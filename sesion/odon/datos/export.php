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
    error_reporting(0);
 function fechaCastellano ($fecha) {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
        $dias_EN = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $meses_EN = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombredia.'-'.$numeroDia.'-'.$nombreMes.'-'.$anio;
    }
    function basico($numero) {
        $valor = array ("uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve",
            "diez", "once", "doce", "trece", "catorce", "quince", "dieciséis", "diecisiete", "dieciocho", "diecinueve",
            "veinte", "veintiún", "veintidós", "veintitrés", "veinticuatro", "veinticinco", "veintiséis", "veintisiete", "veintiocho", "veintinueve");
        return $valor[$numero - 1];
    }
    function decenas($n) {
        $decenas = array (30=>'treinta',40=>'cuarenta',50=>'cincuenta',60=>'sesenta',
            70=>'setenta',80=>'ochenta',90=>'noventa');
        if( $n <= 29) return basico($n);
        $x = $n % 10;
        if ( $x == 0 ) {
            return $decenas[$n];
        } else return $decenas[$n - $x].' y '. basico($x);
    }
    function convertir($n) {
        switch (true) {
            case ( $n >= 1 && $n <= 29) : return basico($n); break;
            case ( $n >= 30 && $n < 100) : return decenas($n); break;
        }
    }
// Database configuration
$host = "odontologia.uptm";
$username = $_POST['username'];
$password = $_POST['password'];
$database_name = "odontologia";

// Get connection object and set the charseto
$conn = mysqli_connect($host, $username, $password, $database_name);
if(mysqli_connect_error($conn))
die("<h2 style='text-align: center; margin-top: 12%;'> Error de conexión: Parece que las credenciales de acceso a las bases de datos son nulas o inválidas </h2><h4><a href='exportar' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
else
$conn->set_charset("utf8");


// Get All Table Names From the Database
$tables = 'persona, trabajador, estudiante, sesion, registro_devisitas, antecedente, consulta, tratamiento';
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);

$tables = is_array($tables) ? $tables : explode(',', str_replace(' ', '', $tables));

$sqlScript = "";
foreach ($tables as $table) {
    $sqlScript .= "\n\n"."DROP TABLE IF EXISTS $table". ";\n\n";
    // Prepare SQLscript for creating table structure
    $query = "SHOW CREATE TABLE $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    
    $sqlScript .= "\n\n" . $row[1] . ";\n\n";
    
    
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    
    $columnCount = mysqli_num_fields($result);
    
    // Prepare SQLscript for dumping data for each table
    for ($i = 0; $i < $columnCount; $i ++) {
        while ($row = mysqli_fetch_row($result)) {
            $sqlScript .= "INSERT INTO $table VALUES(";
            for ($j = 0; $j < $columnCount; $j ++) {
                $row[$j] = $row[$j];
                
                if (isset($row[$j])) {
                    $sqlScript .= '"' . $row[$j] . '"';
                } else {
                    $sqlScript .= '""';
                }
                if ($j < ($columnCount - 1)) {
                    $sqlScript .= ',';
                }
            }
            $sqlScript .= ");\n";
        }
    }
    
    $sqlScript .= "\n"; 
}

if(!empty($sqlScript))
{
    // Save the SQL script to a backup file
    $backup_file_name = $database_name . '_respaldo_' . fechaCastellano(date('d-m-Y')) . '.sql';
    $fileHandler = fopen($backup_file_name, 'w+');
    $number_of_lines = fwrite($fileHandler, $sqlScript);
    fclose($fileHandler); 

    // Download the SQL backup file to the browser
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file_name));
    ob_clean();
    flush();
    readfile($backup_file_name);
    exec('rm' . $backup_file_name); 
}
mysql_close($conn);
}
else{
    // Usuario que no se ha logueado
    echo "<div class='alert alert-danger' role='alert' style='text-align: center; margin-top: 5%;'>No tienes permiso para:<br><br> <strong>Acceder a esta página</strong><br><br><br><div align='center'><img height='210' width='180' src='http://odontologia.uptm/SIWGO/src/img/saltos.gif'></div><strong>Por favor espere un momento mientras <br>redireccionamos el url.</strong></div>";
    header('Refresh: 6; http://odontologia.uptm/SIWGO'); //redirect
}
?>