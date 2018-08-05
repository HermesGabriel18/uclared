$("#servicior").html(function(){
    var funcion="load";
    var idservicio=0;
    var nombreservicio=0;
    $("#servicior").empty();
    $("#servicior").append("<option value=''>Seleccione...</option>");
    $.post("sistema/controladores/servicio.php",{funcion:funcion},function(data){
        console.log(data);
        if(!jQuery.isEmptyObject(data) && $.isArray(data)){
            $.each(data, function(index, valor){
                
                    idservicio=valor.codigo;
                    nombreservicio=valor.descripcion; 

                    $("#servicior").append("<option value='"+valor.codigo+"'>"+valor.descripcion+"</option>");
            
            });
        }
    },"json");
});

$("#mostrarsp").click(function(event) {
    var funcion='findSP';
    var servicio=$("#servicior").val();
    var celda="";
    console.log(funcion);

    $("#tabla-servicio-reporte > tbody:last").children().remove();
    $.post('sistema/controladores/proyecto.php', {funcion: funcion, servicio: servicio}, function(result) {
        //console.log(funcion);
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td><div id="+valor.proyecto+">Código: ";
                celda+="<button class='btn btn-link verelproyecto'>"+valor.proyecto+"</button>";
                celda+="</div></td>";
                if(valor.estatus == "Finalizado"){
                    celda+="<td><span class='label label-danger'>"+valor.estatus+"</span></td>";
                }else if(valor.estatus == "Activo"){
                    celda+="<td><span class='label label-info'>"+valor.estatus+"</span></td>";
                }                    
                celda+="</tr>";
                $("#tabla-servicio-reporte >tbody").append(celda);
            });
        }

        $(".verelproyecto").click(function(event) {
            linkURL('sistema/vistas/proyectoConsulta.php');
        });

    },"json");
})

