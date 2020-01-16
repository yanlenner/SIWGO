<?php
session_start();
if(isset($_SESSION['usuario']) && $_SESSION['nivel'] =='a'){
$fechaGuardada = $_SESSION["ultimoAcceso"];
$ahora = date("Y-n-j H:i:s");
$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
include '../../../src/php/enlace.php';
$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$enlace->set_charset('utf8');
if (!$enlace) die("Conexión fallida: " . mysqli_connect_error());
$result = mysqli_query($enlace, "SELECT max(id_sesion) as id FROM sesion WHERE usuario = '$_SESSION[usuario]'");
$row = mysqli_fetch_assoc($result);
$query = mysqli_query($enlace, "INSERT into registro_devisitas (id_sesion, enlace, tiempo) values('$row[id]','$_SERVER[PHP_SELF]','$ahora')");
//comparamos el tiempo transcurrido
if($tiempo_transcurrido < 0 || $tiempo_transcurrido > 599)
{
//si pasaron 10 minutos o más
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
    <link rel="stylesheet" href="../../../src/css/font-awesome">
    <link rel="stylesheet" href="../../../src/css/materialize">
    <link rel="stylesheet" href="../../../src/css/style2">
    <link rel="stylesheet" href="../../../src/css/navbar">
  </head>
  <body>
    <header>
      <h2>Sistema de Información Web para la Gestión de Pacientes del Servicio Odontológico "Kléber Ramírez"</h2>
      <nav class="fill">
        <ul class="right">
          <li><a id="puesto">Gestionar Perfil del Paciente</a></li>
          <li><a href="../reporte">Emisión de Reportes</a></li>
          <li><a href="../salir">Terminar Sesión</a></li>
        </ul>
      </nav>
    </header>
    <ul id="slide-out" class="sidenav">
      <li><a href="registrar" class="tooltipped" data-position="right" data-tooltip="Permite el registro de un nuevo paciente"><i class="fa fa-lg fa-pencil"></i> Registrar perfil del Paciente</a></li>
      <li><a href="consultar" class="tooltipped" data-position="right" data-tooltip="Busca un paciente en los registros y muestra su perfil"><i class="fa fa-lg fa-neuter"></i> Consultar Perfil</a></li>
      <li><a href="eliminar" class="tooltipped" data-position="right" data-tooltip="Busca un paciente en los registros y permite eliminar su perfil"><i class="fa fa-lg fa-ban"></i> Eliminar perfil del Paciente</a></li>
      <li><a href="actualizar" class="tooltipped" data-position="right" data-tooltip="Busca un paciente en los registros y permite actualizar su perfil"><i class="fa fa-lg fa-refresh"></i> Actualizar Perfil</a></li>
      <li><a class="tooltipped" data-position="right" data-tooltip="Regresa al menú principal" style="cursor: pointer;" onclick="top.location.href = '../'"><i class="fa fa-lg fa-arrow-left"></i> Volver</a></li>
    </ul>
    <br><br>
    <div class="row">
      <form id="formulario" class="col s12" method="post" action="create">
        <!--Progressbar-->
        <ul class='progress'>
          <li class="active f1">Identificación del Paciente</li>
          <li>Antecedentes Personales</li>
          <li>Finalizar Registro</li>
        </ul>
        <br><br>
        <fieldset class="campo-morado">
          <a data-target="slide-out" class="sidenav-trigger">
            <h5 class="blanco f1"><img class="tooltipped menui" src="../../../src/img/menuper.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Registrar Identificación del Paciente</h5>
          </a>
          <div class="row">
            <div class="input-field col s6">
              <input id="cedula" type="text" class="validate identificacion blanco" name="ci" autocomplete="off" required="">
              <label for="cedula">Número de cédula</label>
            </div>
            <div class="input-field col s6">
              <input id="fecha" type="text" class="validate datepicker blanco" name="nacimiento" onkeyup="this.value=NoEscribir(this.value)" autocomplete="off" required="">
              <label for="fecha">Fecha de nacimiento</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="nombre" type="text" class="validate blanco" onkeyup="this.value=Letras(this.value)" maxlength="30" name="nombre" autocomplete="off" required="">
              <label for="nombre"> Nombres</label>
            </div>
            <div class="input-field col s6">
              <input id="apellido" type="text" class="validate blanco" onkeyup="this.value=Letras(this.value)" maxlength="30" name="apellido" autocomplete="off" required="">
              <label for="apellido"> Apellidos</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <select id="carrera" class="browser-default" name="carrera">
                <optgroup label="Agro y del Mar">
                  <option value="PNF en Agroalimentación">PNF en Agroalimentación</option>
                  <option value="PNF en Seguridad Alimentaria y Cultura Nutricional">PNF en Seguridad Alimentaria y Cultura Nutricional</option>
                  <option value="TSU en Manejo de Emergencias y Acción Contra Desastres">TSU en Manejo de Emergencias y Acción Contra Desastres</option>
                </optgroup>
                <optgroup label="Salud">
                  <option value="PNF en Enfermería">PNF en Enfermería</option>
                  <option value="PNF en Fonoaudiología">PNF en Fonoaudiología</option>
                  <option value="PNF en Histocitotecnología">PNF en Histocitotecnología</option>
                  <option value="PNF en Nutrición y Dietetica">PNF en Nutrición y Dietetica</option>
                  <option value="PNF en Radiología e Imagenologia">PNF en Radiología e Imagenologia</option>
                </optgroup>
                <optgroup label="Sociales">
                  <option value="PNF en Administración">PNF en Administración</option>
                  <option value="PNF en Contaduría Pública">PNF en Contaduría Pública</option>
                  <option value="PNF en Historia">PNF en Historia</option>
                  <option value="PNF en Psicología Social">PNF en Psicología Social</option>
                  <option value="PNF en Turismo">PNF en Turismo</option>
                </optgroup>
                <optgroup label="Tecnología">
                  <option value="PNF en Construcción Civil">PNF en Construcción Civil</option>
                  <option value="PNF en Geociencias">PNF en Geociencias</option>
                  <option value="PNF en Informática">PNF en Informática</option>
                </optgroup>
              </select>
            </div>
            <div class="input-field col s6">
              <input id="carne" type="text" class="validate blanco" name="ce" onkeyup="this.value=Numeros(this.value)" maxlength="9" autocomplete="off">
              <label for="carne">Número de carnet</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="numero" type="text" class="validate blanco" name="telefono" onkeyup="this.value=Numeros(this.value)" maxlength="12" autocomplete="off" required="">
              <label for="numero"> Número de celular/teléfono</label>
            </div>
            <div class="input-field col s6 demo-masked-input">
              <input id="email" type="text" class="validate blanco email" name="correo"  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" maxlength="30" autocomplete="off" required="">
              <label for="email"> Correo electrónico</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="direccion" type="text" class="validate blanco" name="domicilio" onkeyup="this.value=Dir(this.value)" maxlength="50" autocomplete="off" required="">
              <label for="direccion"> Dirección de domicilio</label>
            </div>
            <div class="input-field col s6">
              <p>
                <label>
                  <input class="with-gap" name="sex" type="radio" value="H" checked="" />
                  <span class="gen"> Hombre </span>
                </label>
                <label>
                  <input class="with-gap" name="sex" type="radio" value="M"/>
                  <span class="gen">Mujer</span>
                </label>
              </p>
            </div>
          </div>
          <input class="btn-verde in-right siguiente sp tooltipped" type="button" value="Siguiente" data-position="left" data-tooltip="Avanza hacia el siguiente recuadro">
          <input class="btn-gris in-left tooltipped" type="reset" value="Borrar Formulario" data-position="right" data-tooltip="Vacia todos los campos del formulario">
        </fieldset>
        <fieldset class="campo-morado" style="display: none;">
          <h5 class="blanco">Registrar Antecedentes Personales</h5>
          <div class="row center">
            <div class="col s3">
              <label>Tratamientos: </label>
            </div>
            <div class="col s6">
              <label>Padecimientos: </label>
            </div>
            <div class="col s3">
              <label>Alergias: </label>
            </div>
          </div>
          <div class="row">
            <div class="col s3">
              <label class="in-left">
                <input type="checkbox" name="antecedente[]" value="Embarazo" disabled="" />
                <span>Embarazo</span>
              </label>
            </div>
            <div class="col s3">
              <label class="center">
                <input type="checkbox" name="antecedente[]" value="DiversidadFuncional" />
                <span>Diversidad Funcional</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="Asma" />
                <span>Asma</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="Aspirina" />
                <span>Aspirina</span>
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col s3">
              <label class="in-left">
                <input type="checkbox" name="antecedente[]" value="ConsultasMédicas" />
                <span>Consultas Médicas</span>
              </label>
            </div>
            <div class="col s3">
              <label class="center">
                <input type="checkbox" name="antecedente[]" value="UlceraGástrica" />
                <span>Ulcera Gástrica</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="Anemia" />
                <span>Anemia</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="Penicilina" />
                <span>Penicilina</span>
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col s3">
              <label class="in-left">
                <input type="checkbox" name="antecedente[]" value="ConsumodeTabaco" />
                <span>Consumo de Tabaco</span>
              </label>
            </div>
            <div class="col s3">
              <label class="center">
                <input type="checkbox" name="antecedente[]" value="FiebreReumática" />
                <span>Fiebre Reumática</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="Tiroides" />
                <span>Tiroides</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="Anestesia" />
                <span>Anestesia</span>
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col s3">
              <label class="in-left">
                <input type="checkbox" name="antecedente[]" value="TransfusiónSanguínea" />
                <span>Transfusión Sanguínea</span>
              </label>
            </div>
            <div class="col s3">
              <label class="center">
                <input type="checkbox" name="antecedente[]" value="RespiraciónBucal" />
                <span>Respiración Bucal</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="Diabetes" />
                <span>Diabetes</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="Iodo" />
                <span>Iodo</span>
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col s3">
              <label class="in-left">
                <input type="checkbox" name="antecedente[]" value="IntervenciónQuirúrgica" />
                <span>Intervención Quirúrgica</span>
              </label>
            </div>
            <div class="col s3">
              <label class="center">
                <input type="checkbox" name="antecedente[]" value="DefícitdeVitaminaK" />
                <span>Defícit de Vitamina K</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="Hepatitís" />
                <span>Hepatitís</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="OtrasAlergias" />
                <span>Otras Alergias</span>
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col s3">
              <label class="in-left">
                <input type="checkbox" name="antecedente[]" value="ConsumodePastillasA.C." disabled="" />
                <span>Consumo de Pastillas A.C.</span>
              </label>
            </div>
            <div class="col s3">
              <label class="center">
                <input type="checkbox" name="antecedente[]" value="ApretamientoDentario" />
                <span>Apretamiento Dentario</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="Leucemia" />
                <span>Leucemia</span>
              </label>
            </div>
            <div class="col s3">
            </div>
          </div>
          <div class="row">
            <div class="col s3">
            </div>
            <div class="col s3">
              <label class="center">
                <input type="checkbox" name="antecedente[]" value="ProblemasdelCorazón" />
                <span>Problemas del Corazón</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="Hemofilia" />
                <span>Hemofilia</span>
              </label>
            </div>
            <div class="col s3">
            </div>
          </div>
          <div class="row">
            <div class="col s3">
            </div>
            <div class="col s3">
              <label class="center">
                <input type="checkbox" name="antecedente[]" value="EnfermedadesVenéreas" />
                <span>Enfermedades Venéreas</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="HerpesoAftasfrecuentes" />
                <span>Herpes o Aftas frecuentes</span>
              </label>
            </div>
            <div class="col s3">
            </div>
          </div>
          <div class="row">
            <div class="col s3">
            </div>
            <div class="col s3">
              <label class="center">
                <input type="checkbox" name="antecedente[]" value="Ruidosalabrir/cerrarlaboca" />
                <span>Ruidos al abrir/cerrar la boca</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input type="checkbox" name="antecedente[]" value="SangradoExcesivoalCortarse" />
                <span>Sangrado Excesivo al Cortarse</span>
              </label>
            </div>
            <div class="col s3">
            </div>
          </div>
          <div class="row">
            <div class="col s3">
            </div>
            <div class="col s3">
              <label class="center">
                <input type="checkbox" name="antecedente[]" value="Lim.paraabrir/cerrarlaboca" />
                <span>Lim. para abrir/cerrar la boca</span>
              </label>
            </div>
            <div class="col s3">
              <label class="in-right">
                <input id="sano" type="checkbox" name="antecedente[]" value="Saludable" />
                <span>El Paciente manifiesta ser saludable, sin antecedentes</span>
              </label>
            </div>
            <div class="col s3">
            </div>
          </div>
          <input id="registrarp" class="btn-azul in-right siguiente sp tooltipped" type="button" disabled value="Registrar" data-position="left" data-tooltip="Registra los datos escritos">
          <input class="btn-verde in-left atras tooltipped" type="button" value="Atras"  data-position="right" data-tooltip="Regresa hacia el recuadro anterior">
        </fieldset>
        <fieldset class="campo-morado" style="display: none;">
          <h5 class="blanco">Finalizar Registro</h5>
          <div align="center">
            <img src="../../../src/img/saltos.gif">
          </div>
          <input class="btn-verde in-left atras tooltipped" type="button" value="Atras"  data-position="right" data-tooltip="Regresa hacia el recuadro anterior">
        </fieldset>
      </form>
    </div>
    <script src="../../../src/js/jquery-3.js"></script>
    <script src="../../../src/js/jquery-mask.js"></script>
    <script src="../../../src/js/jquery-inputmask.js"></script>
    <script src="../../../src/js/materialize.js"></script>
    <script src="../../../src/js/main.js"></script>
    <script type="text/javascript">
    $(function() {
    $('.demo-masked-input').find('.email').inputmask({
    alias: 'email'
    })
    }),
    $('email').mouseout(function() {
    $(this).val(),
    new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/)
    }),
    $(':checkbox[value=Saludable]').click(function() {
    if ($(this).is(':checked')) {
    $(':checkbox').each(function() {
    $(this).prop("checked", 0),
    $(':checkbox[value=Saludable]').prop("checked", 1),
    $(this).attr('disabled', 'disabled'),
    $(':checkbox[value=Saludable]').removeAttr('disabled')
    })
    } else {
    $(':checkbox').each(function() {
    $(this).removeAttr('disabled');
    if ($('.with-gap[value=H]').is(':checked')) {
    $(':checkbox[value=Embarazo]').attr('disabled', 'disabled'),
    $(':checkbox[value=\'ConsumodePastillasA.C.\']').attr('disabled', 'disabled')
    }
    })
    }
    });
    $('.sp').click(function() {
    if ($('.with-gap[value=H]').is(':checked')) {
    $(':checkbox[value=Embarazo]').attr('disabled', 'disabled'),
    $(':checkbox[value=\'ConsumodePastillasA.C.\']').attr('disabled', 'disabled')
    }
    if ($('.with-gap[value=M]').is(':checked')) {
    $(':checkbox[value=Embarazo]').removeAttr('disabled'),
    $(':checkbox[value=\'ConsumodePastillasA.C.\']').removeAttr('disabled')
    }
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