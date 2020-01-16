function desactivar() {
  $('#result').val(''),
  $('#date').val(''),
  $('#result').focus(),
  $('#date').focus(),
  $('#result').blur(),
  $('#date').blur(),
  $('#result').attr('disabled', 'true'),
  $('#date').attr('disabled', 'true')
}
function verificar() {
  setTimeout(function () {
    $('#cedula').val() && $('#result').val() && '' != $('#date').val() && $(':submit').removeAttr('disabled')
  }, 999)
}
function buscar() {
  $(':submit').attr('disabled', '');
  var a = $('#cedula').val();
  '' === a ? (alert('El campo Número de cédula esta vacío'), desactivar())  : $.ajax({
    type: 'POST',
    url: '../../../src/php/fin_pactrabajador.php',
    data: {
      search: a
    }
  }).done(function (b) {
    'true' === b ? (alert('Has escrito el Número de cédula de un trabajador del servicio odontólogico, \npor tanto la operación a realizar no puede ser procesada'),$(':reset').click())  : 
  ($.ajax({
    type: 'POST',
    url: '../../../src/php/fin_pacnombre.php',
    data: {
      search: a
    }
  }).done(function (a) {
    'false' === a ? ($('#result').val(''), alert('No se encontro el perfil de este paciente'))  : '' === a ? (alert('Datos vacíos, debe actualizar el perfil del paciente'), desactivar())  : ($('#result').val(a), $('#result').removeAttr('disabled'), $('#result').focus())
  }),
  $.ajax({
    type: 'POST',
    url: '../../../src/php/fin_pacap.php',
    data: {
      search: a
    }
  }).done(function (a) {
    'false' === a || $('#ape').val(a)
  }),
  $.ajax({
    type: 'POST',
    url: '../../../src/php/fin_pacedad.php',
    data: {
      search: a
    }
  }).done(function (a) {
    'false' === a || ($('#date').val(a), $('#date').removeAttr('disabled'), setTimeout(function () {
      $('#result').focus(),
      $('#date').focus()
    }, 333), $('#date').removeAttr('disabled'), verificar())
  }))



      })
}
$('#cedula').focus();
