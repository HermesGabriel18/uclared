// BUSCA INFORMACIÓN DE LOS CLIENTES REGISTRADOS AL MOMENTO DE
// TIPERARLOS EN UN CAMPO DE TEXTO
// (YA NO ESTA IMPLEMENTADO)
$(".find-cli").keyup(function(){
    if($('#lblcli').text()=='Cedula:' && $("#fcli").val().length==8){
        var cedula = $("#fcli").val();
        //buscarPersonaN(cedula);
        buscarNatural(cedula);
    }else if($('#lblcli').text()=='RIF:' && $("#fcli").val().length==8){
        var rif = $("#fcli").val();
        buscarJuridico(rif);
    }else{
        $("#found-namecn").val("");
        $("#found-lastcn").val("");
        $("#found-mailcn").val("");
    }
});

// VALIDA SI EL CLIENTE INCLUIDO A UN PROYECTO ES VÁLIDO
// (YA NO ESTÁ IMPLEMENTADO)
$("#btn-add-cli").on('click', function(event) {
    event.preventDefault();
    if($("#found-namecn").val()!=""){
        $("#fcli").attr('disabled', true);
        $("#btn-add-cli").attr('disabled', true);
        $("#btn-can-cli").attr('disabled', false);
        $("input[type=radio][name=tipocliente]").attr('disabled', true);
        $("#msg-cli").removeClass().addClass("alert alert-dismissable alert-success")
            .html("<i id='msg-ico' class='icon fa fa-check'></i> Cliente válido").fadeIn(800);
    }else{
        $("#msg-cli").removeClass().addClass("alert alert-dismissable alert-danger")
             .html("<i id='msg-ico' class='icon fa fa-ban'></i> Cliente inválido.").fadeIn(800);
        $("#btn-can-cli").attr('disabled', false);
    }
    setTimeout("$('#msg-cli').hide('slow')",2000);
});

// CANCELA EL CLIENTE INCLUIDO A LOS PROYECTOS
// (YA NO ESTA IMPLEMENTADO)
$("#btn-can-cli").on('click', function(event) {
    event.preventDefault();
    $("#fcli").attr('disabled', false);
    $("#found-namecn").val("");
    $("#found-lastcn").val("");
    $("#found-mailcn").val("");
    $("#fcli").val("");
    $("#btn-can-cli").attr('disabled', true);
    $("#btn-add-cli").attr('disabled', false);
    $("input[type=radio][name=tipocliente]").attr('disabled', false);
});


// FUNCIÓN PARA EL BOTÓN DE CANCELAR EN EL FORMULARIO DE CLIENTES NATURALES
$("#btn-can-natural").on("click",cancelarNatural);

// FUNCION PARA EL BOTÓN DE CANCELAR EN EL FORMULARIO DE CLIENTES JURÍDICOS
$("#btn-can-juridico").on("click",cancelarJuridico);

// REGISTRO DE CLIENTES NATURALES AL SISTEMA
$("#form-natural").submit(function(event) {
	var funcion='add';
	var persona=$("#ced").val();
	var rif=$("#rif").val();
	var nac=$("#nac").val();
	var nombre=($("#nom").val()).toUpperCase();
	var apellido=($("#ape").val()).toUpperCase();
	var sexo=$("#sexo").val();
	var civil=$("#civil").val();
	var direccion=$("#dir").val();
	var telefono=$("#tel").val();
	var celular=$("#cel").val();
	var correo=$("#correo").val();
	console.log(funcion);

// MENSAJE DE VERIFICACIÓN
    swal({
          title: '¿Esta seguro que desea guardar este cliente?',
          text: "Luego no podrá cambiar su cédula!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo guardarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

              // ENVÍO DE DATOS AL CONTROLADOR DE CLIENTES NATURALES
            	$.post('sistema/controladores/clienteNatural.php', 
            		{funcion: funcion, 
            			persona: persona, rif: rif, nac: nac, nombre: nombre, apellido: apellido, sexo: sexo, 
            			civil: civil, direccion: direccion, telefono: telefono, celular: celular, correo:correo},function(result) {

                  // VALIDA EL ENVÍO DE DATOS
        		      if(result.exito=='true'){
        			     console.log('agrego '+result.mensaje);
                    // MENSAJE DE ÉXITO PARA EL REGISTRO DE CLIENTES     
                    swal({
                      type: 'success',
                      title: 'Bien!',
                      text: result.mensaje
                    })
                    linkURL('sistema/vistas/clienteConsulta.php');
        		      }else{
        			     console.log('No agrego '+result.mensaje);
                    // MENSAJE DE FACRASO PARA EL REGISTRO DE CLIENTES     
                     swal({
                          type: 'error',
                          title: 'Oops...',
                          text: result.mensaje
                        })
        		      }
        	     },"json");
        }
    })
	// CANCELA EN ENVÍO POR DEFECTO DEL .SUBMIT
	return false;
});

