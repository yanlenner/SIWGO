function resetear(){location.href="./estadistica"}$(".boton1").click(function(){if("Resultado"==$(this).val()){var e=$(":radio[name=e1]:checked").val(),o=$(":radio[name=e2]:checked").val();$.ajax({type:"POST",url:"e5ta.php",data:{tipo_reporte:"E",e1:e,e2:o}}).done(function(n){$("#e2").attr("hidden","true"),$("#e3").removeAttr("hidden"),"genero"==e&&null==o||"edad"==e&&null==o||null==e&&"antecedentes"==o||null==e&&"carreras"==o||null==e&&"diagnosticos"==o||null==e&&"preescripcion"==o||null==e&&"atendidos"==o||null==e&&"atencion"==o?$("#e3").html("Debe seleccionar dos casillas de la sección Búsqueda para efectuar la consulta <br><input type='button' style='margin-top:2%;' onclick='resetear();' value='Intente de nuevo'>"):"genero"==e&&"antecedentes"==o?window.open("http://odontologia.uptm/SIWGO/sesion/odon/reporte/UvxpZ7GpV9JixvdP7DR4A5SmaRHIYcL6T1rJej8EskiQTMBQZXHW8udcKQkF","nobody","width=1024,height=402,resizable=no,centerscreen=yes,scrollbars=yes,status=1"):"edad"==e&&"antecedentes"==o?window.open("http://odontologia.uptm/SIWGO/sesion/odon/reporte/MeCKdm8xJSxNXpYqyzWi2zTT3boUEPBYAIhsyP51wpcWHQVWn6P95vWSnr0I","nobody","width=1024,height=402,resizable=no,centerscreen=yes,scrollbars=yes,status=1"):"genero"==e&&"carreras"==o?window.open("http://odontologia.uptm/SIWGO/sesion/odon/reporte/AKkJTb0kQUGgeAPdPfseLPI04YT3xoDiSrl1Y0xM45kO9aZvkZRX1L8SILzu","nobody","width=1024,height=402,resizable=no,centerscreen=yes,scrollbars=yes,status=1"):"edad"==e&&"carreras"==o?window.open("http://odontologia.uptm/SIWGO/sesion/odon/reporte/jYlpavoOFXu2hRMp6rAgDJHXGfax95OYMUhztpawLdfBNAHtUgEy95DsGphk","nobody","width=1024,height=402,resizable=no,centerscreen=yes,scrollbars=yes,status=1"):"genero"==e&&"diagnosticos"==o?window.open("http://odontologia.uptm/SIWGO/sesion/odon/reporte/EBtsah3F08cCmbwOK4ukq6COmCI6CJqC779ZIEgguym0A3a5Ha3zFZo3qO3a","nobody","width=1024,height=402,resizable=no,centerscreen=yes,scrollbars=yes,status=1"):"edad"==e&&"diagnosticos"==o?window.open("http://odontologia.uptm/SIWGO/sesion/odon/reporte/fPxjQNTShPeq9CTTZe0AmkGy4owpnRdZkR3u2SEqfnSFTh5kEurPtdRMfj8m","nobody","width=1024,height=402,resizable=no,centerscreen=yes,scrollbars=yes,status=1"):"genero"==e&&"atencion"==o?window.open("http://odontologia.uptm/SIWGO/sesion/odon/reporte/2zYAgKZCusQxml61OIwNaVWMkiybnt0hPG85SvF3HpcLEB4rJ7UDXoqdRT9e","nobody","width=1024,height=402,resizable=no,centerscreen=yes,scrollbars=yes,status=1"):"edad"==e&&"atencion"==o?window.open("http://odontologia.uptm/SIWGO/sesion/odon/reporte/KwTJo7IEzOxfVQgF0pHBreaGb4ukvSjq12hYWR5c3DCmdNAnlXi68L9sUMtP","nobody","width=1024,height=402,resizable=no,centerscreen=yes,scrollbars=yes,status=1"):$("#e3").html(n),$(".boton1").attr("hidden","true")})}}),$(function(){$(":radio[name=e1]").on("click",function(){$(":radio[name=e2]").is(":checked")?$(".boton1").removeAttr("hidden"):$(".boton1").attr("hidden","true")}),$(":radio[name=e2]").on("click",function(){$(":radio[name=e1]").is(":checked")?$(".boton1").removeAttr("hidden"):$(".boton1").attr("hidden","true")})});