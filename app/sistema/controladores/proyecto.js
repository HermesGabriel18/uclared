// ACCIÓN PARA EL BOTÓN DR CANCELAR (LIMPIAR FORMULARIO)
// NO CONFUNDIR CON EL DE CANCELAR(CAMBIAR EL ESTATUS)
$("#btn-can-proyecto").on("click",cancelarProyecto);

function validarFinalizar(){
    console.log("finalizados: "+$("#cantF").val());
    if($("#text-proyecto").text()=="100% completado."){
        console.log("estan todos finalizados");
        return true;
    }else{
        console.log("no estan todos finalizados");
        return false;
    }
}

// BOTÓN DE FINALIZAR PROYECTO
$("#btn-fin-proyecto").click(function(event) {

    if(validarFinalizar()){

    // MENSAJE DE VERIFICACIÓN
    swal({
          title: '¿Esta seguro que desea finalizar este proyecto?',
          text: "No podrá modificarlo!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo finalizarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

                // ENVÍO DE DATOS AL CONTROLADOR
                $.ajax({
                    url: 'sistema/controladores/proyecto.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {codigo: $("#codopc").val(),
                    funcion: 'finP'},
                })
                .done(function(result) {
                    console.log("success");

                    // ESCONDER LOS BOTONES PARA FINALIZAR Y CANCELAR PROYECTO
                    $("#opciones-proyecto").hide();
                    // ESCONDER EL BOTÓN DE AGREGAR PROYECTO (EN ESTE CASO ESTE BOTÓN GUARDABA LOS CAMBIOS)
                    $("#btn-add-proyecto").hide();
                    // CAMBIAR TEXTO EN LA CAJA DE PROGRESO
                    $("#text-proyecto").text("Este proyecto ya no puede ser modificado.");
                    // CAMBIARLO CAJA DE PROGRESO A COLOR ROJO
                    $("#box-text-proyecto").removeClass('info-box bg-olive').addClass('info-box bg-red');
                    // MENSAJE DE  ÉXITO
                    swal({
                        type: 'success',
                      title: 'Bien!',
                      text: result.mensaje
                    })
                    // REDIRECCIONA A EL LISTADO DE PROYECTOS
                    linkURL('sistema/vistas/proyectoConsulta.php');
                })
                // FALLO EN LA FINALIZACIÓN DE PROYECTO
                .fail(function(result) {
                    console.log("error"+result.mensaje);
                    $("#msg-box").removeClass().addClass("alert alert-dismissable alert-danger")
                    .html("<i id='msg-ico' class='icon fa fa-ban'></i> "+result.mensaje).fadeIn(800);
                })
                // FUNCIÓN QUE SIEMPRE SE EJECUTA
                .always(function() {
                    console.log("complete");
                });
            }
        })
    }else{
        swal({
              type: 'error',
              title: 'Oops...',
              text: "Aún tiene servicios sin finalizar!"
            })
    }
    setTimeout("$('#msg-box').hide('slow')",5000);
});

// BOTÓN PARA CANCELAR PROYECTO (CAMBIAR ESTATUS)
// NO CONFUNDIR CON EL BOTÓN DE LIMPIAR FORMULARIO
$("#btn-botar-proyecto").click(function(event) {

    // MENSAJE DE VERIFICACIÓN
    swal({
          title: '¿Esta seguro que desea cancelar este proyecto?',
          text: "No podrá modificarlo!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo cancelarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {

                // ENVÍO DE DATOS AL CONTROLADOR
                $.ajax({
                    url: 'sistema/controladores/proyecto.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {codigo: $("#codopc").val(),
                    funcion: 'canP'},
                })
                .done(function(result) {
                    console.log("success");
                    // ESCONDE EL BOTÓN DE AGREGAR PROYECTO (EN ESTE CASO EL BOTÓN GURADABA LOS CAMBIOS)
                    $("#btn-add-proyecto").hide();
                    // ESCONDE LOS BOTONES DE FINALIZAR Y CANCELAR PROYECTO
                    $("#opciones-proyecto").hide();
                    // CAMNBIA EL TEXTO EN LA SECCIÓN DE PROGRESO
                    $("#text-proyecto").text("Este proyecto ya no puede ser modificado.");
                    // CAMBIA EL COLOR DE LA SECCIÓN DE PROYECTO A ROJO
                    $("#box-text-proyecto").removeClass('info-box bg-olive').addClass('info-box bg-red');
                    // MENSAJE DE ÉXITO
                    swal({
                          type: 'success',
                          title: 'Bien!',
                          text: result.mensaje
                        })
                })
                // ERROR EN EL ENVÍO
                .fail(function(result) {
                    console.log("error"+result.mensaje);
                    $("#msg-box").removeClass().addClass("alert alert-dismissable alert-danger")
                    .html("<i id='msg-ico' class='icon fa fa-ban'></i> "+result.mensaje).fadeIn(800);
                })
                // FUNCIÓN QUE SIEMPRE SE EJECUTA
                .always(function() {
                    console.log("complete");
                });
         }
    })
    setTimeout("$('#msg-box').hide('slow')",5000);
});

