function activarbt1() {
  setTimeout(function () {
    $('#cedula').val() && $('#result').val() && '' != $('#date').val() && $('#t1').removeAttr('disabled')
  }, 700)
}
function desactivarbt1() {
  $('#t1').attr('disabled', 'disabled'),
  $('#result').val(''),
  $('#date').val(''),
  $('#result').focus(),
  $('#date').focus(),
  $('#result').blur(),
  $('#date').blur()
}
function verificar() {
  setTimeout(function () {
    $('#cedula').val() && $('#result').val() && '' != $('#date').val() && ($(':submit').removeAttr('disabled'), $('#del_pac').removeAttr('disabled'))
  }, 700)
}
function buscar() {
  desactivarbt1();
  var a = $('#cedula').val();
  '' === a ? (alert('El campo Número de cédula esta vacío'), $('#cedula').focus(), $('#del_pac').attr('disabled', 'true'), $('#result').attr('disabled', 'true'), $('#date').attr('disabled', 'true'))  : $.ajax({
    type: 'POST',
    url: '../../../src/php/fin_pactrabajador.php',
    data: {
      search: a
    }
  }).done(function (e) {
    'true' === e ? alert('Has escrito el Número de cédula de un trabajador del servicio odontólogico, \npor tanto la operación a realizar no puede ser procesada')  : $.ajax({
      type: 'POST',
      url: '../../../src/php/fin_pacnombre.php',
      data: {
        search: a
      }
    }).done(function (e) {
      'false' === e ? ($('#result').val(''), alert('No se encontro el perfil de este paciente'))  : '' === e ? alert('Datos vacíos, debe actualizar el perfil del paciente')  : $.ajax({
        type: 'POST',
        url: '../../../src/php/fin_paccon.php',
        data: {
          search: a
        }
      }).done(function (t) {
        'false' === t ? alert('El paciente no tiene consultas asociadas, porfavor registre una para poder redactar el informe')  : $.ajax({
          type: 'POST',
          url: '../../../src/php/fin_pacinf.php',
          data: {
            search: a
          }
        }).done(function (t) {
          'false' === t ? alert('El paciente no tiene su informe redactado, porfavor usa la opción Registrar Informe')  : ($('#result').val(e), $('#result').focus(), $.ajax({
            type: 'POST',
            url: '../../../src/php/fin_pacedad.php',
            data: {
              search: a
            }
          }).done(function (e) {
            'false' === e || ($('#date').val(e), $('#date').focus(), $.ajax({
              type: 'POST',
              url: '../../../src/php/fin_pacasp.php',
              data: {
                search: a
              }
            }).done(function (a) {
              $('#aspecto').val(a)
            }), $.ajax({
              type: 'POST',
              url: '../../../src/php/fin_pachal.php',
              data: {
                search: a
              }
            }).done(function (a) {
              $('#hallazgo').val(a)
            }), $.ajax({
              type: 'POST',
              url: '../../../src/php/fin_pacobs.php',
              data: {
                search: a
              }
            }).done(function (a) {
              $('#observacion').val(a)
            }), $.ajax({
              type: 'POST',
              url: '../../../src/php/fin_pacrsp.php',
              data: {
                search: a
              }
            }).done(function (a) {
              $('#respuesta').val(a)
            }))
          }))
        })
      })
    })
  })
}
$('#t1').on('click', function (a) {
  a.preventDefault(),
  $('textarea').each(function () {
    $(this).focus()
  })
}),
$(function () {
  $('textarea').on('change', function () {
    $('#aspecto').val() && $('#hallazgo').val() && $('#observacion').val() && '' != $('#respuesta').val() ? $('#ai').removeAttr('disabled')  : $('#ai').attr('disabled', 'disabled')
  })
}),
$('#cedula').focus();
