function Numeros(e) { //Solo numeros
    var out = '';
    var filtro = ' 1234567890'; //Caracteres validos
    //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
    for (var i = 0; i < e.length; i++)
        if (filtro.indexOf(e.charAt(i)) != -1) //Se añaden a la salida los caracteres validos
            out += e.charAt(i);
        else
            M.toast({
                html: 'Aviso: sólo puedes ingresar digitos en ese campo!'
            });
        //Retornar valor filtrado
    return out;
}

function Reposo(e) { //Solo numeros
    var out = '';
    var filtro = '123'; //Caracteres validos
    //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
    for (var i = 0; i < e.length; i++)
        if (filtro.indexOf(e.charAt(i)) != -1) //Se añaden a la salida los caracteres validos
            out += e.charAt(i);
        else
            M.toast({
                html: 'Aviso: sólo puedes ingresar digitos: 1, 2 y 3 en ese campo!'
            });
        //Retornar valor filtrado
    return out;
}

function Letras(e) { //Solo letras
    var out = '';
    var filtro = ' áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ'; //Caracteres validos
    //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
    for (var i = 0; i < e.length; i++)
        if (filtro.indexOf(e.charAt(i)) != -1) //Se añaden a la salida los caracteres validos
            out += e.charAt(i);
        else
            M.toast({
                html: 'Aviso: sólo puedes ingresar letras en ese campo!'
            });
        //Retornar valor filtrado
    return out;
}

function Dir(e) { //Letras y numeros, aparte solo permite coma guion numeral y punto
    var out = '';
    var filtro = ' áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890,-#/.'; //Caracteres validos
    //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
    for (var i = 0; i < e.length; i++)
        if (filtro.indexOf(e.charAt(i)) != -1) //Se añaden a la salida los caracteres validos
            out += e.charAt(i);
        else
            M.toast({
                html: 'Aviso: sólo puedes ingresar letras, números y caracteres especiales: / , - # .'
            });
        //Retornar valor filtrado
    return out;
}

function NoEscribir(e) { //No se permite ingresar caracteres de ningun tipo
    var out = '';
    var filtro = ''; //Caracteres validos
    //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
    for (var i = 0; i < e.length; i++)
        if (filtro.indexOf(e.charAt(i)) != -1) //Se añaden a la salida los caracteres validos
            out += e.charAt(i);
        else
            M.toast({
                html: 'Aviso: No puedes ingresar texto en ese campo!'
            });
        //Retornar valor filtrado
    return out;
}

