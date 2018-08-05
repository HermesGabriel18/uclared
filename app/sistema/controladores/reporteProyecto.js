$("#clientenr").html(function(){
    var funcion="load";
    var idcliente=0;
    var nombrecliente=0;
    $("#clientenr").empty();
    $("#clientenr").append("<option value=''>Seleccione...</option>");
    $.post("sistema/controladores/clienteNatural.php",{funcion:funcion},function(data){
        console.log(data);
        if(!jQuery.isEmptyObject(data) && $.isArray(data)){
            $.each(data, function(index, valor){
                
                    idcliente=valor.persona;
                    nombrecliente=valor.nompersona+" "+valor.apepersona; 

                    $("#clientenr").append("<option value='"+idcliente+"'>"+nombrecliente+"</option>");
            
            });
        }
    },"json");
});

$("#clientejr").html(function(){
    var funcion="load";
    var idcliente=0;
    var nombrecliente=0;
    $("#clientejr").empty();
    $("#clientejr").append("<option value=''>Seleccione...</option>");
    $.post("sistema/controladores/clienteJuridico.php",{funcion:funcion},function(data){
        console.log(data);
        if(!jQuery.isEmptyObject(data) && $.isArray(data)){
            $.each(data, function(index, valor){
                
                    idcliente=valor.rif;
                    nombrecliente=valor.jnombre; 

                    $("#clientejr").append("<option value='"+idcliente+"'>"+nombrecliente+"</option>");
            
            });
        }
    },"json");
});

$("#mostrarcnp").click(function(event) {
    var funcion='load2';
    var cliente=$("#clientenr").val();
    var celda="";
    console.log(funcion);

    $("#tabla-clienten-reporte > tbody:last").children().remove();
    $.post('sistema/controladores/proyecto.php', {funcion: funcion, cliente: cliente}, function(result) {
        //console.log(funcion);
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td><div id="+valor.codigo+">Código: ";
                celda+="<button class='btn btn-link verelproyecto'>"+valor.codigo+"</button>";
                celda+="</div></td>";
                celda+="<td>"+valor.total+"</td>";
                if(valor.estatus == "Finalizado"){
                    celda+="<td><span class='label label-danger'>"+valor.estatus+"</span></td>";
                }else if(valor.estatus == "Activo"){
                    celda+="<td><span class='label label-info'>"+valor.estatus+"</span></td>";
                }                    
                celda+="</tr>";
                $("#tabla-clienten-reporte >tbody").append(celda);
            });
        }
        $(".verelproyecto").click(function(event) {
            linkURL('sistema/vistas/proyectoConsulta.php');
        });
    },"json");
});

$("#mostrarcjp").click(function(event) {
    var funcion='load2';
    var cliente=$("#clientejr").val();
    var celda="";
    console.log(funcion);

    $("#tabla-clientej-reporte > tbody:last").children().remove();
    $.post('sistema/controladores/proyecto.php', {funcion: funcion, cliente: cliente}, function(result) {
        //console.log(funcion);
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td><div id="+valor.codigo+">Código: ";
                celda+="<button class='btn btn-link verelproyecto'>"+valor.codigo+"</button>";
                celda+="</div></td>";
                celda+="<td>"+valor.total+"</td>";
                if(valor.estatus == "Finalizado"){
                    celda+="<td><span class='label label-danger'>"+valor.estatus+"</span></td>";
                }else if(valor.estatus == "Cancelado"){
                    celda+="<td><span class='label label-warning'>"+valor.estatus+"</span></td>";
                }else if(valor.estatus == "Activo"){
                    celda+="<td><span class='label label-info'>"+valor.estatus+"</span></td>";
                }                    
                celda+="</tr>";
                $("#tabla-clientej-reporte >tbody").append(celda);
            });
        }
        $(".verelproyecto").click(function(event) {
            linkURL('sistema/vistas/proyectoConsulta.php');
        });
    },"json");
});

$("#tabla-activos").html(function() {
    var funcion='load';
    $("#tabla-activos > tbody:last").children().remove();
    $.post('sistema/controladores/proyecto.php', {funcion: funcion}, function(result) {
        //console.log(funcion);
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td><div id="+valor.codigo+">";
                celda+="<button class='btn btn-link verelproyecto'>"+valor.codigo+"</button>";
                celda+="</div></td>";
                celda+="<td>"+valor.nombre+" "+valor.apellido+"</td>";

                buscarNatural(valor.cliente);
                buscarJuridico(valor.cliente);
                celda+="<td class='cli"+valor.cliente+"'></td>";
                celda+="<td>"+valor.total+"</td>";                   
                celda+="</tr>";
                if(valor.estatus=="Activo")
                    $("#tabla-activos >tbody").append(celda);
            });
        }
        $(".verelproyecto").click(function(event) {
            linkURL('sistema/vistas/proyectoConsulta.php');
        });
    },"json");
});

$("#tabla-cancelados").html(function() {
    var funcion='load';
    $("#tabla-activos > tbody:last").children().remove();
    $.post('sistema/controladores/proyecto.php', {funcion: funcion}, function(result) {
        //console.log(funcion);
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td><div id="+valor.codigo+">";
                celda+="<button class='btn btn-link verelproyecto'>"+valor.codigo+"</button>";
                celda+="</div></td>";
                celda+="<td>"+valor.nombre+" "+valor.apellido+"</td>";
        
                buscarNatural(valor.cliente);
                buscarJuridico(valor.cliente);
                celda+="<td class='cli"+valor.cliente+"'></td>";
                celda+="<td>"+valor.total+"</td>";                   
                celda+="</tr>";
                if(valor.estatus=="Cancelado")
                    $("#tabla-cancelados >tbody").append(celda);
            });
        }
        $(".verelproyecto").click(function(event) {
            linkURL('sistema/vistas/proyectoConsulta.php');
        });
    },"json");
});

$("#tabla-finalizados").html(function() {
    var funcion='load';
    $("#tabla-activos > tbody:last").children().remove();
    $.post('sistema/controladores/proyecto.php', {funcion: funcion}, function(result) {
        //console.log(funcion);
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td><div id="+valor.codigo+">";
                celda+="<button class='btn btn-link verelproyecto'>"+valor.codigo+"</button>";
                celda+="</div></td>";
                celda+="<td>"+valor.nombre+" "+valor.apellido+"</td>";
        
                buscarNatural(valor.cliente);
                buscarJuridico(valor.cliente);
                celda+="<td class='cli"+valor.cliente+"'></td>";
                celda+="<td>"+valor.total+"</td>";                   
                celda+="</tr>";
                if(valor.estatus=="Finalizado")
                    $("#tabla-finalizados >tbody").append(celda);
            });
        }
        $(".verelproyecto").click(function(event) {
            linkURL('sistema/vistas/proyectoConsulta.php');
        });
    },"json");
});