// REGITRO DE CLIENTES JURÍDICOS AL SISTEMA
$("#form-juridico").submit(function(event) {
	var funcion='add';
	var rif=$("#rifJ").val();
	var nombre=($("#nomJ").val()).toUpperCase();
	var nac=$("#nacJ").val();
	var ubi=$("#ubi").val();
	var tel=$("#telJ").val();
	var correo=$("#correoJ").val();
	var nacP=$("#nacP").val();
	var persona=$("#cedP").val();
	var nombreP=($("#nomP").val()).toUpperCase();
	var apellidoP=($("#apeP").val()).toUpperCase();
	var sexoP=$("#sexoP").val();
	var civilP=$("#civilP").val();
	var celP=$("#celP").val();
	var correoP=$("#correoP").val();
	console.log(funcion);

    // MENSAJE DE VERIFICACIÓN
    swal({
          title: '¿Esta seguro que desea guardar este cliente?',
          text: "Luego no podrá cambiar su RIF!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo guardarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

            // ENVÍO DE DATOS AL CONTROLADOR DE CLIENTES JURÍDICOS
          	$.post('sistema/controladores/clienteJuridico.php', 
          		{funcion: funcion, rif: rif, nombre: nombre, nac: nac, ubi: ubi, tel:tel, correo: correo,
          			nacP: nacP, persona: persona, nombreP: nombreP, apellidoP:apellidoP, sexoP: sexoP,
          			civilP: civilP, celP: celP, correoP: correoP},function(result) {

              // VALIDA EL ENVÍO DE DATOS    
          		if(result.exito=='true'){
          			console.log('agrego '+result.mensaje);
                      // MENSAJE DE ÉXITO PARA EL REGISTRO DEL CLIENTE
                      swal({
                        type: 'success',
                        title: 'Bien!',
                        text: result.mensaje
                      })
                      linkURL('sistema/vistas/clienteConsulta.php');

          		}else{
          			console.log('No agrego '+result.mensaje);
                    // MENSAJE DE FRACASO PARA EL REGISTRO DEL CLIENTE
                       swal({
                            type: 'error',
                            title: 'Oops...',
                            text: result.mensaje
                          })
          		}
          	},"json");
        }
    })
	// CANCELAR EL ENVÍO POR DEFECTO DEL .SUBMIT
	return false;
});

