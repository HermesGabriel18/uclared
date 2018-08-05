$("#form-subir2").submit(subirImagen2);
$("#form-subir3").submit(subirImagen3);

$("#btn-can-servicio").on("click",cancelarServicio);

$("#form-servicio").submit(function(event) {
    var funcion='add';
    var descripcion=$("#des").val();
    var imagen=$("#imgservice2").val();
    var observacion=$("#ob").val();
    var duracion=$("#dur").val();
    var presupuesto=$("#pre").val();



        swal({
      title: '¿Esta seguro que desea guardar este servicio?',
      text: "Se generará un codigo predeterminado!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, deseo guardarlo!'
    }).then((resultalert) => {
      if (resultalert.value) {


    $.post('sistema/controladores/servicio.php', 
        {funcion: funcion,
        descripcion: descripcion,
        imagen: imagen,
        observacion: observacion,
        duracion: duracion,
        presupuesto: presupuesto}, function(result) {
        if(result.exito=='true'){
            console.log('agrego '+result.mensaje);
            // $("#msg-box").removeClass().addClass("alert alert-dismissable alert-success")
            // .html("<i id='msg-ico' class='icon fa fa-check'></i> "+result.mensaje).fadeIn(800);
            // cancelarServicio();
            swal({
              type: 'success',
              title: 'Bien!',
              text: result.mensaje
            })
            linkURL('sistema/vistas/servicioConsulta.php');
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
    
    //setTimeout("$('#msg-box').hide('slow')",5000);
    return false;
});

$("#tabla-servicio").html(function(){
    var funcion='load';
    var celda="";
    console.log(funcion);
    $("#tabla-servicio > tbody:last").children().remove();
    $.post('sistema/controladores/servicio.php', {funcion: funcion}, function(result) {
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td>"+valor.codigo+"</td>";
                celda+="<td>"+valor.descripcion+"<br>";
                celda+="<span style='display: none;' class='text"+valor.codigo+" bg-danger'></span></td>";
                celda+="<td><button id='btn"+valor.codigo+"' class='btn btn-link more' value="+valor.codigo+">Ver más</button></td>";
                celda+="<td class='text-center'>"+valor.presupuesto+"</td>";
                if(valor.estatus == "Inactivo"){
                    celda+="<td><span class='label label-warning'>"+valor.estatus+"</span></td>";
                }else if(valor.estatus == "Activo"){
                    celda+="<td><span class='label label-info'>"+valor.estatus+"</span></td>";
                }
                if($("#perfil-acceso").val()<=2){
                    celda+="<td><div id="+valor.codigo+">";
                    celda+="<a href='#'class='edit-servicio'  title='Modificar Servicio'><i class='fa fa-edit'></i> </a>";
                    celda+="<a href='#'class='del-servicio'  title='Eliminar Servicio'><i class='fa fa-trash'></i> </a>";
                    celda+="</div></td>";
                    celda+="</tr>";
                }else{
                    celda+="<td><div id="+valor.codigo+">";
                    celda+="<a href='#'class='edit-servicio' data-toggle='tooltip' title='Ver Servicio'><i class='fa fa-search'></i> </a>";
                    celda+="</div></td>";
                    celda+="</tr>";
                }
                $("#tabla-servicio >tbody").append(celda);
            });
        }
        $(".edit-servicio").on("click",editServicio);
        $(".del-servicio").on("click",deleteServicio);
        $(".more").on("click",verServicio);
        $('#tabla-servicio').dataTable({
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

function verServicio() {
    var codigo=$(this).val();
    buscarServicio(codigo);
    if($("#btn"+codigo+"").text()!="Ver más")
        $("#btn"+codigo+"").text('Ver más');
    else
        $("#btn"+codigo+"").text('Ver menos');   
}

function buscarServicio(codigo){
    var funcion="find";
    console.log(codigo+" buscando servicio...");
    if(codigo!=""){
        $.post('sistema/controladores/servicio.php',{codigo:codigo,funcion:funcion},function(result){
            console.log(result.exito);
            if(result.exito == 'true'){
                $("#cod").val(result.codigo);

                $("#desm").val(result.descripcion);
                $("#obm").val(result.observacion);
                $("#prem").val(result.presupuesto);
                $("#durm").val(result.duracion);

                $("#imgservice2m").val(result.imagen);
                $("#imgservicem").attr("src",'sistema/img/service/'+result.imagen);

                $("#sestatus").val(result.estatus);

                // $(".text"+result.codigo+"").toggle($(".text"+result.codigo+"").
                //     text(result.observacion).
                //     attr('class', 'bg-orange'));

                $(".text"+result.codigo+"").toggle($(".text"+result.codigo+"").
                    text(result.observacion));
                // if($("#btn"+result.codigo+"").text()!="Ver más")
                //     $("#btn"+result.codigo+"").text('some text');
                // else
                //     $("#btn"+result.codigo+"").text('some text2');
            }else{
                $("#desm").val(codigo);
                $("#obm").val(codigo);
                $("#prem").val(codigo);
            }
            $("#btn-add-servicio").attr("disabled",false); 
        },"json");
    }
}

function editServicio(){
    var codigo=$(this).parents("div").attr("id");
    $("#content-lista-servicio").hide();
    $("#content-form-servicio").show('fast');   
    buscarServicio(codigo);
    $("#migadepan").text("Modificar");

    $('#info-service').hide();

    $("#info-staff").show();

    $(".btn-vol-servicio").attr("disabled",false); 
    $(".btn-new-servicio").attr("disabled",true); 
}

$("#form-servicio-mod").submit(function(event) {
    var funcion='edit';
    var codigo=$("#cod").val();
    var descripcion=$("#desm").val();
    var imagen=$("#imgservice2m").val();
    var observacion=$("#obm").val();
    var duracion=$("#durm").val();
    var presupuesto=$("#prem").val();
    var estatus=$("#sestatus").val();


    swal({
          title: '¿Esta seguro que desea modificar este servicio?',
          // text: "Luego podrá cambiar su contraseña!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo modificarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {



    $.post('sistema/controladores/servicio.php', 
        {funcion: funcion,
        codigo: codigo,
        descripcion: descripcion,
        imagen: imagen,
        observacion: observacion,
        duracion: duracion,
        presupuesto: presupuesto,
        estatus: estatus}, function(result) {
        if(result.exito=='true'){
            console.log('agrego '+result.mensaje);
            // $("#msg-box").removeClass().addClass("alert alert-dismissable alert-success")
            // .html("<i id='msg-ico' class='icon fa fa-check'></i> "+result.mensaje).fadeIn(800);
            swal({
                      type: 'success',
                      title: 'Bien!',
                      text: result.mensaje
                    })
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
    //setTimeout("$('#msg-box').hide('slow')",5000);
    return false;
});

function deleteServicio(){
    var codigo=$(this).parents("div").attr("id");
    var funcion="delete";
    var parent = $(this).parents("tr");
    console.log(funcion);
    // var respuesta= confirm("Confirme que desea eliminar permantentemente este servicio del sistema");
    // if(respuesta){


        swal({
          title: '¿Esta seguro que desea eliminar este servicio?',
          text: "Será eliminado permanentemente!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo eliminarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

        $.post('sistema/controladores/servicio.php',
            {funcion:funcion, 
            codigo:codigo},function(result){
            if(result.exito == 'true'){
                // $("#msg-box").removeClass().addClass("alert alert-dismissable alert-success")
                // .html("<i id='msg-ico' class='icon fa fa-check'></i> "+result.mensaje).fadeIn(800);
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

function cancelarServicio(){
    $("#form-servicio")[0].reset();
    $("#form-subir2")[0].reset();
    $("#btn-add-servicio").attr('disabled', false);
}

function subirImagen2(){
    var data = new FormData(this); //Creamos los datos a enviar con el formulario
    $.ajax({
        url: 'sistema/controladores/servicioImagen.php', //URL destino
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
                // $("#user-1").attr("src",'sistema/img/user/'+resultado.sources);
                // $("#user-2").attr("src",'sistema/img/user/'+resultado.sources);
                $("#imgservice2").val(resultado.sources);
                $("#imgservice").attr("src",'sistema/img/service/'+resultado.sources);
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

function subirImagen3(){
    var data = new FormData(this); //Creamos los datos a enviar con el formulario
    $.ajax({
        url: 'sistema/controladores/servicioImagen2.php', //URL destino
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
                // $("#user-1").attr("src",'sistema/img/user/'+resultado.sources);
                // $("#user-2").attr("src",'sistema/img/user/'+resultado.sources);
                $("#imgservice2m").val(resultado.sources);
                $("#imgservicem").attr("src",'sistema/img/service/'+resultado.sources);
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