// CARGA UN LISTADO DE LOS SERVICIOS QUE PUEDEN SER INCLUIDOS A UN PROYECTO
$("#tabla-servicio-p").html(function(){
    var funcion='load';
    var celda="";
    console.log(funcion);
    //var pancito=$("#pancito").val();
    $("#tabla-servicio-p > tbody:last").children().remove();
    // ENVÍA DATOS AL CONTROLADOR
    $.post('sistema/controladores/servicio.php', {funcion: funcion}, function(result) {
        // RECIBE UN ARRAY
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            // RECORRE EL ARRAY
            $.each(result, function(index,valor){
                // CARGA LAS CELDAS CON LOS DATOS OBTENIDOS
                celda="<tr>";
                celda+="<td>"+valor.codigo+"</td>";
                celda+="<td>"+valor.descripcion+"</td>";
                celda+="<td>"+valor.presupuesto+"</td>";
                celda+="<td>"+valor.duracion+" días</td>";
                if($("#perfil-acceso").val()<=3 ){
                    celda+="<td><div id="+valor.codigo+">";
                    celda+="<input type='checkbox' name='serviciop[]' value="+valor.codigo+">";
                    if($("#codp").val()==""){
                        celda+="<a href='#' id=cod"+valor.codigo+" class='fin-servicio' title='Finalizar servicio'><i class='fa fa-times pull-right'></i> </a>";
                        celda+="<td><span id=paraasignados"+valor.codigo+" class='label label-warning label-informacionServicios'>No seleccionado</span></td>";
                        celda+="</div></td>";
                    }
                        
                }else{
                    celda+="<td><span id=paraasignados"+valor.codigo+" class='label label-warning'>No seleccionado</span></td>";
                    celda+="</div></td>";
                }
                celda+="</tr>";
                $("#tabla-servicio-p >tbody").append(celda);
            });
        }
        $(".fin-servicio").on("click",finServicio);
    },"json");
});

// FINALIZAR SERVICIO
function finalizarServicio(proyecto, servicio){

    // MENSAJE DE VERIFICACIÓN
    swal({
          title: '¿Esta seguro que desea finalizar este servicio?',
          text: "No podrá cambiar el estado de dicho servicio!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, deseo finalizarlo!',
          cancelButtonText: 'Cancelar'
        }).then((resultalert) => {
          if (resultalert.value) {
                // ENVÍO DE DATOS AL CONTROLADOR
                $.ajax({
                    url: 'sistema/controladores/proyecto.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {funcion: 'finServicio', proyecto: proyecto, servicio: servicio},
                })
                .done(function(data) {
                    console.log("success");
                    //MENSAJE DE ÉXITO
                    swal({
                        type: 'success',
                        title: 'Bien!',
                        text: data.mensaje
                    })
                    //REDIRECCIONA AL LISTADO DE PROYECTOS
                    linkURL('sistema/vistas/proyectoConsulta.php');
                    // BLOQUEA EL INPUT CHECKBOX DE EL SERVICIO FINALIZADO
                    $("input[value='"+servicio+"'").prop('disabled', true);

                })
                // FUNCIÓN DE ERROR
                .fail(function() {
                    console.log("error");
                })
                // FUNCIÓN QUE SIEMPRE SE EJECUTA
                .always(function() {
                    console.log("complete");
                });
        }
    })
    
}

// ACCIONES PARA EL BOTÓN DE FINALIZAR SERVICIO
function finServicio(){
    var servicio=$(this).parents("div").attr("id");
    var proyecto=$("#codp").val();
    // LLAMA EL MÉTODO PARA FINALIZAR EL SERVICIO
    finalizarServicio(proyecto, servicio);
}

