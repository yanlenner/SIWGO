function activar(){$("#nombre").removeAttr("disabled"),$("#apellido").removeAttr("disabled"),$("#fecha").removeAttr("disabled","true"),$("#carrera").removeAttr("disabled"),$("#carne").removeAttr("disabled"),$("#numero").removeAttr("disabled"),$("#email").removeAttr("disabled"),$("#direccion").removeAttr("disabled"),$(".siguiente").removeAttr("disabled"),$("input[name=sex]").removeAttr("disabled")}function desactivar(){$("#cedula").focus(),$(".siguiente").attr("disabled","true"),$("#fecha").attr("disabled","true"),$("#nombre").attr("disabled","true"),$("#apellido").attr("disabled","true"),$("#carrera").attr("disabled","true"),$("#carne").attr("disabled","true"),$("#numero").attr("disabled","true"),$("#email").attr("disabled","true"),$("#direccion").attr("disabled","true"),$("input[name=sex]").attr("disabled","true")}function regularidad(){var e=$("#cedula").val();$.ajax({type:"POST",url:"../../../src/php/fin_pactrabajador.php",data:{search:e}}).done(function(a){"true"===a?(alert("Has escrito el Número de cédula de un trabajador del servicio odontólogico,  \npor tanto la operación a realizar no puede ser procesada"),desactivar()):$.ajax({type:"POST",url:"../../../src/php/fin_esregular.php",data:{search:e.slice(2,e.length)}}).done(function(a){"false"===a?""==e?(alert("Debes escribir el Número de cédula del paciente"),desactivar()):(alert("El Número de cédula ingresado hace referencia a un estudiante irregular, \npor tanto el estudiante no puede ser atendido"),desactivar()):activar(),$.ajax({type:"POST",url:"../../../src/php/put_name.php",data:{search:e.slice(2,e.length)}}).done(function(e){$("#nombre").val(e),$("#nombre").focus(),$("#nombre").blur()}),$.ajax({type:"POST",url:"../../../src/php/put_apel.php",data:{search:e.slice(2,e.length)}}).done(function(e){$("#apellido").val(e),$("#apellido").focus(),$("#apellido").blur()}),$.ajax({type:"POST",url:"../../../src/php/put_carn.php",data:{search:e.slice(2,e.length)}}).done(function(e){$("#carne").val(e),$("#carne").focus(),$("#carne").blur()}),$.ajax({type:"POST",url:"../../../src/php/put_carr.php",data:{search:e.slice(2,e.length)}}).done(function(e){$("#carrera").val(e),$("#carrera").focus(),$("#carrera").blur()})})})}$("#cedula").focus(),$(".with-gap[value=H]").on("click",function(e){$("h5.f1").html('<img class="tooltipped menui" src="../../../src/img/menu.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Registrar Identificación del Paciente'),$("li.f1").html("Identificación del Paciente")}),$(".with-gap[value=M]").on("click",function(e){$("h5.f1").html('<img class="tooltipped menui" src="../../../src/img/menu.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Registrar Identificación de la Paciente'),$("li.f1").html("Identificación de la Paciente")});