function pieza(e) {
    $('#pieza').removeAttr('hidden'),
        41 == e && ($('#diente').html('Primer Incisivo Inferior Izquierdo'), $('#pieza').html('Primer Incisivo Inferior Izquierdo'), $('#pieza2').attr('value', 'PIII-41')),
        42 == e && ($('#diente').html('Segundo Incisivo Inferior Izquierdo'), $('#pieza').html('Segundo Incisivo Inferior Izquierdo'), $('#pieza2').attr('value', 'SIII-42')),
        43 == e && ($('#diente').html('Canino Inferior Izquierdo'), $('#pieza').html('Canino Inferior Izquierdo'), $('#pieza2').attr('value', 'CII-43')),
        44 == e && ($('#diente').html('Primer Premolar Inferior Izquierdo'), $('#pieza').html('Primer Premolar Inferior Izquierdo'), $('#pieza2').attr('value', 'PPII-44')),
        45 == e && ($('#diente').html('Segundo Premolar Inferior Izquierdo'), $('#pieza').html('Segundo Premolar Inferior Izquierdo'), $('#pieza2').attr('value', 'SPII-45')),
        46 == e && ($('#diente').html('Primer Molar Inferior Izquierdo'), $('#pieza').html('Primer Molar Inferior Izquierdo'), $('#pieza2').attr('value', 'PMII-46')),
        47 == e && ($('#diente').html('Segundo Molar Inferior Izquierdo'), $('#pieza').html('Segundo Molar Inferior Izquierdo'), $('#pieza2').attr('value', 'SMII-47')),
        48 == e && ($('#diente').html('Tercer Molar Inferior Izquierdo'), $('#pieza').html('Tercer Molar Inferior Izquierdo'), $('#pieza2').attr('value', 'TMII-48')),
        11 == e && ($('#diente').html('Primer Incisivo Superior Izquierdo'), $('#pieza').html('Primer Incisivo Superior Izquierdo'), $('#pieza2').attr('value', 'PISI-11')),
        12 == e && ($('#diente').html('Segundo Incisivo Superior Izquierdo'), $('#pieza').html('Segundo Incisivo Superior Izquierdo'), $('#pieza2').attr('value', 'SISI-12')),
        13 == e && ($('#diente').html('Canino Superior Izquierdo'), $('#pieza').html('Canino Superior Izquierdo'), $('#pieza2').attr('value', 'CSI-13')),
        14 == e && ($('#diente').html('Primer Premolar Superior Izquierdo'), $('#pieza').html('Primer Premolar Superior Izquierdo'), $('#pieza2').attr('value', 'PPSI-14')),
        15 == e && ($('#diente').html('Segundo Premolar Superior Izquierdo'), $('#pieza').html('Segundo Premolar Superior Izquierdo'), $('#pieza2').attr('value', 'SPSI-15')),
        16 == e && ($('#diente').html('Primer Molar Superior Izquierdo'), $('#pieza').html('Primer Molar Superior Izquierdo'), $('#pieza2').attr('value', 'PMSI-16')),
        17 == e && ($('#diente').html('Segundo Molar Superior Izquierdo'), $('#pieza').html('Segundo Molar Superior Izquierdo'), $('#pieza2').attr('value', 'SMSI-17')),
        18 == e && ($('#diente').html('Tercer Molar Superior Izquierdo'), $('#pieza').html('Tercer Molar Superior Izquierdo'), $('#pieza2').attr('value', 'TMSI-18')),
        31 == e && ($('#diente').html('Primer Incisivo Inferior Derecho'), $('#pieza').html('Primer Incisivo Inferior Derecho'), $('#pieza2').attr('value', 'PIID-31')),
        32 == e && ($('#diente').html('Segundo Incisivo Inferior Derecho'), $('#pieza').html('Segundo Incisivo Inferior Derecho'), $('#pieza2').attr('value', 'SIID-32')),
        33 == e && ($('#diente').html('Canino Inferior Derecho'), $('#pieza').html('Canino Inferior Derecho'), $('#pieza2').attr('value', 'CID-33')),
        34 == e && ($('#diente').html('Primer Premolar Inferior Derecho'), $('#pieza').html('Primer Premolar Inferior Derecho'), $('#pieza2').attr('value', 'PPID-34')),
        35 == e && ($('#diente').html('Segundo Premolar Inferior Derecho'), $('#pieza').html('Segundo Premolar Inferior Derecho'), $('#pieza2').attr('value', 'SPID-35')),
        36 == e && ($('#diente').html('Primer Molar Inferior Derecho'), $('#pieza').html('Primer Molar Inferior Derecho'), $('#pieza2').attr('value', 'PMID-36')),
        37 == e && ($('#diente').html('Segundo Molar Inferior Derecho'), $('#pieza').html('Segundo Molar Inferior Derecho'), $('#pieza2').attr('value', 'SMID-37')),
        38 == e && ($('#diente').html('Tercer Molar Inferior Derecho'), $('#pieza').html('Tercer Molar Inferior Derecho'), $('#pieza2').attr('value', 'TMID-38')),
        21 == e && ($('#diente').html('Primer Incisivo Superior Derecho'), $('#pieza').html('Primer Incisivo Superior Derecho'), $('#pieza2').attr('value', 'PISD-21')),
        22 == e && ($('#diente').html('Segundo Incisivo Superior Derecho'), $('#pieza').html('Segundo Incisivo Superior Derecho'), $('#pieza2').attr('value', 'SISD-22')),
        23 == e && ($('#diente').html('Canino Superior Derecho'), $('#pieza').html('Canino Superior Derecho'), $('#pieza2').attr('value', 'CSD-23')),
        24 == e && ($('#diente').html('Primer Premolar Superior Derecho'), $('#pieza').html('Primer Premolar Superior Derecho'), $('#pieza2').attr('value', 'PPSD-24')),
        25 == e && ($('#diente').html('Segundo Premolar Superior Derecho'), $('#pieza').html('Segundo Premolar Superior Derecho'), $('#pieza2').attr('value', 'SPSD-25')),
        26 == e && ($('#diente').html('Primer Molar Superior Derecho'), $('#pieza').html('Primer Molar Superior Derecho'), $('#pieza2').attr('value', 'PMSD-26')),
        27 == e && ($('#diente').html('Segundo Molar Superior Derecho'), $('#pieza').html('Segundo Molar Superior Derecho'), $('#pieza2').attr('value', 'SMSD-27')),
        28 == e && ($('#diente').html('Tercer Molar Superior Derecho'), $('#pieza').html('Tercer Molar Superior Derecho'), $('#pieza2').attr('value', 'TMSD-28'))
}