// CARGA LA TABLA DE LOS USUARIO QUE PUEDEN SER AÑADIDOS A UN PROYECTO
$("#tabla-usuario-p").html(function(){
    var codigo=$("#codp").val();
    var funcion='load';
    var celda="";
    console.log(funcion);
    $("#tabla-usuario-p > tbody:last").children().remove();
    // ENVÍO DE DATA AL CONTROLADOR
    $.post('sistema/controladores/usuario.php', {funcion: funcion}, function(result) {
        // RECIBE UN ARRAY
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            // RECORRE EL ARRAY
            $.each(result, function(index,valor){
                // CARGA LAS CELDAS CON LOS DATOS OBTENIDOS
                celda="<tr>";
                celda+="<td>"+valor.persona+"</td>";
                celda+="<td>"+valor.nompersona+" "+valor.apepersona+"</td>";
                celda+="<td>"+valor.especialidad+"</td>";
                if($("#perfil-acceso").val()<=3){
                    celda+="<td><div id="+valor.persona+">";
                    celda+="<input type='checkbox' name='usuariop[]' value="+valor.persona+">";                   
                    celda+="</div></td>";
                    celda+="</tr>";
                }

                // VERIFICA QUE NO SE MUESTREN JEFES DE PROYECTOS, TESTER Y USUARIOS QUE ESTÉN INACTIVO
                if(valor.idperfil > 2 && valor.especialidad != "Tester" && 
                    valor.estatus != "Inactivo" && 
                    valor.especialidad != "Jefe de proyecto"){
                    $("#tabla-usuario-p >tbody").append(celda);
                }

            });
        }
    },"json");
});


// FORMULARIO PARA REGISTRAR PROYECTOS
$("#form-proyecto").submit(function(event) {
    // var maximo=0;
    // $.each($("input[type=checkbox][name='serviciop[]']"), function(index, val) {
    //      if($("input[type=checkbox][name='serviciop["+index+"]']").is(':checked')){
    //         console.log("VALORRR "+val.value);
    //      }else{
    //         console.log("ERRORRRRRRRRRRRRRRRRRRRRRR ");
    //         console.log("OJO: "+$("input[type=checkbox][name='serviciop["+index+"]']").val());
    //      }
    // });

    // CAMBIAR FORMATO DE LA FECHA DE INICIO
    var inicioDate = $("#inicio").val().split("-");
    var newInicioDate= Number(inicioDate[0]+inicioDate[1]+inicioDate[2]);

    // CAMBIAR FORMATO DE LA FECHA DE FIN
    var finDate = $("#fin").val().split("-");
    var newFinDate= Number(finDate[0]+finDate[1]+finDate[2]);

    // CAMBIAR FORMATO DE LA FECHA DE ACTUAL
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 

    today = yyyy + '-' + mm + '-' + dd;

    var newToday=Number(yyyy+mm+dd);

    console.log(newFinDate);
    console.log(newToday);

    // VERIFICA QUE SE HAYAN AÑADIDO SERVICIOS Y USUARIOS
    if($("input[type=checkbox][name='serviciop[]']").is(':checked') && $("input[type=checkbox][name='usuariop[]']").is(':checked') ){

        // VERIFICA QUE LA FECHA DE INICIO NO SEA MENOR A LA ACTUAL
        if(newInicioDate > newToday){

            // VERIFICA QUE LA FECHA DE FINAL NO SE MENOR A LA DE INICIO
            if (newFinDate > newInicioDate) {

                // VERIFICA QUE SE HAYA SELELECCIONADO UN CLIENTE Y UN JEFE DE PROYECTO
                if($("#jefe").val()!="" && $("#clip").val()!=""){

                    // MENSAJE DE VERIFICACIÓN
                    swal({
                      title: '¿Esta seguro que desea guardar este proyecto?',
                      text: "Asegúrese de haber introducido los datos correctos!",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, deseo guardarlo!',
                      cancelButtonText: 'Cancelar'
                    }).then((resultalert) => {
                      if (resultalert.value) {



                            $.ajax({
                                url: 'sistema/controladores/proyecto.php',
                                type: 'POST',
                                dataType: 'json',
                                data: $("#form-proyecto").serialize(),
                        
                                success: function(result){
                                console.log('agrego '+result.mensaje);
                                if(result.exito=='true'){
                                    // MENSAJE DE ÉXITO
                                    swal({
                                      type: 'success',
                                      title: 'Bien!',
                                      text: result.mensaje
                                    })
                                    // REDIRECCIONA A LOS LISTADO DE PROYECTOS
                                    linkURL('sistema/vistas/proyectoConsulta.php');
                                 
                                }else if(result.exito=='false'){
                                    // MENSAJE DE ERROR
                                    swal({
                                      type: 'error',
                                      title: 'Oops...',
                                      text: result.mensaje
                                    })
                                }
                                },
                                error: function(result){
                                    console.log('no agrego '+result.responseText);
                                    // MENSAJE DE ERROR
                                    swal({
                                      type: 'error',
                                      title: 'Oops...',
                                      text: 'Algo ha salido mal! Seguramente ya hay un proyecto con ese código'
                                    })
                                    // BLOQUEA EL BOTÓN DE CANCELAR PROYECTO
                                    $("#btn-can-proyecto").attr('disabled', false);
                                },
                            });
                        }
                    })
                
                }else{
                    // MENSAJE DE ERROR
                    swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Debe incluir un jefe y un cliente para el proyecto!'
                    })
                    $("#btn-can-res").attr('disabled', false);
                    $("#btn-can-cli").attr('disabled', false);
                }

            }else{
                // MENSAJE DE ERROR
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'La fecha fin no puede ser menor o igual a la fecha inicia de inicio!'
                })
            }
        }else{
            // MENSAJE DE ERROR
            swal({
              type: 'error',
              title: 'Oops...',
              text: 'La fecha de inicio no puede ser menor o igual a la actual!'
            })
        }
    }else{
        // MENSAJE DE ERROR
        swal({
          type: 'error',
          title: 'Oops...',
          text: 'Debe incluir servicios y usuarios al proyecto!'
        })
    }
    
    return false;
});

