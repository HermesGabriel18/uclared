// FORMULARIO PARA AGREGAR DATOS PERSONALES
$("#form-persona").submit(function(event) {
	var funcion='add';
	console.log(funcion);
	var nac=$("#nac").val();
	var ced=$("#ced").val();
	var nombre=($("#nom").val()).toUpperCase();
	var apellido=($("#ape").val()).toUpperCase();
	var sexo=$("#sexo").val();
	var civil=$("#civil").val();
	var telefono=$("#tel").val();
	var celular=$("#cel").val();
	var correo=$("#correo").val();
	var direccion=$("#dir").val();

	// MENSAJE DE VERIFICACIÓN
	swal({
          title: '¿Esta seguro que desea guardar estos datos?',
          text: "No podrá modificar la cédula!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo guardarlos!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

          	// ENVÍA INFORMACIÓN AL CONTROLADOR
			$.post('sistema/controladores/persona.php', 
				{funcion: funcion,
					nac: nac,
					ced: ced,
					nom: nombre,
					ape: apellido,
					sexo: sexo,
					civil: civil,
					tel: telefono,
					cel: celular,
					correo: correo,
					dir: direccion}, function(result) {
						if(result.exito=='true'){
							console.log('agrego '+result.mensaje);
							// MENSAJE DE ÉXITO
							swal({
				              type: 'success',
				              title: 'Bien!',
				              text: result.mensaje
				            })
				            // MANDA A CARGAR LOS DATOS DEL USUARIO
							cargarUsuario(ced);
						}else{
							console.log('No agrego '+result.mensaje);
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
	setTimeout("$('#msg-box').hide('slow')",5000);
	return false;
});

// FUNCIÓN PARA CANCELAR LA PERSONA
$("#btn-can-persona").on("click",cancelarPersona);

// BUSCA LA PERSONA CON LA CÉDULA
function buscarPersona(cedula){
	var funcion="find";
	console.log(cedula+" buscando persona...");
	// ENVÍA DATOS AL CONTROLADOR
	$.post('sistema/controladores/persona.php', {cedula: cedula,funcion:funcion}, function(result) {
		console.log(result.exito);
		// VALIDA EL ENVÍO DE DATOS
		if(result.exito=='true'){
			// CARGA LOS CAMPOS CON LOS DATOS OBTENIDOS
			$("#nac").val(result.nacionalidad);
			$("#ced").val(result.cedula);
			$("#nom").val(result.nombre);
			$("#ape").val(result.apellido);
			$("#sexo").val(result.sexo);
			$("#civil").val(result.civil);
			$("#dir").val(result.direccion);
			$("#tel").val(result.telefono);
			$("#cel").val(result.celular);
			$("#correo").val(result.correo);

			$("#found-name").val(result.nombre);
			$("#found-last").val(result.apellido);
			$("#fpersona2").val(result.cedula);

			$("#respc").val(result.nombre+" "+result.apellido);

		}
	},"json");
}

// BUSCA LOS DATOS PERSONALES DEL CLIENTE NATURAL
function buscarPersonaN(cedula){
	var funcion="find";
	console.log(cedula+" buscando persona...");
	// ENVÍO DE DATOS AL CONTROLADOR
	$.post('sistema/controladores/persona.php', {cedula: cedula,funcion:funcion}, function(result) {
		console.log(result.exito);
		// VALIDA ENVÍO DA DATOS
		if(result.exito=='true'){
			// CARGA LOS CAMPOS CON LOS DATOS RECIBIDOS
			$("#found-namecn").val(result.nombre);
			$("#found-lastcn").val(result.apellido);
			$("#found-mailcn").val(result.correo);

			$("#fcli2").val(result.cedula);
			$(".cli"+result.cedula+"").text(result.nombre);

			$("#fclip").val(result.nombre+" "+result.apellido);
			$("#clic").val(result.nombre+" "+result.apellido);
		}
	},"json");
}

// FORMULARIO PARA MODIFICAR DATOS PERSONALES
$("#form-persona-mod").submit(function(event) {
	var funcion='edit';
	console.log(funcion);
	var nac=$("#nac").val();
	var ced=$("#ced").val();
	var nombre=($("#nom").val()).toUpperCase();
	var apellido=($("#ape").val()).toUpperCase();
	var sexo=$("#sexo").val();
	var civil=$("#civil").val();
	var telefono=$("#tel").val();
	var celular=$("#cel").val();
	var correo=$("#correo").val();
	var direccion=$("#dir").val();

	// MENSAJE DE VERIFICACIÓN
	swal({
          title: '¿Esta seguro que desea modificar estos datos?',
          //text: "No podrá modificar la cédula!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo modificarlos!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

          		// ENVÍO DE DATOS AL CONTROLADOR
				$.post('sistema/controladores/persona.php', 
					{funcion: funcion,
						nac: nac,
						ced: ced,
						nom: nombre,
						ape: apellido,
						sexo: sexo,
						civil: civil,
						tel: telefono,
						cel: celular,
						correo: correo,
						dir: direccion}, function(result) {
							// VALIDA EL ENVÍO DA DATOS
							if(result.exito=='true'){
								console.log('agrego '+result.mensaje);
								// MENSAJE DE ÉXITO
								swal({
					              type: 'success',
					              title: 'Bien!',
					              text: result.mensaje
					            })
							}else{
								console.log('No agrego '+result.mensaje);
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
});

// LIMPIA EL FORMULARIO DE LOS DATOS PERSONALES
function cancelarPersona(){
    $("#form-persona")[0].reset();
    $("#btn-add-persona").attr('disabled', false);
}

// BUSCA LOS DATOS PERSONALES DE LA PERSONA DE CONTACTO DE CLIENTE JURÍDICO
function buscarPersonaJ(cedula){
	var funcion="find";
	console.log(cedula+" buscando persona...");
	// ENVÍO DE DATOS AL CONTROLADOR
	$.post('sistema/controladores/persona.php', {cedula: cedula,funcion:funcion}, function(result) {
		console.log(result.exito);
		// VALIDA ENVÍO DE DATOS
		if(result.exito=='true'){
			// CARGA LOS CAMPOS CON LOS DATOS OBTENIDOS
			$("#nacP").val(result.nacionalidad);
			$("#nomP").val(result.nombre);
			$("#apeP").val(result.apellido);
			$("#sexoP").val(result.sexo);
			$("#civilP").val(result.civil);
			$("#celP").val(result.celular);
			$("#correoP").val(result.correo);
		}
	},"json");
}

// ELIMINA LOS DATOS PERSONALES
function eliminarPersona(cedula){
	console.log("eliminarPersona");
	// ENVÍO DE DATOS AL CONTROLADOR
	$.ajax({
		url: 'sistema/controladores/persona.php',
		type: 'POST',
		dataType: 'json',
		data: {funcion: 'delete', cedula: cedula},
	})
	.done(function() {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
}