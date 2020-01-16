function desactivar() {
  $('#cedula').focus(),
  $('#nombre').attr('disabled', 'true'),
  $('#fecha').attr('disabled', 'true'),
  $('#numero').attr('disabled', 'true'),
  $('#carne').attr('disabled', 'true'),
  $('#apellido').attr('disabled', 'true'),
  $('#email').attr('disabled', 'true'),
  $('#direccion').attr('disabled', 'true'),
  $('#carrera').attr('disabled', 'true'),
  $(':radio').attr('disabled', 'true'),
  $('#edad').attr('disabled', 'true'),
  $(':checkbox').attr('disabled', 'true'),
  $('.sp').attr('disabled', 'true')
}
function buscar() {
  var a = $('#cedula').val();
  '' === a ? (alert('El campo Número de cédula esta vacío'), desactivar())  : $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_pacnombre.php',
        data: {
          search: a
        }
      }).done(function (a) {
        'false' === a ? alert('No se encontro el perfil de este paciente')  : ($('#nombre').val(a), $('#nombre').removeAttr('disabled'), $('#nombre').focus())
      }), $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_pacfecha.php',
        data: {
          search: a
        }
      }).done(function (a) {
        'false' === a || ($('#fecha').val(a), $('#fecha').removeAttr('disabled'), $('#fecha').focus())
      }), $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_pactel.php',
        data: {
          search: a
        }
      }).done(function (a) {
        'false' === a || ($('#numero').val(a), $('#numero').removeAttr('disabled'), $('#numero').focus())
      }), $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_pacest.php',
        data: {
          search: a
        }
      }).done(function (a) {
        'false' === a || ($('#carne').val(a), $('#carne').removeAttr('disabled'), $('#carne').focus())
      }), $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_pacap.php',
        data: {
          search: a
        }
      }).done(function (a) {
        'false' === a || ($('#apellido').val(a), $('#apellido').removeAttr('disabled'), $('#apellido').focus())
      }), $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_pacem.php',
        data: {
          search: a
        }
      }).done(function (a) {
        'false' === a || ($('#email').val(a), $('#email').removeAttr('disabled'), $('#email').focus())
      }), $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_pacdom.php',
        data: {
          search: a
        }
      }).done(function (a) {
        'false' === a || ($('#direccion').val(a), $('#direccion').removeAttr('disabled'), $('#direccion').focus())
      }), $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_paccar.php',
        data: {
          search: a
        }
      }).done(function (a) {
        'false' === a || ($('#carrera').val(a), $('#carrera').removeAttr('disabled'), $('#carrera').focus(), $('.sp').removeAttr('disabled'))
      }), $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_pacgen.php',
        data: {
          search: a
        }
      }).done(function (a) {
        var e = a.split(' ');
        $(':radio').val(e) && ($(this).prop('checked', !0), $(':radio').removeAttr('disabled'))
      }), $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_pacedad.php',
        data: {
          search: a
        }
      }).done(function (a) {
        $('#edad').val(a)
      }), $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_pacant.php',
        data: {
          search: a
        }
      }).done(function (a) {
        var e = a.split(' ');
        $(':checkbox').val(e) && ($(this).prop('checked', !0), $(':checkbox').removeAttr('disabled')),
        ',Saludable' == e && ($(':checkbox').each(function () {
          $(this).attr('disabled', 'disabled')
        }), $(':checkbox[value=Saludable]').removeAttr('disabled'))
      })
    
}
$('#cedula').focus(),
$(function () {
  $(':radio[value=M]').on('click', function () {
    $('h5.f1').attr('enabled', 'M' == $(this).val()).html('<img class="tooltipped menui" src="../../../src/img/menu.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Actualizar Identificación de la Paciente'),
    $('li.f1').html('Identificación de la Paciente')
  }),
  $(':radio[value=H]').on('click', function () {
    $('h5.f1').html('<img class="tooltipped menui" src="../../../src/img/menu.png" data-position="bottom" data-tooltip="Muestra el menú lateral izquierdo"> Actualizar Identificación del Paciente'),
    $('li.f1').html('Identificación del Paciente')
  })
});