// LIMPIA EL FORMULARIO DE PROYECTO
function cancelarProyecto(){
    $("#form-proyecto")[0].reset();
    $("#btn-add-proyecto").attr('disabled', false);
    $("#btn-add-res").attr('disabled', false);
    $("#btn-add-cli").attr('disabled', false);
}

// CARGA EL LISTADO DE PROYECTOS
$("#tabla-proyecto").html(function(){
    var funcion='load';
    var celda="";
    console.log(funcion);
    $("#tabla-proyecto > tbody:last").children().remove();
    // ENVÍA DATOS AL CONTROLADOR
    $.post('sistema/controladores/proyecto.php', {funcion: funcion}, function(result) {
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){

                var dateArInicio = valor.finicio.split('-');
                var newDateInicio = dateArInicio[2] + '-' + dateArInicio[1] + '-' + dateArInicio[0];

                var dateArFin = valor.ffin.split('-');
                var newDateFin = dateArFin[2] + '-' + dateArFin[1] + '-' + dateArFin[0];

                celda="<tr>";
                celda+="<td>"+valor.codigo+"</td>";
                celda+="<td>"+valor.nombre+" "+valor.apellido+"</td>";
                
                buscarNatural(valor.cliente);
                buscarJuridico(valor.cliente);
                celda+="<td class='cli"+valor.cliente+"'></td>";
                celda+="<td>"+newDateInicio+" / ";
                celda+=""+newDateFin+"</td>"
                celda+="<td>"+valor.total+"</td>";
                if(valor.estatus == "Finalizado"){
                    celda+="<td><span class='label label-danger'>"+valor.estatus+"</span></td>";
                }else if(valor.estatus == "Activo"){
                    celda+="<td><span class='label label-info'>"+valor.estatus+"</span></td>";
                }else if(valor.estatus == "Cancelado"){
                    celda+="<td><span class='label label-warning'>"+valor.estatus+"</span></td>";
                }
                if($("#perfil-acceso").val()<=2){
                    celda+="<td><div id="+valor.codigo+">";
                    celda+="<a href='#' class='edit-proyecto' title='Actualizar Proyecto'><i class='fa fa-edit'></i> </a>";
                    if(valor.estatus=="Finalizado"){
                        celda+="<a href='#' class='com-proyecto' title='Calificación'><i class='fa fa-comments-o'></i> </a>";
                    }       
                    celda+="</div></td>";
                    celda+="</tr>";
                }
                $("#tabla-proyecto >tbody").append(celda);

            });
        }
        $(".edit-proyecto").on("click",editProyecto);
        $(".com-proyecto").on("click",comProyecto);
        $('#tabla-proyecto').dataTable({
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

$("#tabla-proyecto-a").html(function(){
    console.log("hola "+$("#persona-acceso").val());
    var funcion='loada';
    var celda="";
    console.log(funcion);
    $("#tabla-proyecto-a > tbody:last").children().remove();
    $.post('sistema/controladores/proyecto.php', {funcion: funcion, usuario: $("#persona-acceso").val()}, function(result) {
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){

                //var dateArInicio = valor.finicio.split('-');
                //var newDateInicio = dateArInicio[2] + '-' + dateArInicio[1] + '-' + dateArInicio[0];
                //console.log(newDateInicio);

                var dateArFin = valor.ffin.split('-');
                var newDateFin = dateArFin[2] + '-' + dateArFin[1] + '-' + dateArFin[0];

                celda="<tr>";
                celda+="<td>"+valor.proyecto+"</td>";
                celda+="<td>"+valor.nombre+" "+valor.apellido+"</td>";

                buscarNatural(valor.cliente);
                buscarJuridico(valor.cliente);
                celda+="<td class='cli"+valor.cliente+"'></td>";

                //celda+="<td>"+valor.cli+"</td>";
                celda+="<td>"+newDateFin+"</td>";

                if(valor.estatus == "Activo"){
                    celda+="<td><span class='label label-info'>"+valor.estatus+"</span></td>";
                }else if(valor.estatus == "Finalizado"){
                    celda+="<td><span class='label label-danger'>"+valor.estatus+"</span></td>";
                }else{
                    celda+="<td><span class='label label-warning'>"+valor.estatus+"</span></td>";
                }

                if($("#persona-acceso").val()!=valor.resp){
                
                    celda+="<td><div id="+valor.proyecto+">";
                    celda+="<a href='#'class='edit-proyecto' title='Ver Proyecto'><i class='fa fa-search'></i> </a>";
                    celda+="</div></td>";
                    celda+="</tr>";
                }else if($("#persona-acceso").val()==valor.resp){
                    celda+="<td><div id="+valor.proyecto+">";
                    celda+="<a href='#' class='edit-proyecto' title='Actualizar Proyecto'><i class='fa fa-edit'></i> </a>";
                    if(valor.estatus=="Finalizado"){
                        celda+="<a href='#' class='com-proyecto' title='Calificación'><i class='fa fa-comments-o'></i> </a>";
                    }       
                    celda+="</div></td>";
                    celda+="</tr>";
                }

                $("#tabla-proyecto-a >tbody").append(celda);
            });
        }
        $(".edit-proyecto").on("click",editProyecto);
        $('#tabla-proyecto').dataTable({
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

$("#form-proyecto-com").submit(function(event) {
    $.ajax({
        url: 'sistema/controladores/proyecto.php',
        type: 'POST',
        dataType: 'json',
        data: $("#form-proyecto-com").serialize(),
    })
    .done(function(result) {
        console.log("success");
        $("#msg-box").removeClass().addClass("alert alert-dismissable alert-success")
            .html("<i id='msg-ico' class='icon fa fa-check'></i> "+result.mensaje).fadeIn(800);
            cancelarComentario();
    })
    .fail(function(result) {
        console.log("error");
        $("#msg-box").removeClass().addClass("alert alert-dismissable alert-danger")
                .html("<i id='msg-ico' class='icon fa fa-ban'></i> "+result.mensaje).fadeIn(800);
    })
    .always(function() {
        console.log("complete");
    });
    setTimeout("$('#msg-box').hide('slow')",5000);
    return false;
});

$("#tabla-proyecto-i").html(function(){
    var funcion='load';
    var celda="";
    console.log(funcion);
    $("#tabla-proyecto-i > tbody:last").children().remove();
    $.post('sistema/controladores/proyecto.php', {funcion: funcion}, function(result) {
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){

                var dateAr2 = valor.ffin.split('-');
                var newDate2 = dateAr2[2] + '-' + dateAr2[1] + '-' + dateAr2[0];

                celda="<tr>";
                celda+="<td>"+valor.codigo+"</td>";
                celda+="<td>"+valor.nombre+" "+valor.apellido+"</td>";
                //buscarNatural(valor.cliente);
                //buscarJuridico(valor.cliente);
               // celda+="<td class='cli"+valor.cliente+"'></td>";
                celda+="<td>"+valor.cliente+"</td>";
                celda+="<td>"+newDate2+"</td>";
                celda+="<td><i class='fa fa-circle text-success'></i></td>";
                if(valor.estatus=="Activo")
                    $("#tabla-proyecto-i >tbody").append(celda);
            });
        }
    },"json");
});

function buscarProyecto(codigo){
    var funcion="find";
    console.log(codigo+" buscando proyecto...");
    $.ajax({
        url: 'sistema/controladores/proyecto.php',
        type: 'POST',
        dataType: 'json',
        data: {codigo: codigo, funcion: funcion},
    })
    .done(function(result) {
        console.log(result.exito);
        if (result.exito == 'true') {
            $("#fpersona").attr('disabled', true);
            $("#fpersona").val(result.responsable);
            $("#fpersona2").val(result.responsable);
            $("#fcli").attr('disabled', true);
            $("#fcli").val(result.cliente);
            $("#inicio").val(result.fechaInicio);
            $("#fin").val(result.fechaFin);

            $("#inicio2").val(result.fechaInicio);

            $("#cocodigo").val(result.codigo);


            $("#create").text(result.fechaCreate);

            $("#jefe").val(result.responsable);
            $("#pancito").val(result.responsable);
            
            buscarPersona(result.responsable);
            buscarNatural(result.cliente);
            buscarJuridico(result.cliente);

            var dateArFin = result.fechaFin.split('-');
            var newDateFin = Number(dateArFin[0]+dateArFin[1]+dateArFin[2]);

            var dateArInicio = result.fechaInicio.split('-');
            var newDateInicio = Number(dateArInicio[0]+dateArInicio[1]+dateArInicio[2]);

            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();

            if(dd<10) {
                dd = '0'+dd
            } 

            if(mm<10) {
                mm = '0'+mm
            } 

            var newToday=Number(yyyy+mm+dd);

            var restaMeses=Number(dateArFin[1])-Number(mm);
            var restaDias=Number(dateArFin[2])-Number(dd);
            if(restaDias<0){
                restaFinalD=(Number(dateArFin[2])+30)-Number(dd);
            }else{
                restaFinalD=Number(dateArFin[2])-Number(dd);
            }
            if(restaMeses>0){
                restaFinalM=restaMeses*30;
            }else{
                restaFinalM=restaMeses;
            }
            console.log("restaaaaaaaDIA:"+restaFinalD);
            console.log("restaaaaaaaMES:"+restaFinalM);
            if(result.estatus == 'A'){
                if(restaFinalM+restaFinalD>=15){
                    swal({
                            type: 'info',
                            title: 'Información',
                            text: "Quedan "+(restaFinalM+restaFinalD)+" días para que finalice el proyecto."
                        })
                }else{
                    swal({
                            type: 'warning',
                            title: 'Alerta!',
                            text: "Quedan  sólo "+(restaFinalM+restaFinalD)+" días para que finalice el royecto!"
                        })
                }

                if(newToday > newDateInicio){
                    $("#inicio").attr('disabled', true);
                }
            }
                 

            $("input[name=cali][value='"+result.calificacion+"']").attr('checked', true);
            $("#comen").val(result.comentario);
            if (result.estatus == 'I') {
                $("#opciones-proyecto").hide();
                $("#box-text-proyecto").removeClass('info-box bg-olive').addClass('info-box bg-red');

                $("#botonespro").hide();

            }else if(result.estatus == 'E'){
                $("#opciones-proyecto").hide();
                $("#box-text-proyecto").removeClass('info-box bg-olive').addClass('info-box bg-red');
                $("#text-proyecto").text("Este proyecto ya no puede ser modificado.");

                $("#botonespro").hide();
            }

            if($("#perfil-acceso").val()>2 && $("#persona-acceso").val()!=result.responsable){
                $("#botonespro").hide();
            }
            
            if(result.estatus=='I' || result.estatus=='E'){
                console.log("bloquea todo");
                $("input[type='checkbox'][name='serviciop[]']").attr('disabled', true);
                $("input[type='checkbox'][name='usuariop[]']").attr('disabled', true);
                $("#jefe").attr('disabled', true);
                $("#inicio").attr('disabled', true);
                $("#fin").attr('disabled', true);
                $(".label-informacionServicios").text("");

            }

            if($("#perfil-acceso").val()>2 && $("#persona-acceso").val()!=result.responsable){
                $("input[type='checkbox'][name='serviciop[]']").attr('disabled', true);
                $("input[type='checkbox'][name='usuariop[]']").attr('disabled', true);
                $("#jefe").attr('disabled', true);
                $("#inicio").attr('disabled', true);
                $("#fin").attr('disabled', true);
            }

        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    
}

function editProyecto(){
    var codigo=$(this).parents("div").attr("id");
    $("#tabla-proyecto").html("sfsd");
    $("#tabla-proyecto-a").html("sdfs");
    $("#codp").attr('disabled', true);
    $("#codp").val(codigo);
    $("#codp2").val(codigo);
    $("#content-lista-proyecto").hide();
    $("#content-lista-proyecto2").hide();
    $("#content-form-proyecto").show('fast');
    $(".btn-vol-proyecto").attr("disabled",false);  
    buscarProyecto(codigo);
    buscarUsuarioProyecto(codigo);
    buscarServicioProyecto(codigo);
    $("#btn-add-proyecto").attr("disabled", false);
    $(".btn-new-proyecto").attr('disabled', true);

    $('#project-pro').show();
    $('#info-project').hide();
    if($("#perfil-acceso").val()<=2){
        $("#opciones-proyecto").show();
        $("#migadepan").text("Modificar");
    }else{
        $("#info-asignados").show();
    }

    $("#codopc").val(codigo);

    $.post('sistema/controladores/proyecto.php', {funcion:'progress', codigo: codigo}, function(data) {
        // if(!jQuery.isEmptyObject(data) && $.isArray(data)){
        //     $.each(data, function(valor){
        //         console.log(valor.resultado);
        //     });
        // }
        if(data.success=="true"){
            if(data.estatus=='A' || data.estatus=='I'){
            console.log(data.resultado);
            $(".progress-bar").width(data.resultado+"%");
            $("#text-proyecto").text(Math.round(data.resultado)+"% completado.");
            }
        }else{
            console.log("ERROR");
        }
    },"json");

}

function comProyecto() {
    var codigo=$(this).parents("div").attr("id");
    $("#codigop").attr('disabled', true);
    $("#codigop").val(codigo);
    $("#content-lista-proyecto").hide();
    $("#content-proyecto-comentarios").show();
    $(".btn-vol-proyecto").attr("disabled",false);
    buscarProyecto(codigo);
    $(".btn-new-proyecto").attr('disabled', true);
    $("#migadepan").text("Comentarios");

    $('#info-project').hide();

}

function cancelarProyecto(){
    $("#form-proyecto")[0].reset();
    $("#btn-add-proyecto").attr('disabled', false);
}

function cancelarComentario(){
    $("#btn-add-comentario").attr('disabled', false);
}

function buscarUsuarioProyecto(codigo){
    var funcion='findU';
    $.ajax({
        url: 'sistema/controladores/proyecto.php',
        type: 'POST',
        dataType: 'json',
        data: {funcion: funcion, codigo:codigo},
    })
    .done(function(result) {
        console.log("success");
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index, val) {
                $("input[value='"+val.usuario+"'").prop('checked', true);
            });
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    
}

function buscarServicioProyecto(codigo){
    var cantF=-1;
    var funcion='findS';
    $.ajax({
        url: 'sistema/controladores/proyecto.php',
        type: 'POST',
        dataType: 'json',
        data: {funcion: funcion, codigo:codigo},
    })
    .done(function(result) {
        console.log("success");
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index, val) {
                if($("#perfil-acceso").val()<=3){
                    $("input[value='"+val.servicio+"'").prop('checked', true);
                    if(val.estatus=='Finalizado'){
                        $("input[value='"+val.servicio+"'").prop('disabled', true);
                        $("#paraasignados"+val.servicio+"").text('Finalizado').removeClass('label-warning').addClass('label-danger');
                    }else if(val.estatus=='Activo'){
                        $("#paraasignados"+val.servicio+"").text('En progreso').removeClass('label-warning').addClass('label-info');
                    }
                }
                else{
                    if(val.estatus=='Finalizado'){
                        $("#paraasignados"+val.servicio+"").text('Finalizado').removeClass('label-warning').addClass('label-danger');
                    }else if(val.estatus=='Activo'){
                        $("#paraasignados"+val.servicio+"").text('En progreso').removeClass('label-warning').addClass('label-info');
                    }
                }
                cantF=cantF+1;
            });
        }
        $("#cantF").val(cantF);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    $("#cantF").val(cantF);
    
}

$("#form-proyecto-mod").submit(function(event) {

    var inicioDate = $("#inicio").val().split("-");
    var newInicioDate= Number(inicioDate[0]+inicioDate[1]+inicioDate[2]);

    var finDate = $("#fin").val().split("-");
    var newFinDate= Number(finDate[0]+finDate[1]+finDate[2]);

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 

    today = yyyy + '-' + mm + '-' + dd;

    var newToday=Number(yyyy+mm+dd);

    console.log(newFinDate);
    console.log(newToday);

    if($("input[type=checkbox][name='serviciop[]']").is(':checked') && $("input[type=checkbox][name='usuariop[]']").is(':checked') ){

        // if(newInicioDate > newToday){
        //     console.log("epaleeeeee");

            if (newFinDate > newInicioDate) {

                if($("#jefe").val()!=""){



                    swal({
                      title: '¿Esta seguro que desea modificar este proyecto?',
                      text: "Asegúrese de haber introducido los datos correctos!",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, deseo modificarlo!',
                      cancelButtonText: 'Cancelar'
                    }).then((resultalert) => {
                      if (resultalert.value) {

        $.ajax({
            url: 'sistema/controladores/proyecto.php',
            type: 'POST',
            dataType: 'json',
            data: $("#form-proyecto-mod").serialize(),
    
            success: function(result){
            console.log('modifico '+result.mensaje);
            //     $("#msg-box").removeClass().addClass("alert alert-dismissable alert-success")
            // .html("<i id='msg-ico' class='icon fa fa-check'></i> "+result.mensaje).fadeIn(800);
            if(result.exito=='true'){
                    //     $("#msg-box").removeClass().addClass("alert alert-dismissable alert-success")
                    
                    // .html("<i id='msg-ico' class='icon fa fa-check'></i> "+result.mensaje).fadeIn(800);
                    //     cancelarProyecto();
                        swal({
                          type: 'success',
                          title: 'Bien!',
                          text: result.mensaje
                        })
                        linkURL('sistema/vistas/proyectoConsulta.php');
                     
            }else if(result.exito=='false'){
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: result.mensaje
                })
            }
            },
            error: function(result){
                        console.log('no agrego '+result.responseText);
                        // $("#msg-box").removeClass().addClass("alert alert-dismissable alert-danger")
                        // .html("<i id='msg-ico' class='icon fa fa-ban'></i> "+result.mensaje).fadeIn(800);
                        swal({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Algo ha salido mal!'
                        })
                        $("#btn-can-proyecto").attr('disabled', false);
                    },
                });
            }
        })
                
                }else{
                     // MENSAJE DE ERROR
                    swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'No puede dejar el proyecto sin un jefe!'
                    })
                    $("#btn-can-res").attr('disabled', false);
                    $("#btn-can-cli").attr('disabled', false);
                }

            }else{
                 // MENSAJE DE ERROR
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Fecha tope del proyecto inválida!'
                })
                $("#btn-can-res").attr('disabled', false);
                $("#btn-can-cli").attr('disabled', false);
            }
        // }else{
        //     $("#msg-box-pro").removeClass().addClass("alert alert-dismissable alert-danger")
        //     .html("<i id='msg-ico' class='icon fa fa-ban'></i> Fecha de inicio no válida!").fadeIn(800);
        // }
    }else{
        // MENSAJE DE ERROR
        swal({
          type: 'error',
          title: 'Oops...',
          text: 'Se le ha olvidado incluir servicios o usuarios!'
        })
        $("#btn-can-res").attr('disabled', false);
        $("#btn-can-cli").attr('disabled', false);
    }
    
    setTimeout("$('#msg-box').hide('slow')",5000);
    setTimeout("$('#msg-box-pro').hide('slow')",2000);
    return false;

});