function paso1() {
    $('#t2').attr('disabled', 'disabled')
}

function paso2() {
    $('#t2').removeAttr('disabled')
}
$(document).ready(function() {
        document.querySelector('form').reset(),
            document.oncontextmenu = function() {
                return !1
            }
    }),
    $(function() {
        $('.identificacion').mask('C-19999999', {
                translation: {
                    0: {
                        pattern: /\d/
                    },
                    1: {
                        pattern: /[1-9]/
                    },
                    9: {
                        pattern: /\d/,
                        optional: !0
                    },
                    '#': {
                        pattern: /\d/,
                        recursive: !0
                    },
                    C: {
                        pattern: /V|E/,
                        fallback: 'V'
                    }
                }
            }),
            $('.identificacion').on('input', function(e) {
                var r = $(this).val();
                r.length > 5 && (r.substring(2) > 80000000 ? $(this).val('E-' + r.substring(2)) : $(this).val('V-' + r.substring(2)))
            })
    }),
    $(function() {
        let e = $('#numero'),
            r = $('button.btn-verde');
        e.mask('0122 2222222', {
                translation: {
                    0: {
                        pattern: /0/
                    },
                    1: {
                        pattern: /2|4/
                    },
                    2: {
                        pattern: /[0-9]/
                    }
                }
            }),
            e.on('input', function() {
                e.val() ? r.prop('disabled', !1) : r.prop('disabled', !0)
            }).trigger('input')
    }),
    $('.sp').on('click', function(e) {
        e.preventDefault();
        var r = 0;
        '' == $('#cedula').val() ? alert('Debes escribir el Número de cédula del Paciente') : r += 1,
            '' == $('#fecha').val() ? alert('Debes escribir la Fecha de nacimiento del Paciente') : r += 1,
            '' == $('#nombre').val() ? alert('Debes escribir los Nombres del Paciente') : r += 1,
            '' == $('#apellido').val() ? alert('Debes escribir los Apellidos del Paciente') : r += 1,
            '' == $('#numero').val() ? alert('Debes escribir el Número de celular/teléfono del Paciente') : r += 1,
            '' == $('#carrera').val() ? alert('Debes seleccionar la Carrera que estudia el Paciente') : r += 1,
            '' == $('#carne').val() ? alert('Debes escribir el Número de carnet del Paciente') : r += 1,
            '' == $('.with-gap').val() ? alert('Debes seleccionar el Género del Paciente') : r += 1,
            '' == $('#email').val() ? alert('Debes escribir el Correo electrónico del Paciente') : r += 1,
            '' == $('#direccion').val() ? alert('Debes escribir la Dirección de domicilio del Paciente') : r += 1,
            10 == r ? $('#registrarp').removeAttr('disabled') : $('#registrarp').attr('disabled', 'disabled'),
            $('#registrarp').on('click', function() {
                $(':checkbox').is(':checked') ? r += 1 : alert('Debes marcar al menos una opción'),
                    11 == r ? $('#formulario').submit() : r = 0
            })
    }),
    $('.siguiente').click(function() {
        var e = $(this).parent(),
            r = $(this).parent().next();
        $('.progress li').eq($('fieldset').index(r)).addClass('active'),
            e.hide(),
            r.show()
    }),
    $('.atras').click(function() {
        var e = $(this).parent(),
            r = $(this).parent().prev();
        $('.progress li').eq($('fieldset').index(e)).removeClass('active'),
            e.hide(),
            r.show()
    }),
    $('#del_usr').click(function() {
        if ($('#search').val() && $('#date').val() && '' != $('#usuario').val()) {
            var e = $('#usuario').val();
            alertify.confirm('¿Segur@ de que quiere ELIMINAR al usuario ' + e + '?', function() {
                alertify.success('Procesando solicitud'),
                    setTimeout(function() {
                        $('.del_usr').submit()
                    }, 3333)
            }, function() {
                alertify.error('Solicitud cancelada')
            })
        }
    }),
    $('#del_pac').click(function() {
        if ($('#cedula').val() && $('#result').val() && '' != $('#date').val()) {
            var e = $('#result').val();
            alertify.confirm('¿Segur@ de que quiere ELIMINAR el perfil de ' + e + '?', function() {
                alertify.success('Procesando solicitud'),
                    setTimeout(function() {
                        $('.del_pac').submit()
                    }, 3333)
            }, function() {
                alertify.error('Solicitud cancelada')
            })
        }
    }),
    $(document).ready(function() {
        $('.tooltipped').tooltip()
    });