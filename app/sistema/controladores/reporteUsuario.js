$("#tabla-reporte-usuario-t").html(function(){
	var funcion='load';
	var celda="";
	console.log(funcion);
	$("#tabla-reporte-usuario-t > tbody:last").children().remove();
	$.post('sistema/controladores/usuario.php', {funcion: funcion}, function(result) {
		if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td>"+valor.persona+"</td>";
                celda+="<td>"+valor.nompersona+" "+valor.apepersona+"</td>";
                celda+="<td>"+valor.nomperfil+"</td>";
                celda+="<td>"+valor.correopersona+"</td>";
                celda+="<td>"+valor.celpersona+"</td>";
                celda+="<td>"+valor.user+"</td>";
                celda+="<td>"+valor.estatus+"</td>";

                $("#tabla-reporte-usuario-t >tbody").append(celda);
            });
        }
	},"json");
});

$("#tabla-reporte-usuario-m").html(function(){
    var funcion='load';
    var celda="";
    console.log(funcion);
    $("#tabla-reporte-usuario-m > tbody:last").children().remove();
    $.post('sistema/controladores/usuario.php', {funcion: funcion}, function(result) {
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td>"+valor.persona+"</td>";
                celda+="<td>"+valor.nompersona+" "+valor.apepersona+"</td>";
                celda+="<td>"+valor.nomperfil+"</td>";
                celda+="<td>"+valor.correopersona+"</td>";
                celda+="<td>"+valor.celpersona+"</td>";
                celda+="<td>"+valor.user+"</td>";
                celda+="<td>"+valor.estatus+"</td>";

                if(valor.nomperfil=="Manager")
                    $("#tabla-reporte-usuario-m >tbody").append(celda);

            });
        }
    },"json");
});

$("#tabla-reporte-usuario-a").html(function(){
    var funcion='load';
    var celda="";
    console.log(funcion);
    $("#tabla-reporte-usuario-a > tbody:last").children().remove();
    $.post('sistema/controladores/usuario.php', {funcion: funcion}, function(result) {
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td>"+valor.persona+"</td>";
                celda+="<td>"+valor.nompersona+" "+valor.apepersona+"</td>";
                celda+="<td>"+valor.nomperfil+"</td>";
                celda+="<td>"+valor.correopersona+"</td>";
                celda+="<td>"+valor.celpersona+"</td>";
                celda+="<td>"+valor.user+"</td>";
                celda+="<td>"+valor.estatus+"</td>";

                if(valor.nomperfil=="Administrador")
                    $("#tabla-reporte-usuario-a >tbody").append(celda);

            });
        }
    },"json");
});

$("#tabla-reporte-usuario-p").html(function(){
    var funcion='load';
    var celda="";
    console.log(funcion);
    $("#tabla-reporte-usuario-p > tbody:last").children().remove();
    $.post('sistema/controladores/usuario.php', {funcion: funcion}, function(result) {
        if(!jQuery.isEmptyObject(result) && $.isArray(result)){
            $.each(result, function(index,valor){
                celda="<tr>";
                celda+="<td>"+valor.persona+"</td>";
                celda+="<td>"+valor.nompersona+" "+valor.apepersona+"</td>";
                celda+="<td>"+valor.nomperfil+"</td>";
                celda+="<td>"+valor.correopersona+"</td>";
                celda+="<td>"+valor.celpersona+"</td>";
                celda+="<td>"+valor.user+"</td>";
                celda+="<td>"+valor.estatus+"</td>";

                if(valor.nomperfil=="Staff")
                    $("#tabla-reporte-usuario-p >tbody").append(celda);

            });
        }
    },"json");
});

$('input[type=radio][name=usu]').change(function() {
        if (this.value == '1') {
            $("#usuario-manager").hide();
            $("#usuario-administrador").hide();
            $("#usuario-participante").hide();
            $("#usuario-todos").show('fast');
        }
        else if (this.value == '2') {
            $("#usuario-todos").hide();
            $("#usuario-administrador").hide();
            $("#usuario-participante").hide();
            $("#usuario-manager").show('fast');
        }
        else if (this.value == '3') {
            $("#usuario-todos").hide();
            $("#usuario-manager").hide();
            $("#usuario-participante").hide();
            $("#usuario-administrador").show('fast');
        }
        else if (this.value == '4') {
            $("#usuario-todos").hide();
            $("#usuario-administrador").hide();
            $("#usuario-manager").hide();
            $("#usuario-participante").show('fast');
        }
});