$("#jefe").html(function(){
    var funcion="load";
    var idjefe=0;
    var nombre=0;
    $("#jefe").empty();
    $("#jefe").append("<option value=''>Seleccione...</option>");
    $.post("sistema/controladores/usuario.php",{funcion:funcion},function(data){
        console.log(data);
        if(!jQuery.isEmptyObject(data) && $.isArray(data)){
            $.each(data, function(index, valor){
                //if(valor.idrol==1){
                    idjefe=valor.user;
                    nombre=valor.nompersona+" "+valor.apepersona; 
                //}else{
                    if(valor.especialidad!="Desarrollador" && valor.estatus!="Inactivo")
                        $("#jefe").append("<option value='"+valor.persona+"'>"+nombre+"</option>");
                //} 
            });

            // if($("#perfil-acceso").val()==1){
            //     $("#perfil").append("<option value='"+idperfil+"'>"+nombre+"</option>");
            // }
        }
    },"json");
});

$("#tabla-calificacion-buena").html(function(){
    var funcion='calibuena';
    var celda="";
    console.log(funcion);
    $("#tabla-calificacion-buena > tbody:last").children().remove();
    $.post('sistema/controladores/proyecto.php', {funcion: funcion}, function(result) {
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                buscarNatural(valor.cliente);
                buscarJuridico(valor.cliente);
                celda+="<td class='cli"+valor.cliente+"'></td>";

                celda+="<td>"+valor.codigo+"</td>";
                celda+="<td>"+valor.calificacion+"";

                celda+="<button id='btn"+valor.codigo+"' class='btn btn-link moreCB' value="+valor.codigo+">Ver más</button></td>";
                celda+="<td><span style='display: none;' class='textC"+valor.codigo+" bg-danger'>"+valor.comentario+"</span></td>";
                celda+="</tr>";
                $("#tabla-calificacion-buena >tbody").append(celda);
            });
            $(".moreCB").on("click",verComentario);
        }
    },"json");
});


