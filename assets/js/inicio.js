$(".valida-blancos").keydown(function(event){
    if(event.keyCode != 32){
        return true;
    }else return false;
});//fin de valida-sin-blancos


// ENVIA EL FORMULARIO PARA INICIAR SESIÓN
$("#fInicio").submit(function(){
    if(valida()){
      var usuario = $("#user").val();
      var password = $("#pass").val();
      // ENVÍA LA INFORMACIÓN AL CONTROLADOR 'ABRIR.PHP'
      $.post('app/sistema/inicio/abrir.php', {usu:usuario,pass:password}, function(resul) {

        // EVALÚA SI LOS DATOS FUERON ENVIADOS CORRECTAMENTE
       	if(resul.exito=='true'){
          console.log('mensajeexito');
       		alertify.success(resul.msg); 
            $("#msg-box").fadeTo(900,0.1,function(){
                $(this).fadeTo(900,1,function(){
                    $(location).attr('href',resul.url);
                });//fin de cambio de mensaje
            });//fin de fadeTo 
            // ENVIA UN MENSAJE INDICANDO ERROR EN LA TRANSFERENCIA DE DATOS
       	}else{
             alertify.error(resul.msg); 
             }
       },"json");
   }
   return false;
});

// VALIDA QUE LOS CAMPOS DE USUARIO Y CONTRASEÑA NO ESTÉN EN BLANCO
function valida(){
    if($("#user").val()==""){
        alertify.error("* Escribe tu usuario."); 
        return false;
    }else if($("#pass").val()==""){
        alertify.error("* Escribe tu clave."); 
        return false;
    }else return true;
}