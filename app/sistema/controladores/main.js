//JQUERY MAIN
$(document).on("ready",main);
function main(){
    $(".pag-sesion").on("click",linkeo);
    $(".cerrar-sesion").on("click",cerrarSesion);
}

// CIERRA LA SESIÓN
function cerrarSesion(){
    // ENVÍA LA SOLICITUD A UN CONTROLADOR
    $.post('sistema/inicio/cerrar.php',function(resul){
        // VALIDA EL ENVÍO DE DATOS
        if(resul=='si'){
            url = "../index.html"; 
            // REDIRECCIONA AL INICIO 
            $(location).attr('href',url);
        }
    });
}

// CARGA LAS PÁGINAS ENCIMA DEL INDEX
function linkeo(){
    var pagina=$(this).attr("id");
    // CARGA GIF DE CARGA
    $("body, html").animate({scrollTop: $("#sistema").offset().top-100},200);//fin de animate
    $("#sistema").html('<div class="content"><div style="margin: 200px 400px;"><img src="dist/img/loading.gif"/></div></div>');
    $.ajax({
        type: "GET",
	    url: pagina,
        success: function(contenido) {
            // SOBREPONE LA PÁGINA SOLICITADA
            $("#sistema").fadeIn('fast');
            $('#sistema').fadeIn(1000).html(contenido);
        }//fin de success
    });//fin de ajax
    return false;
}