// CARGA EL LISTADO DE CLIENTES NATURALES REGISTRADOS EN EL SISTEMA
$("#tabla-natural").html(function(){
	var funcion='load';
	var celda="";
	console.log(funcion);

  // ELIMINA LA CELDA EN BLANCO QUE ESTÁ POR DEFECTO
	$("#tabla-natural > tbody:last").children().remove();

  // ENVÍA LA SOLICITUD DE DATOS AL CONTROLADOR DE CLIENTES NATURALES
	$.post('sistema/controladores/clienteNatural.php', {funcion: funcion}, function(result) {

    // VALIDA SI SE RECIBIÓ UN ARREGLO DEL CONTROLADOR
		if(!jQuery.isEmptyObject(result) && $.isArray(result)){
      // RECORRE EL ARRAY OBTENIDO
            $.each(result, function(index,valor){

              // CARGA LA CELDA CON LA INFORMACIÓN DE LOS CLIENTES
                celda="<tr>";
                celda+="<td>"+valor.persona+"</td>";
                celda+="<td>"+valor.nompersona+" "+valor.apepersona+"</td>";
                celda+="<td>"+valor.celular+"</td>";
                celda+="<td>"+valor.correo+"</td>";
                if(valor.estatus == "Inactivo"){
                    celda+="<td><span class='label label-warning'>"+valor.estatus+"</span></td>";
                }else if(valor.estatus == "Activo"){
                    celda+="<td><span class='label label-info'>"+valor.estatus+"</span></td>";
                }

                // VALIDA EL ROL DEL USUARIO CONECTADO
                if($("#perfil-acceso").val()<=2){
                    celda+="<td><div id="+valor.persona+">";
                    celda+="<a href='#'class='edit-natural' title='Modificar Cliente (N)'><i class='fa fa-edit'></i> </a>";
                    celda+="<a href='#'class='del-natural'  title='Eliminar Cliente (N)'><i class='fa fa-trash'></i> </a>";
                    celda+="</div></td>";
                    celda+="</tr>";
                }else{
                	celda+="<td></td>";
                    celda+="</tr>";
                }

                // AGREGA LA CELDA A LA TABLA
                $("#tabla-natural >tbody").append(celda);
            });
        }

        // FUNCIÓN PARA EL BOTÓN DE EDITAR CLIENTE NATURAL
        $(".edit-natural").on("click",editNatural);

        // FUNCIÓN PARA EL BOTÓN DE ELIMINAR CLIENTE NATURAL
        $(".del-natural").on("click",deleteNatural);

        // PROPIEDADES DEL PLUGIN DATATABLE
       $('#tabla-natural').dataTable({
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

// CARGA LA TABLA DE CLIENTES JURÍDICOS DEL SISTEMA
$("#tabla-juridico").html(function(){
	var funcion='load';
	var celda="";
	console.log(funcion);
  // REMUEVE LA CELDA POR DEFECTO DE LA TABLA
	$("#tabla-juridico > tbody:last").children().remove();

  // ENVÍA LA SOLICITUD DE DATOS AL CONTROLADOR DE CLIENTES JURÍDICOS
	$.post('sistema/controladores/clienteJuridico.php', {funcion: funcion}, function(result) {

    // VALIDA SI SE RECIBIÓ UN ARRAY CON LOS CLIENTES JURÍDICOS
		if(!jQuery.isEmptyObject(result) && $.isArray(result)){
      // RECORRE EL ARREGLO RECIBIDO
            $.each(result, function(index,valor){
              // CARGA LA CELDA CON LOS DATOS DE LOS CLIENTES

                celda="<tr>";
                celda+="<td>"+valor.rif+"</td>";
                celda+="<td>"+valor.jnombre+"</td>";
                celda+="<td>"+valor.jtelefono+"</td>";
                celda+="<td>"+valor.nompersona+" "+valor.apepersona+"</td>";
                if(valor.estatus == "Inactivo"){
                    celda+="<td><span class='label label-warning'>"+valor.estatus+"</span></td>";
                }else if(valor.estatus == "Activo"){
                    celda+="<td><span class='label label-info'>"+valor.estatus+"</span></td>";
                }

                // VALIDA EL NIVEL DE ACCESO DEL USUARIO CONECTADO
                if($("#perfil-acceso").val()<=2){
                    celda+="<td><div id="+valor.persona+" class="+valor.rif+">";
                    celda+="<a href='#'class='edit-juridico' title='Modificar Cliente'><i class='fa fa-edit'></i> </a>";
                    celda+="<a href='#'class='del-juridico'  title='Eliminar Cliente'><i class='fa fa-trash'></i> </a>";
                    celda+="</div></td>";
                    celda+="</tr>";
                }else{
                	celda+="<td></td>";
                    celda+="</tr>";
                }

                // AGREGA LA CELDA A LA TABLA DE CLIENTES JURÍDICOS
                $("#tabla-juridico >tbody").append(celda);
            });
        }

        // FUNCIÓN PARA EL BOTÓN DE MODIFICAR EL CLIENTE
        $(".edit-juridico").on("click",editJuridico);

        // FUNCIÓN PARA EL BOTÓN DE ELIMINAR EL CLIENTE
        $(".del-juridico").on("click",deleteJuridico);

        // PROPIEDADES DEL PLUGIN DATATABLE
       $('#tabla-juridico').dataTable({
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

// BUSCA EL CLIENTE NATURAL SOLICITADO PASANDO POR PARÁMETRO SU CÉDULA
function buscarNatural(cedula){
    var funcion="find";
    console.log(cedula+" buscando cliente...");

    // VALIDA LA LONGITUD DE LA CÉDULA
    if(cedula!="" && cedula.length>=6){

      // ENVÍA LA CEDULA AL CONTROLADOR DE CLIENTES NATURALES
        $.post('sistema/controladores/clienteNatural.php',{cedula:cedula,funcion:funcion},function(result){
        	console.log(result.exito);

          // VALIDA SI EL ENVÍO FUE EXITOSO
            if(result.exito == 'true'){
                $("#rif").val(result.rif);

                // BUSCA LOS DATOS PERSONALES DEL CLIENTE ENCONTRADO
                buscarPersonaN(result.persona);
                
            }else{
                $("#rif").val(cedula);
            }

            // DESABILITAR EL BOTÓN DE AGREGAR CLIENTE NATURAL
            $("#btn-add-natural").attr("disabled",false); 
        },"json");
    }
}

// MODIFICAR LOS DATOS DE UN CLIENTE NATURAL
function editNatural(){

  // GUARDA EN UNA VARIABLE LA CÉDULA REQUERIDA
    var cedula=$(this).parents("div").attr("id");
    // BLOQUEA EL CAMPO DE LA CÉDULA
    $("#ced").attr('disabled', true);
    // LO LLENA CON LA CÉDULA DEL CLIENTE
    $("#ced").val(cedula);
    // ESCONDE LA LISTA DE CLIENTES
    $("#content-lista-natural").hide();
    // MUESTRA EL FORMULARIO PARA MODIFICAR EL CLIENTE
    $("#content-form-natural-mod").show('fast');
    // BUSCA LOS DATOS PERSONALES   
    buscarPersona(cedula);
    // DESABILITA EL BOTÓN DE AGREGAR CLIENTE
    $("#btn-add-natural").attr("disabled", false);
    // BUSCA EL CLIENTE EN OTRA FUNCIÓN
    buscarNatural(cedula);
    // CAMBIA EL TEXTO DONDE INFORMA LA SECCIÓN DONDE UNO SE ENCUENTRA
    $("#migadepan").text("Modificar");

    // ESCONDE AVISOS DEL LISTADO DE CLIENTES
    $("#ask-tipocli").hide();
    $("#info-client").hide();
    // MUESTRA UN TEXTO ENCIMA DEL FORMULARIO
    $("#tittle-mod").show();
    // HABILITA Y DESABILITA LOS BOTONES CORRESPONDIENTES
    $(".btn-new-cliente").attr('disabled', true);
    $(".btn-vol-cliente").attr('disabled', false);
}


// MODIFICAR CLIENTE NATURAL
$("#form-natural-mod").submit(function(event) {
	var funcion='edit';
	var persona=$("#ced").val();
	var rif=$("#rif").val();
	var nac=$("#nac").val();
	var nombre=($("#nom").val()).toUpperCase();
	var apellido=($("#ape").val()).toUpperCase();
	var sexo=$("#sexo").val();
	var civil=$("#civil").val();
	var direccion=$("#dir").val();
	var telefono=$("#tel").val();
	var celular=$("#cel").val();
	var correo=$("#correo").val();
	console.log(funcion);

// MENSAJE DE VERIFICACIÓN
     swal({
          title: '¿Esta seguro que desea modificar este cliente?',
          // text: "Luego podrá cambiar su contraseña!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo modificarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

              // ENVÍA DATOS AL CONTROLADOR DE CLIENTES NATURALES
            	$.post('sistema/controladores/clienteNatural.php', 
            		{funcion: funcion, 
            			persona: persona, rif: rif, nac: nac, nombre: nombre, apellido: apellido, sexo: sexo, 
            			civil: civil, direccion: direccion, telefono: telefono, celular: celular, correo:correo},function(result) {
            		
                // VALIDA SI EL ENVÍO HA SIDO EXITOSO
                if(result.exito=='true'){
            			console.log('modifico '+result.mensaje);
                    // MENSAJE DE ÉXITO PARA EL ENVÍO
                    swal({
                          type: 'success',
                          title: 'Bien!',
                          text: result.mensaje
                    })

            		}else{
            			console.log('No modifico '+result.mensaje);
                  // MENSAJE DE ERROR PARA EL ENVÍO
                   swal({
                      type: 'error',
                      title: 'Oops...',
                      text: result.mensaje
                    })
            		}
            	},"json");
        }
    })
	// CANCELA EL ENVÍO POR DEFECTO DEL .SUBMIT
	return false;
});

// ELIMINAR CLIENTE NATURAL
function deleteNatural(){
    var cedula=$(this).parents("div").attr("id");
    var funcion="delete";
    var parent = $(this).parents("tr");
    console.log(funcion);

// MENSAJE DE VERIFICACIÓN
        swal({
          title: '¿Esta seguro que desea eliminar este cliente?',
          text: "Será eliminado permanentemente!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo eliminarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

// ENVÍA LA SOLICITUD AL CONTROLADOR DE CLIENTES NATURALES
        $.post('sistema/controladores/clienteNatural.php',
            {funcion:funcion, 
            cedula:cedula},function(result){

              // VALIDA SI HA SIDO EXITOSO EL ENVÍO
            if(result.exito == 'true'){

              // LLAMA EL MÉTODO QUE ELIMINA LOS DATOS PERSONALES
                eliminarPersona(cedula);
                swal({
                      type: 'success',
                      title: 'Bien!',
                      text: result.mensaje
                    })
                $(parent).remove();
            }else{
              // MENSAJE DE ERROR
                swal({
                      type: 'error',
                      title: 'Oops...',
                      text: result.mensaje
                    })
            }
            
        },"json");
    }
})
    
    return false;
}

// BUSCA INFORMACIÓN DE CLIENTE JURÍDICO
function buscarJuridico(rif){
    var funcion="find";
    console.log(rif+" buscando cliente...");
    // VALIDA QUE NO ESTÉ VACÍO EL CAMPO
    if(rif!=""){
      // ENVÍA DATOS AL CONTROLADOR DE CLIENTES JURÍDICOS
        $.post('sistema/controladores/clienteJuridico.php',{rif:rif,funcion:funcion},function(result){
        	console.log(result.exito);

          // VALIDA QUE HA SIDO EXITOSO EL ENVÍO DE DATOS
            if(result.exito == 'true'){

              // CARGA LOS CAMPOS CON LOS DATOS DEL CLIENTE
                $("#nacJ").val(result.nacionalidad);
                $("#nomJ").val(result.nombre);
                $("#ubi").val(result.ubicacion);
                $("#telJ").val(result.telefono);
                $("#correoJ").val(result.correo);

                $("#found-namecn").val(result.nombre);
                $("#found-mailcn").val(result.correo);

                $("#fcli2").val(result.rif);
                $(".cli"+result.rif+"").text(result.nombre);

                $("#fclip").val(result.nombre);

                $("#clic").val(result.nombre);

            }else{
                $("#rif").val(rif);
            }
            $("#btn-add-juridico").attr("disabled",false); 
        },"json");
    }
}

// EDITAR CLIENTE JURÍDICO
function editJuridico(){
  // GUARDA EL RIF EN UNA VARIABLE
	var rif=$(this).parents("div").attr("class");
  // DESABILITA EL CAMPO DEL RIF
    $("#rifJ").attr('disabled', true);
    // CARGA EL CAMPO DEL RIF
    $("#rifJ").val(rif);
    // GUARDA LA CÉDULA EN UNA VARIABLE
    var cedula=$(this).parents("div").attr("id");
    // DESABILITA EL CAMPO DE LA CÉDULA
    $("#cedP").attr('disabled', true);
    // CARGA EL CAMPO CON LA CÉDULA
    $("#cedP").val(cedula);
    // ESCONDE EL LISTADO
    $("#content-lista-juridico").hide();
    // MUESTRA EL FORMULARIO
    $("#content-form-juridico-mod").show('fast');
    // BUSCA DATOS DE LA PERSONA DE CONTACTO   
    buscarPersonaJ(cedula);
    // DESABILITA EL BOTÓN DE AGREGAR
    $("#btn-add-natural").attr("disabled", false);
    // MANDA A BUSCAR EL CLIENTE A MODIFICAR
    buscarJuridico(rif);
    // CAMBIA EL TEXTO DE CONSULTAR A MODIFICAR
    $("#migadepan").text("Modificar");
    // ESCONDE CONTENIDOS DEL LISTADO
    $("#ask-tipocli").hide();
    $("#info-client").hide();
    // MUESTRA TÍTULO DEL FORMULARIO
    $("#tittle-mod").show();
    // HABILITA Y DESABILITA LOS BOTONES CORRESPONDIENTES
    $(".btn-new-cliente").attr('disabled', true);
    $(".btn-vol-cliente").attr('disabled', false);
}

// MODIFICAR DATOS DE CLIENTES JURÍDICOS
$("#form-juridico-mod").submit(function(event) {
    var funcion='edit';
    var rif=$("#rifJ").val();
    var nombre=($("#nomJ").val()).toUpperCase();
    var nac=$("#nacJ").val();
    var ubi=$("#ubi").val();
    var tel=$("#telJ").val();
    var correo=$("#correoJ").val();
    var nacP=$("#nacP").val();
    var persona=$("#cedP").val();
    var nombreP=($("#nomP").val()).toUpperCase();
    var apellidoP=($("#apeP").val()).toUpperCase();
    var sexoP=$("#sexoP").val();
    var civilP=$("#civilP").val();
    var celP=$("#celP").val();
    var correoP=$("#correoP").val();
    console.log(funcion);

    // MENSAJE DE VERIFICACIÓN
    swal({
          title: '¿Esta seguro que desea modificar este cliente?',
          // text: "Luego podrá cambiar su contraseña!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo modificarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {


              // ENVÍADATOS DEL FORMULARIO
              $.post('sistema/controladores/clienteJuridico.php', 
                  {funcion: funcion, rif: rif, nombre: nombre, nac: nac, ubi: ubi, tel:tel, correo: correo,
                      nacP: nacP, persona: persona, nombreP: nombreP, apellidoP:apellidoP, sexoP: sexoP,
                      civilP: civilP, celP: celP, correoP: correoP},function(result) {
                        // VALIDA ENVÍO
                  if(result.exito=='true'){
                      console.log('modifico '+result.mensaje);
                      // MENSAJE EXITOSO
                      swal({
                          type: 'success',
                          title: 'Bien!',
                          text: result.mensaje
                        })

                  }else{
                      console.log('No modifico '+result.mensaje);
                      // MENSAJE DE FRACASO
                       swal({
                          type: 'error',
                          title: 'Oops...',
                          text: result.mensaje
                        })
                  }
              },"json");
          }
      })
    // CANCELA ENVÍO POR DEFECTO
    return false;
});

// BORRAR CLIENTE JURÍDICO
function deleteJuridico(){
    var rif=$(this).parents("div").attr("class");
    var funcion="delete";
    var parent = $(this).parents("tr");
    console.log(funcion);

// MENSAJE DE VERIFICACIÓN
        swal({
          title: '¿Esta seguro que desea eliminar este cliente?',
          text: "Será eliminado permanentemente!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo eliminarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

              // ENVÍA EL RIF AL CONTROLADOR
              $.post('sistema/controladores/clienteJuridico.php',
                  {funcion:funcion, 
                  rif:rif},function(result){

                    // VALIDA EL ENVÍO
                  if(result.exito == 'true'){
                    // ELIMINA LOS DATOS PERSONALES DE LA PERSONA DE CONTACTO
                      eliminarPersona(cedula);
                      // MENSAJE EXITOSO
                      swal({
                            type: 'success',
                            title: 'Bien!',
                            text: result.mensaje
                          })
                      $(parent).remove();

                  }else{
                    // MENSAJE DE FRACASO
                      swal({
                            type: 'error',
                            title: 'Oops...',
                            text: result.mensaje
                          })
                  }
              },"json");
          }
      })
    
    return false;
}

// LIMPIA EL FORMULARIO DE CLIENTES NATURALES
function cancelarNatural(){
    $("#form-natural")[0].reset();
    $("#btn-add-natural").attr('disabled', false);
}

// LIMPIA EL FORMULARIO DE CLIENTES JURÍDICOS
function cancelarJuridico(){
    $("#form-juridico")[0].reset();
    $("#btn-add-juridico").attr('disabled', false);
}

// FUNCIONES DEL RADIO BUTTON PARA EL TIPO DE CLIENTE
// (EN EL FORMULARIO DE REGISTRO)
$('input[type=radio][name=registro]').change(function() {
        if (this.value == '1') {//CLIENTE NATURAL
          // ESCONDE FORMULARIO DE JURÍDICOS
        	$("#form-juridico").hide();
          // MUESTRA EL FORMULARIO DE NATURALES
            $("#form-natural").show('fast');
        }
        else if (this.value == '2') {//CLIENTE JURÍDICO
          // ESCONDE EL FORMULARIO DE NATURALES
            $("#form-natural").hide();
          // MUESTRA EL FORMULARIO DE JURÍDICOS
            $("#form-juridico").show('fast');
        }
    });

// FUNCIONES DEL RADIO BUTTON PARA EL TIPO DE CLIENTE
// (EN EL LISTADO DE CLIENTES)
$('input[type=radio][name=consulta]').change(function() {
        if (this.value == '1') {//CLIENTE NATURAL
          // ESCONDE LA SECCIÓN PARA JURÍDICOS
        	$("#seccion-juridico").hide();
          // MUESTRA LA SECCIÓN PARA NATURALES
            $("#seccion-natural").show('fast');
        }
        else if (this.value == '2') {//CLIENTE JURÍDICO
          // ESCONDE LA SECCIÓN DE NATURALES
            $("#seccion-natural").hide();
            // MUESTRA LA SECCIÓN DE JURÍDICOS
            $("#seccion-juridico").show('fast');
        }
});

// FUNCIONES DEL RADIO BUTTON PARA EL TIPO DE CLIENTE
// (EN EL REGISTRO DE PROYECTO)
$('input[type=radio][name=tipocliente]').change(function() {
        if (this.value == '1') {//CLIENTE NATURAL
          // CAMBIA TEXTO EN LABELS Y MUESTRA LOS CAMPOS
          // QUE CORRESPONDEN
          // (ALGUNOS YA NO ESTÁN IMPLEMENTADOS)
            $("#lblcli").text("Cedula:");
            $("#fcli").attr('placeholder', "Introduzca una cedula");
            $("#found-namecn").attr('placeholder', "Nombre");
            $("#found-lastcn").show('fast');

            $("#fcli").val("");
            $("#found-namecn").val("");
            $("#found-lastcn").val("");
            $("#found-mailcn").val("");

            $("#lblclip").text("Nombre y apellido:");

            // CARGA DATOS DEL CLIENTE EN EL COMBO BOX
            var funcion="load";
            var idclin=0;
            var nombre=0;
            $("#clip").empty();
            $("#clip").append("<option value=''>Seleccione...</option>");

            // ENVÍO DE SOLICITUD AL CONTROLADOR
            $.post("sistema/controladores/clienteNatural.php",{funcion:funcion},function(data){
                console.log(data);

                // RECIBE ARRAY
                if(!jQuery.isEmptyObject(data) && $.isArray(data)){
                  // RECORRE EL ARRAY
                    $.each(data, function(index, valor){
                        
                            idclin=valor.persona;
                            nombre=valor.nompersona+" "+valor.apepersona; 
                            
                            // SI EL ESTATUS NO ES INACTIVO CARGA LOS DATOS EN EL
                            // COMBOBOX
                            if(valor.estatus!="Inactivo")
                                $("#clip").append("<option value='"+valor.persona+"'>"+nombre+"</option>");
            
                    });       
                }
            },"json");

        }
        else if (this.value == '2') {//CLIENTE JURÍDICO
          // CAMBIA TEXTO EN LABELS Y MUESTRA LOS CAMPOS
          // QUE CORRESPONDEN
          // (ALGUNOS YA NO ESTÁN IMPLEMENTADOS)
           $("#lblcli").text("RIF:");
           $("#fcli").attr('placeholder', "Introduzca un RIF");
           $("#found-namecn").attr('placeholder', "Institucion");
           $("#found-lastcn").hide();

           $("#fcli").val("");
            $("#found-namecn").val("");
            $("#found-lastcn").val("");
            $("#found-mailcn").val("");

            $("#lblclip").text("Institución:");

            // CARGA DATOS DEL CLIENTE EN EL COMBO BOX
            var funcion="load";
            var idclin=0;
            var nombre=0;
            $("#clip").empty();
            $("#clip").append("<option value=''>Seleccione...</option>");

            // ENVÍO DE SOLICITUD AL CONTROLADOR
            $.post("sistema/controladores/clienteJuridico.php",{funcion:funcion},function(data){
                console.log(data);

                // RECIBE ARRAY
                if(!jQuery.isEmptyObject(data) && $.isArray(data)){
                  // RECORRE EL ARRAY
                    $.each(data, function(index, valor){
                        
                            idclin=valor.rif;
                            nombre=valor.jnombre; 
                            
                            // SI EL ESTATUS NO ES INACTIVO CARGA LOS DATOS EN EL
                            // COMBOBOX
                            if(valor.estatus!="Inactivo")
                                $("#clip").append("<option value='"+valor.rif+"'>"+nombre+"</option>");
            
                    });       
                }
            },"json");

          
        }
});

// CARGA DE COMBOBOX DE CLIENTES EN EL REGISTRO DE PROYECTO
$("#clip").html(function(){
    var funcion="load";
    var idclin=0;
    var nombre=0;
    $("#clip").empty();
    $("#clip").append("<option value=''>Seleccione...</option>");

    $.post("sistema/controladores/clienteNatural.php",{funcion:funcion},function(data){
        console.log(data);
        if(!jQuery.isEmptyObject(data) && $.isArray(data)){
            $.each(data, function(index, valor){
                
                    idclin=valor.persona;
                    nombre=valor.nompersona+" "+valor.apepersona; 
               
                    if(valor.estatus!="Inactivo")
                        $("#clip").append("<option value='"+valor.persona+"'>"+nombre+"</option>");
            
            });       
        }
    },"json");

});