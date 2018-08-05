$("#form-subir").submit(subirImagen);

$(".find-usuario").keyup(function(){
    var cedula = $("#fpersona").val();
    if($("#fpersona").val().length==8){
        buscarUsuario(cedula);
        buscarPersona(cedula);
    }else{
        $("#found-name").val("");
        $("#found-last").val("");
        $("#found-rol").val("");
    }
});

$("#btn-add-res").on('click', function(event) {
    event.preventDefault();
    if($("#found-rol").val()=="Jefe de proyecto"){
        $("#fpersona").attr('disabled', true);
        $("#btn-add-res").attr('disabled', true);
        $("#btn-can-res").attr('disabled', false);
        $("#msg-jefe").removeClass().addClass("alert alert-dismissable alert-success")
            .html("<i id='msg-ico' class='icon fa fa-check'></i> Jefe de proyecto válido").fadeIn(800);
    }else{
        $("#msg-jefe").removeClass().addClass("alert alert-dismissable alert-danger")
             .html("<i id='msg-ico' class='icon fa fa-ban'></i> Debe ser un usuario con la especialidad 'Jefe de proyecto'.").fadeIn(800);
        $("#btn-can-res").attr('disabled', false);
    }
    setTimeout("$('#msg-jefe').hide('slow')",2000);
});

$("#btn-can-res").on('click', function(event) {
    event.preventDefault();
    $("#fpersona").attr('disabled', false);
    $("#found-name").val("");
    $("#found-last").val("");
    $("#found-rol").val("");
    $("#fpersona").val("");
    $("#btn-can-res").attr('disabled', true);
    $("#btn-add-res").attr('disabled', false);
});

$("#content-ver-usuario").show(function(){
    var cedula = $("#persona-acceso").val();
    buscarPersona(cedula);
    $("#btn-add-persona").attr("disabled", false);
    console.log($("#ced").val()+" buscando");
    buscarUsuario(cedula);
});

$("#btn-new-usuario").on("click",function(){
    console.log("Hace click");
});

$("#btn-vol-usuario").on("click",function(){
    console.log("Hace click");
});

$("#btn-can-usuario").on("click",cancelarUsuario);

$("#perfil").html(function(){
    var funcion="list";
    var idperfil=0;
    var nombre=0;
    $("#perfil").empty();
    $("#perfil").append("<option value=''>Seleccione...</option>");
    $.post("sistema/controladores/rol.php",{funcion:funcion},function(data){
        console.log(data);
        if(!jQuery.isEmptyObject(data) && $.isArray(data)){
            $.each(data, function(index, valor){
                //if(valor.idrol==1){
                    idperfil=valor.idrol;
                    nombre=valor.descripcion; 
                //}else{
                    $("#perfil").append("<option value='"+valor.idrol+"'>"+valor.descripcion+"</option>");
                //} 
            });

            // if($("#perfil-acceso").val()==1){
            //     $("#perfil").append("<option value='"+idperfil+"'>"+nombre+"</option>");
            // }
        }
    },"json");
});

$("#especialidad").html(function(){
    var funcion="list";
    var idespecialidad=0;
    var nombre="";
    $("#especialidad").empty();
    $("#especialidad").append("<option value=''>Seleccione...</option>");
    $.post("sistema/controladores/especialidad.php",{funcion:funcion},function(data){
        console.log(data);
        if(!jQuery.isEmptyObject(data) && $.isArray(data)){
            $.each(data, function(index, valor){
                    idespecialidad=valor.idespecialidad;
                    nombre=valor.descripcion; 
                    $("#especialidad").append("<option value='"+valor.idespecialidad+"'>"+valor.descripcion+"</option>");
            });
        }
    },"json");
});



$("#form-usuario").submit(function(event) {
	//var data=$(this).serialize();
	var funcion='add';
	//console.log(data);
	var usuario=$("#usuario").val();
	var clave=$("#clave").val();
	var perfil=$("#perfil").val();
    var especialidad=$("#especialidad").val();
	console.log(usuario);

    if($("#perfil").val()!="" && $("#especialidad").val()!=""){


         swal({
          title: '¿Esta seguro que desea guardar este usuario?',
          text: "Luego podrá cambiar su contraseña!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo guardarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

          

	   $.post('sistema/controladores/usuario.php', 
		  {funcion: funcion, 
			 usuario: usuario, 
			 clave: clave, 
			 perfil: perfil,
                especialidad: especialidad},function(result) {
		  if(result.exito=='true'){
			 console.log('agrego '+result.mensaje);
			 // $("#msg-box").removeClass().addClass("alert alert-dismissable alert-success")
			 // .html("<i id='msg-ico' class='icon fa fa-check'></i> "+result.mensaje).fadeIn(800);
    //             cancelarUsuario();
            swal({
              type: 'success',
              title: 'Bien!',
              text: result.mensaje
            })
            linkURL('sistema/vistas/usuarioConsulta.php');
		  }else{
			 console.log('No agrego '+result.mensaje);
			     // $("#msg-box").removeClass().addClass("alert alert-dismissable alert-danger")
			     // .html("<i id='msg-ico' class='icon fa fa-ban'></i> "+result.mensaje).fadeIn(800);
                 swal({
                  type: 'error',
                  title: 'Oops...',
                  text: result.mensaje
                })
		  }
	   },"json");
    }
    })

    }else{
        $("#msg-box").removeClass().addClass("alert alert-dismissable alert-danger")
                 .html("<i id='msg-ico' class='icon fa fa-ban'></i> Hay campos vacíos").fadeIn(800);
    }
	setTimeout("$('#msg-box').hide('slow')",5000);
	return false;
});

