// ACCIONES PARA EL BOTÓN DE VOLVER
$("#btn-vol-mensaje").on("click",function(){
    // MUESTRA EL LISTADO
    $("#content-lista-mensaje").show('fast');
    // ESCONDE EL FORMULARIO
    $("#content-form-mensaje").hide();
    // ESCONDE EL BOTÓN DE VOLVER
    $("#btn-vol-mensaje").attr("disabled",true);
    // CAMBIA TEXTO A CONSULTA
    $("#migadepan").text("Consulta");
});

// LIMPIA EL FORMULARIO DE MENSAJE EN LA PÁGINA DE INICIO
function limpiarMensaje(){
    $("#fContacto")[0].reset();
}

// ENVÍA EL MENSAJE AL SISTEMA
$("#fContacto").submit(function(event) {
	var funcion='add';
	var origen=$("#client").val();
	var asunto=$("#asunto").val();
	var contenido=$("#mensaje").val();
	console.log(funcion);

    // ENVÍO DE DATOS AL CONTROLADOR
	$.post('app/sistema/controladores/mensaje.php', 
		{funcion: funcion,
		origen: origen,
		asunto: asunto,
		contenido: contenido}, function(resultado) {
        // VALIDA EL ENVÍO DE DATOS
		if(resultado.exito=='true'){
			console.log('envio '+resultado.mensaje);
            // MENSAJE ANIMADO DE ÉXITO POR MEDIO DE PLUGIN ALERTIFY
			alertify.success(resultado.mensaje);
            // LIMPIA EL FORMULARIO
            limpiarMensaje();
		}else{
			console.log('No envio '+resultado.mensaje);
            // MENSAJE ANIMADO DE FRACASO OR MEDIO DE PLUGIN ALERTIFY
			 alertify.error(resultado.mensaje);
		}
	},"json");
    // CANCELA ENVÍO POR DEFECTO DEL .SUBMIT
	return false;
});

// CARGA EL LISTADO DE MENSAJES
$("#tabla-mensaje").html(function(){
	var funcion='load';
	var celda="";
	console.log(funcion);
    // LIMPIA LA CELDA QUE VIENE POR DEFECTO
	$("#tabla-mensaje > tbody:last").children().remove();

    // ENVÍA DATOS AL CONTROLADOR
	$.post('sistema/controladores/mensaje.php', {funcion: funcion}, function(result) {
        // RECIBE UN ARRAY
		if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            // RECORRE EL ARRAY
            $.each(result, function(index,valor){

                // TRANSFORMA EL FORMATO DE LA FECHA
                var dateAr = valor.fecha.split('-');
                var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];

                // CARGA LA CELDA
                celda="<tr>";
                celda+="<td>"+valor.origen+"</td>";
                celda+="<td>"+valor.asunto+"</td>";
                celda+="<td>"+newDate+"</td>";
                if($("#perfil-acceso").val()<=2){
                    celda+="<td><div id="+valor.codigo+">";
                    celda+="<a href='#'class='show-mensaje' data-toggle='tooltip' title='Mostrar mensaje'><i class='fa fa-search'></i> </a>";
                    celda+="</div></td>";
                    celda+="</tr>";
                }else{
                    celda+="<td></td>";
                }
                $("#tabla-mensaje >tbody").append(celda);
            });
        }
        // FUNCIÓN PARA EL BOTÓN DE 'VER MENSAJE'
        $(".show-mensaje").on("click",showMensaje);
        // PROPIEDADES DEL PLUGIN DATATABLE
        $('#tabla-mensaje').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bSort": false,
            "bInfo": false,
            "bAutoWidth": true,
            "language":{
                "search": "Buscar:",
                "paginate":{
                    "previous": "Atrás",
                    "next": "Siguiente"
                }
            }
        });
	},"json");
});

// BUSCA MENSAJE...
function buscarMensaje(codigo){
    var funcion="find";
    console.log(codigo+" buscando mensaje...");
    // VALIDA QUE EL MENSAJE NO ESTÉ VACÍO
    if(codigo!=""){

        // ENVÍO DE DATOS AL CONTROLADOR
        $.post('sistema/controladores/mensaje.php',{codigo:codigo,funcion:funcion},function(result){
        	console.log(result.exito);
            if(result.exito == 'true'){
                $("#ori").val(result.origen);
                $("#asu").val(result.asunto);
                $("#cont").val(result.contenido);

                // TRANSFORMA EL FORMATO DE LA FECHA
                var dateAr = result.fecha.split('-');
                var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];

                $("#fec").val(newDate);
                
            }else{
                // MENSAJE DE ERROR
                 $("#msg-box").removeClass().addClass("alert alert-dismissable alert-danger")
			 .html("<i id='msg-ico' class='icon fa fa-ban'></i> "+result.mensaje).fadeIn(800);
            }
        },"json");
    }
}

// MOSTRAR MENSAJE
function showMensaje(){
    // GUARDA EL CÓDIGO (AUTOGENERADO) EN UNA VARIABLE
    var codigo=$(this).parents("div").attr("id");
    // ESCONDE EL LISTADO
    $("#content-lista-mensaje").hide();
    // MUESTRA EL FORMULARIO
    $("#content-form-mensaje").show('fast'); 
    // DESABILITA EL BOTÓN DE VOLVER 
    $(".btn-vol-mensaje").attr("disabled",false);
    // DESABILITA TODOS LOS CAMPOS
    $("#ori").attr('disabled', true);
    $("#asu").attr('disabled', true);
    $("#cont").attr('disabled', true);
    $("#fec").attr('disabled', true); 
    // MANDA A BUSCAR EL MENSAJE 
    buscarMensaje(codigo);
     // CAMBIA TEXTO
    $("#migadepan").text("Consulta");
}

// FORMULARIO DE RECUPERAR CONTRASEÑA
$("#resetpass").submit(function(event) {
    // MENSAJE DE VERIFICACIÓN
    swal({
          title: '¿Esta seguro de sus datos?',
          text: "Serán evaluados por los administradores del sistema...",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, estoy seguro!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

            // ENVÍO DE DATOS AL CONTROLADOR
            $.ajax({
                url: 'app/sistema/controladores/mensaje.php',
                type: 'POST',
                dataType: 'json',
                data: $("#resetpass").serialize(),
            })
            .done(function(result) {
                console.log("success");
                // MENSAJE DE ÉXITO
                swal({
                    type: 'success',
                    title: 'Bien!',
                    text: result.mensaje
                })
                // REDIRECCIONA AL INICIO
                $(location).attr('href','index.html');
            })
            .fail(function() {
                console.log("error");
                // MENSAJE DE ERROR
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: "Algo ha salido mal!"
                })
            })
            .always(function() {
                console.log("complete");
            });

          }
      })
    return false;
});
