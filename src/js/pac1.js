function desactivar() {
  $('#cedula').focus(),
  $('#result').attr('disabled', 'true'),
  $('#date').attr('disabled', 'true')
}
function verificar() {
  setTimeout(function () {
    $('#cedula').val() && $('#result').val() && '' != $('#date').val() && $('#del_pac').removeAttr('disabled')
  }, 999)
}
function buscar() {
  var a = $('#cedula').val();
  '' === a ? (alert('El campo Número de cédula esta vacío'), desactivar())  : $.ajax({
    type: 'POST',
    url: '../../../src/php/fin_pactrabajador.php',
    data: {
      search: a
    }
  }).done(function (b) {
    'true' === b ? ($('#result').val(''), alert('Has escrito el Número de cédula de un trabajador del servicio odontólogico, \npor tanto la operación a realizar no puede ser procesada'),$(':reset').click())  : 
($.ajax({
    type: 'POST',
    url: '../../../src/php/fin_pacnombre.php',
    data: {
      search: a
    }
  }).done(function (a) {
    'false' === a ? ($('#result').val(''), alert('No se encontro el perfil de este paciente'))  : '' === a ? (alert('Datos vacíos, debe actualizar el perfil del paciente'), desactivar())  : ($('#result').val(a), $('#result').removeAttr('disabled'), $('#result').focus())
  }), $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_pacedad.php',
        data: {
          search: a
        }
      }).done(function (a) {
        'false' === a || ($('#date').val(a), $('#date').removeAttr('disabled'), $('#date').focus(), $('#cedula').focus(), verificar())
      }))
    })} 
$('#cedula').focus();