$("#tabla-calificacion-mala").html(function(){
    var funcion='calimala';
    var celda="";
    console.log(funcion);
    $("#tabla-calificacion-mala > tbody:last").children().remove();
    $.post('sistema/controladores/proyecto.php', {funcion: funcion}, function(result) {
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                buscarNatural(valor.cliente);
                buscarJuridico(valor.cliente);
                celda+="<td class='cli"+valor.cliente+"'></td>";
                celda+="<td>"+valor.codigo+"</td>";
                celda+="<td>"+valor.calificacion+"";

                celda+="<button id='btn"+valor.codigo+"' class='btn btn-link moreCM' value="+valor.codigo+">Ver más</button></td>";
                celda+="<td><span style='display: none;' class='textC"+valor.codigo+" bg-danger'>"+valor.comentario+"</span></td>";
                celda+="</tr>";
                $("#tabla-calificacion-mala >tbody").append(celda);
            });
            $(".moreCM").on("click",verComentario);
        }
    },"json");
});

function verComentario() {
    var codigo=$(this).val();
    if($("#btn"+codigo+"").text()!="Ver más"){
       $("#btn"+codigo+"").text('Ver más');
        $(".textC"+codigo+"").hide(); 
    }
        
    else{
        $("#btn"+codigo+"").text('Ver menos');  
        $(".textC"+codigo+"").show();
    }
}