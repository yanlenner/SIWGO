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
        <meta charset="utf-8" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../../../src/img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="../../../src/css/font-awesome">
        <link rel="stylesheet" href="../../../src/css/materialize">
        <link rel="stylesheet" href="../../../src/css/style">
        <title>Gest. Perfil del Paciente</title>
    </head>
    <body>
        <?php
        error_reporting(0);
        if(empty($_POST['ci']))
        die("<h2 style='text-align: center; margin-top: 12%;'> No podemos mostrar los datos del estudiante sin la supervisión del Asistente</h2><h4 class='center'><a href='./' style='color:#66328f;text-decoration: none;'>Volver</a></h4>");
        $ci=$_POST['ci'];
        //Conexión a la BD
        include '../../../src/php/enlace.php';
        // parámetros de conexión
        $enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        $enlace->set_charset('utf8');
        $persona = $enlace->query("SELECT * FROM persona WHERE cedula = '$ci'");
        $p = $persona->fetch_assoc();
        $estudiante = $enlace->query("SELECT id_historia, carrera, carnet FROM estudiante WHERE cedula = '$ci'");
        $e = $estudiante->fetch_assoc();
        $hist=$e['id_historia'];
        $url=substr($_SERVER['PHP_SELF'], 0,-9);
        $result = mysqli_query($enlace, "SELECT max(id_sesion) as id FROM sesion WHERE usuario = '$_SESSION[usuario]'");
        $row = mysqli_fetch_assoc($result);
        $query = mysqli_query($enlace, "INSERT into registro_devisitas (id_sesion, enlace, tiempo) values('$row[id]','$url$hist.php','$ahora')");
        $antecedente = $enlace->query("SELECT nombre_antecedente FROM antecedente WHERE id_historia = '$hist'");
        $edad = $enlace->query("SELECT TIMESTAMPDIFF(YEAR,fecha,CURDATE()) AS edad
        FROM persona WHERE cedula = '$ci'");
        $t = $edad->fetch_assoc(); ?>
        <a href="javascript:" id="return-to-top"><i class="fa fa-lg fa-chevron-up"></i></a>
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#test1">Historia: <?php echo $hist?> </a></li>
                    <li class="tab col s3"><a href="#test2">Datos Personales</a></li>
                    <li class="tab col s3"><a href="#test3">Antecedentes Médicos</a></li>
                    <li class="tab col s3"><a onclick="top.location.href = './'">Volver</a></li>
                </ul>
            </div>
            <div id="test1" class="col s12"></div>
            <div id="test2" class="col s12">
                <br>
                <fieldset class="campo-morado">
                    <div class="row">
                        <div class="col s5 blanco consultI">Número de cédula: </div>
                        <div class="col s7 blanco consultD"><?php echo $p['cedula']; ?></div>
                        <div class="col s5 blanco consultI">Nombres: </div>
                        <div class="col s7 blanco consultD"><?php echo $p['nombre']; ?></div>
                        <div class="col s5 blanco consultI">Apellidos: </div>
                        <div class="col s7 blanco consultD"><?php echo $p['apellido']; ?></div>
                        <div class="col s5 blanco consultI">Carrera que estudia: </div>
                        <div class="col s7 blanco consultD"><?php echo $e['carrera']; ?></div>
                        <div class="col s5 blanco consultI">Número de carnet: </div>
                        <div class="col s7 blanco consultD"><?php echo $e['carnet']; ?></div>
                        <div class="col s5 blanco consultI">Edad: </div>
                        <div class="col s7 blanco consultD"><?php echo $t['edad']; ?></div>
                        <div class="col s5 blanco consultI">Género: </div>
                        <div class="col s7 blanco consultD"><?php if($p['genero']=='H')$p['genero']='Hombre'; else $p['genero']='Mujer'; echo $p['genero']; ?></div>
                        <div class="col s5 blanco consultI">Teléfono: </div>
                        <div class="col s7 blanco consultD"><?php echo $p['telefono']; ?></div>
                        <div class="col s5 blanco consultI">Correo electrónico: </div>
                        <div class="col s7 blanco consultD"><?php echo $p['correo']; ?></div>
                        <div class="col s5 blanco consultI">Dirección de domicilio: </div>
                        <div class="col s7 blanco consultD"><?php echo $p['direccion']; ?></div>
                    </div>
                </fieldset>
            </div>
            <div id="test3" class="col s12">
                <br>
                <fieldset class="campo-morado">
                    <div class="row">
                        <?php while($a = $antecedente->fetch_assoc()){
                        $ant=$a['nombre_antecedente'];
                        if($ant=='Saludable')
                        $pant='Paciente:';
                        if($ant=='Embarazo')
                        $pant='En situación de:';
                        if($ant=='Asma')
                        $pant='Sufre de:';
                        if($ant=='Anemia')
                        $pant='Padece:';
                        if($ant=='Tiroides')
                        $pant='Problemas de la:';
                        if($ant=='Diabetes')
                        $pant='Sufre de:';
                        if($ant=='Hepatitís')
                        $pant='Ha padecido:';
                        if($ant=='Leucemia')
                        $pant='Sufre de:';
                        if($ant=='Hemofilia')
                        $pant='Padece:';
                        if($ant=='Aspirina')
                        $pant='Alergia a la:';
                        if($ant=='Penicilina')
                        $pant='Alergia a la:';
                        if($ant=='Anestesia')
                        $pant='Alergia a la:';
                        if($ant=='Iodo')
                        $pant='Alergia al:';
                        if($ant=='ConsultasMédicas'){
                        $pant='Asiste a:';
                        $ant='Consultas Médicas';
                        }
                        if($ant=='UlceraGástrica'){
                        $pant='Sufre de:';
                        $ant='Ulcera Gástrica';
                        }
                        if($ant=='ConsumodeTabaco'){
                        $pant='Práctica:';
                        $ant='Consumo de Tabaco';
                        }
                        if($ant=='FiebreReumática'){
                        $pant='Sufre de:';
                        $ant='Fiebre Reumática';
                        }
                        if($ant=='TransfusiónSanguínea'){
                        $pant='Ha recibido:';
                        $ant='Transfusión Sanguínea';
                        }
                        if($ant=='RespiraciónBucal'){
                        $pant='Problemas de:';
                        $ant='Respiración Bucal';
                        }
                        if($ant=='IntervenciónQuirúrgica'){
                        $pant='Ha recibido:';
                        $ant='Intervención Quirúrgica';
                        }
                        if($ant=='DefícitdeVitaminaK'){
                        $pant='Padece:';
                        $ant='Defícit de Vitamina K';
                        }
                        if($ant=='OtrasAlergias'){
                        $pant='Padece:';
                        $ant='Otras Alergias';
                        }
                        if($ant=='DiversidadFuncional'){
                        $pant='Padece:';
                        $ant='Diversidad Funcional';
                        }
                        if($ant=='ConsumodePastillasA.C.'){
                        $pant='Práctica:';
                        $ant='Consumo de Pastillas A.C.';
                        }
                        if($ant=='ApretamientoDentario'){
                        $pant='Padece:';
                        $ant='Apretamiento Dentario';
                        }
                        if($ant=='ProblemasdelCorazón'){
                        $pant='Sufre:';
                        $ant='Problemas del Corazón';
                        }
                        if($ant=='EnfermedadesVenéreas'){
                        $pant='Padece:';
                        $ant='Enfermedades Venéreas';
                        }
                        if($ant=='HerpesoAftasfrecuentes'){
                        $pant='Padece:';
                        $ant='Herpes o Aftas frecuentes';
                        }
                        if($ant=='Ruidosalabrir/cerrarlaboca'){
                        $pant='Padece:';
                        $ant='Ruidos al abrir/cerrar la boca';
                        }
                        if($ant=='SangradoExcesivoalCortarse'){
                        $pant='Sufre de:';
                        $ant='Sangrado Excesivo al Cortarse';
                        }
                        if($ant=='Lim.paraabrir/cerrarlaboca'){
                        $pant='Padece:';
                        $ant='Limitación para abrir/cerrar la boca';
                        }?>
                        <div class="col s5 blanco consultI"><?php echo $pant;?></div>
                        <div class="col s7 blanco consultD"><?php echo $ant; ?></div>
                        <?php } ?>
                    </div>
                </fieldset>
            </div>
            <div id="test4" class="col s12"></div>
        </div>
        <?php mysqli_close($enlace);?>
        <script  src="../../../src/js/jquery-3.js"></script>
        <script  src="../../../src/js/materialize.js"></script>
        <script type="text/javascript">
        document.oncontextmenu = function(){return false;}
        $(document).ready(function(){
        $('.tabs').tabs();
        });
        // ===== Scroll to Top ====
        $(window).scroll(function() {
        if ($(this).scrollTop() >= 155) {        // If page is scrolled more than 155px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
        });
        $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
        }, 500);
        });
        </script>
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