$("#tabla-usuario").html(function(){
	var funcion='load';
	var celda="";
	console.log(funcion);
	$("#tabla-usuario > tbody:last").children().remove();
	$.post('sistema/controladores/usuario.php', {funcion: funcion}, function(result) {
		//console.log(funcion);
		if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td>"+valor.persona+"</td>";
                celda+="<td>"+valor.nompersona+" "+valor.apepersona+"</td>";
                celda+="<td>"+valor.nomperfil+"</td>";
                celda+="<td>"+valor.especialidad+"</td>";
                if(valor.estatus == "Inactivo"){
                    celda+="<td><span class='label label-warning'>"+valor.estatus+"</span></td>";
                }else if(valor.estatus == "Activo"){
                    celda+="<td><span class='label label-info'>"+valor.estatus+"</span></td>";
                }
                if($("#perfil-acceso").val()<=2){
                    celda+="<td><div id="+valor.persona+">";
                    celda+="<a href='#'class='edit-usuario' title='Modificar Usuario'><i class='fa fa-edit'></i> </a>";
                    celda+="<a href='#'class='del-usuario' title='Eliminar Usuario'><i class='fa fa-trash'></i> </a>";
                    celda+="</div></td>";
                    celda+="</tr>";
                }else{
                    celda+="<td></td>";
                    celda+="</tr>";
                }
                $("#tabla-usuario >tbody").append(celda);
            });
        }
        $(".edit-usuario").on("click",editUsuario);
        $(".del-usuario").on("click",deleteUsuario);
        $('#tabla-usuario').dataTable({
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

function buscarUsuario(cedula){
    var funcion="find";
    console.log(cedula+" buscando usuario...");
    if(cedula!="" && cedula.length>=6){
        $.post('sistema/controladores/usuario.php',{cedula:cedula,funcion:funcion},function(result){
        	console.log(result.exito);
            if(result.exito == 'true'){
                $("#especialidad").val(result.especialidad);
                $("#perfil").val(result.perfil);
                $("#usuario").val(result.user);
                $("#clave").val(result.pass);
                $("#confirmar").val(result.pass);
                $("#estatus").val(result.estatus);
                $("#persona").val(result.persona);
                $("#old").val(result.user);
                $("#oldperfil").val(result.perfil);
                $("#user-1").val(result.imagen);
                
                if($("#perfil-acceso").val()>2 || $("#persona-acceso").val() == result.persona){
                    $("#perfil").attr("disabled", true);
                    $("#especialidad").attr('disabled', true);
                    $("#estatus").attr("disabled", true);
                 } 
                
                $("#desperfil").val(result.desperfil);
                $("#desespecialidad").val(result.nomespecialidad);
                $("#etq-desperfil").text(result.desperfil);
                $("#imguser").attr("src","sistema/img/user/"+result.imagen);
                $("#etq-user").html("<i class='fa fa-user'></i> "+result.user);
                if(result.estatus=="A")
                    $("#desestatus").val("Activo");
                else $("#desestatus").val("Inactivo");

                $("#found-rol").val(result.nomespecialidad);

            }else{
                $("#usuario").val(cedula);
                $("#persona").val(cedula);
                $("#clave").val(cedula);
                $("#confirmar").val(cedula);
            }
            $("#btn-add-usuario").attr("disabled",false); 
        },"json");
    }
}

function editUsuario(){
    var cedula=$(this).parents("div").attr("id");
    $("#ced").attr('disabled', true);
    $("#ced").val(cedula);
    $("#content-lista-usuario").hide();
    $("#content-form-usuario").show('fast');    
    buscarPersona(cedula);
    $("#btn-add-persona").attr("disabled", false);
    //console.log($("#ced").val());
    buscarUsuario(cedula);
    $("#migadepan").text("Modificar");
    $("#info-user").hide();
    $(".btn-new-usuario").attr("disabled", true);
    $(".btn-vol-usuario").attr("disabled", false);
}

$("#form-usuario-mod").submit(function(event) {
	var funcion='edit';
	var persona=$("#persona").val();
	var usuario=$("#usuario").val();
	var old=$("#old").val();
	var oldperfil=$("#oldperfil").val();
	var clave=$("#clave").val();
	var perfil=$("#perfil").val();
    var especialidad=$("#especialidad").val();
    var imagen=$("#user-1").val();
    var estatus=$("#estatus").val();
	console.log(funcion);
	//console.log(usuario);

    if($("#clave").val() == $("#confirmar").val()){

        if($("#perfil").val()!="" && $("#especialidad").val()!="" && $("#estatus").val()!=""){


            swal({
          title: '¿Esta seguro que desea modificar este usuario?',
          // text: "Luego podrá cambiar su contraseña!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo modificarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {


	       $.post('sistema/controladores/usuario.php', 
		      {funcion: funcion,
			     persona: persona, 
		          usuario: usuario,
			     old: old,
			     oldperfil: oldperfil, 
			     clave: clave, 
			     perfil: perfil,
                especialidad: especialidad,
                imagen: imagen,
                estatus: estatus},function(result) {
		      if(result.exito=='true'){
			         console.log('modifico '+result.mensaje);
			         // $("#msg-box").removeClass().addClass("alert alert-dismissable alert-success")
			         // .html("<i id='msg-ico' class='icon fa fa-check'></i> "+result.mensaje).fadeIn(800);
                     swal({
                      type: 'success',
                      title: 'Bien!',
                      text: result.mensaje
                    })

		          }else{
			         console.log('No modifico '+result.mensaje);
			         // $("#msg-box").removeClass().addClass("alert alert-dismissable alert-danger")
			         // .html("<i id='msg-ico' class='icon fa fa-ban'></i> "+result.mensaje).fadeIn(800);
                     swal({
                      type: 'error',
                      title: 'Oops...',
                      text: result.mensaje
                    })
		          }
	           },"json");
       }
   })
        }else{
            $("#msg-box").removeClass().addClass("alert alert-dismissable alert-danger")
            .html("<i id='msg-ico' class='icon fa fa-ban'></i> Hay campos vacíos").fadeIn(800);
        }
    }else{
        $("#msg-box").removeClass().addClass("alert alert-dismissable alert-danger")
        .html("<i id='msg-ico' class='icon fa fa-ban'></i> Error en las contraseñas").fadeIn(800);
    }
	setTimeout("$('#msg-box').hide('slow')",5000);
	return false;
});

function deleteUsuario(){
    var cedula=$(this).parents("div").attr("id");
    var funcion="delete";
    var parent = $(this).parents("tr");
    console.log(funcion);
    // var respuesta= confirm("Confirme que desea eliminar permantentemente este usuario del sistema");
    // if(respuesta){



        swal({
          title: '¿Esta seguro que desea eliminar este usuario?',
          text: "Será eliminado permanentemente!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo eliminarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {



        $.post('sistema/controladores/usuario.php',
            {funcion:funcion, 
            cedula:cedula},function(result){
            if(result.exito == 'true'){
                // $("#msg-box").removeClass().addClass("alert alert-dismissable alert-success")
                // .html("<i id='msg-ico' class='icon fa fa-check'></i> "+result.mensaje).fadeIn(800);
                eliminarPersona(cedula);
                swal({
                      type: 'success',
                      title: 'Bien!',
                      text: result.mensaje
                    })
                $(parent).remove();
            }else{
                // $("#msg-box").removeClass().addClass("alert alert-dismissable alert-danger")
                // .html("<i id='msg-ico' class='icon fa fa-ban'></i> "+result.mensaje).fadeIn(800);
                swal({
                      type: 'error',
                      title: 'Oops...',
                      text: result.mensaje
                    })
            }
            //setTimeout("$('#msg-box').hide('slow')",5000);
        },"json");
    }
})
    
    return false;
}

function subirImagen(){
    var data = new FormData(this); //Creamos los datos a enviar con el formulario
    $.ajax({
        url: 'sistema/controladores/usuarioImagen.php', //URL destino
        data: data,
        processData: false, //Evitamos que JQuery procese los datos, daría error
        contentType: false, //No especificamos ningún tipo de dato
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
            $("#mensaje").removeClass().addClass("alert alert-dismissable alert-info")
            .html("<i class='icon fa fa-spinner fa-spin'></i> Cargando, espere...").fadeIn(800);
        },
        success: function (resultado) {
            if(resultado.exito=='true'){
                 $("#mensaje").removeClass().addClass("alert alert-dismissable alert-success")
                .html("<i class='icon fa fa-check'></i> "+resultado.mensaje).fadeIn(800);   
                $("#user-1").attr("src",'sistema/img/user/'+resultado.sources);
                $("#user-2").attr("src",'sistema/img/user/'+resultado.sources);
                $("#imguser").attr("src",'sistema/img/user/'+resultado.sources);
            }else{
                $("#mensaje").removeClass().addClass('alert alert-dismissable alert-danger').fadeIn(1000).text(resultado.mensaje);
            }
        },
        error: function(err){
            console.log(err.responseText);
        }
    });
    setTimeout("$('#mensaje').hide('slow')",5000);
    return false;
}

function cancelarUsuario(){
    $("#form-usuario")[0].reset();
    $("#btn-add-usuario").attr('disabled', false);
}

function cargarUsuario(cedula){
    $("#datosPersonales").removeClass('active');
    $("#datosUsuario").addClass('active');
    $("#seccion-1").removeClass('active');
    $("#seccion-2").addClass('active');

    $("#usuario").val(cedula);
    $("#clave").val(cedula);
    $("#confirmar").val(cedula);
}

