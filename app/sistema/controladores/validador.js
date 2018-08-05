//JQUERY GESTION DE USUARIO
var funcion;
var etiqueta;
$("[data-mask]").inputmask();

$('input').keypress(function(e){
    if(e.which == 13){
      return false;
    }
});
$('textarea').keypress(function(e){
    if(e.which == 13){
      return false;
    }
});
$(".collap").click(function(){
    id=$(this).parent("div").attr("id");
    $("#box-body-"+id).toggle("slow");
});
$(".remov").click(function(){
    id=$(this).parent("div").attr("id");
    $("#box-"+id).hide("slow");
});

$(".valida-ajuste").keyup(function(){
	if($(this).val()>4){
		$(this).val("");
	}else{
		$(this).next('input').focus();
	}
});

$(".migas-de-pan").on("click",migasDePan);

//valida numeros y que no acepte ctrl V
$(".valida-num-restriccion").keydown(function(e){
	tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) return true;
    patron = /\d/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
});
$(".valida-numero").keydown(validaNumero);
$(".valida-decimal").keydown(function(){
    $(this).numeric(".");
});//fin de valida-decimales

$(".valida-texto").blur(validaTexto);
$(".valida-blancos").keydown(function(event){
    if(event.keyCode != 32){
        return true;
    }else return false;
});//fin de valida-sin-blancos
$(".valida-charesp").bind("keyup", function(event){
	var characterReg = /[`~!@$%^&*()_°¬|+\=?;:'"<>\{\}\[\]\\\/]/gi;
	var inputVal = $(this).val();
	if(characterReg.test(inputVal)) {			
		$(this).val(inputVal.replace(/[`~!@$%^&*()_|+\=?;:'"<>\{\}\[\]\\\/]/gi,''));
	}
});

$(".valida-sms").bind("keyup", function(event){
	var characterReg = /[`~!$%^&()°¬|+\=?;:'´áéíóúÁÉÍÓÚÑñ"<>\{\}\[\]\\\/]/gi;
	var inputVal = $(this).val();
	if(characterReg.test(inputVal)) {			
		$(this).val(inputVal.replace(/[`~!$%^&()|+\=?;:'´áéíóúÁÉÍÓÚÑñ"<>\{\}\[\]\\\/]/gi,''));
	}
});

$(".valida-telefono").blur(validaTelefono);
$(".valida-celular").blur(validaCelular);
$(".valida-telcel").blur(validaTelCel);
$(".valida-email").blur(validaEmail);


function validaTexto(){
	var chares=$(this).val();
	var id =$(this).attr("id");
	var text_label=$("label[for='"+id+"']").text();
	//var regex =/[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/;
	var regex=/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/;
	if($(this).val()!=''){
		if (regex.test(chares.trim())) {
			$("label[for='"+id+"']").html("<i class='fa fa-check'></i> "+text_label);
			$("#div-"+id).removeClass("has-error").addClass("has-success");
			return true;
		}else {
			$(this).val("");
			$("label[for='"+id+"']").html("<i class='fa fa-times-circle-o'></i> "+text_label);
			$("#div-"+id).removeClass("has-success").addClass("has-error");
			return false;
		}
	}
}

function validaTelefono(){
	var id=$(this).attr("id");
	var numero=$(this).val();
	var codigo=numero.substring(0, 6);
	var digitos=numero.substring(7, 15);
	if(numero!=""){
		if(numero.length==15 && digitos!="___-____" && digitos.indexOf("_")==-1){
			if(codigo=="(0251)"){
				$("label[for='"+id+"']").html("<i class='fa fa-check'></i> Teléfono");
				$("#div-"+id).removeClass("has-error").addClass("has-success");
				$("#bad-tel").hide();
				return true;    
			}else{
				$(this).val("");
				$("label[for='"+id+"']").html("<i class='fa fa-times-circle-o'></i> Teléfono invalido");
				$("#div-"+id).addClass("has-error");
				$("#bad-tel").show();
				return false;
			}
			return true;
		}else{
			$(this).val("");
			$("label[for='"+id+"']").html("<i class='fa fa-times-circle-o'></i> Teléfono invalido");
			$("#div-"+id).addClass("has-error");
			$("#bad-tel").show();
			return false;
		}
	}
}

function validaCelular(){
	var id=$(this).attr("id");
	var numero=$(this).val();
	var codigo=numero.substring(0, 6);
	var digitos=numero.substring(7, 15);
	if(numero!=""){
		if(numero.length==15 && digitos!="___-____" && digitos.indexOf("_")==-1){
			if(codigo=="(0416)"||codigo=="(0426)"||codigo=="(0414)"||codigo=="(0424)"||codigo=="(0412)"){
				$("label[for='"+id+"']").html("<i class='fa fa-check'></i> Celular");
				$("#div-"+id).removeClass("has-error").addClass("has-success");
				$("#bad-cel").hide();
				return true;    
			}else{
				$(this).val("");
				$("label[for='"+id+"']").html("<i class='fa fa-times-circle-o'></i> Celular invalido");
				$("#div-"+id).addClass("has-error");
				$("#bad-cel").show();
				return false;
			}
		}else{
			$(this).val("");
			$("label[for='"+id+"']").html("<i class='fa fa-times-circle-o'></i> Celular invalido");
			$("#div-"+id).addClass("has-error");
			$("#bad-cel").show();
			return false;
		}
	}else{
		$(this).val("");
		$("label[for='"+id+"']").html("<i class='fa fa-times-circle-o'></i> Celular invalido");
		$("#div-"+id).addClass("has-error");
		return false;
	}
}

function validaTelCel(){
	var id=$(this).attr("id");
	var numero=$(this).val();
	var codigo=numero.substring(0, 6);
	var digitos=numero.substring(7, 15);
	var text_label=$("label[for='"+id+"']").text();
	if(numero!=""){
		if(numero.length==15 && digitos!="___-____" && digitos.indexOf("_")==-1){
			if(codigo=="(0416)"||codigo=="(0426)"||codigo=="(0414)"||codigo=="(0424)"||codigo=="(0412)" ||codigo=="(0251)"){
				$("label[for='"+id+"']").html("<i class='fa fa-check'></i> "+text_label);
				$("#div-"+id).removeClass("has-error").addClass("has-success");
				return true;    
			}else{
				$(this).val("");
				$("label[for='"+id+"']").html("<i class='fa fa-times-circle-o'></i> "+text_label);
				$("#div-"+id).addClass("has-error");
				return false;
			}
		}else{
			$(this).val("");
			$("label[for='"+id+"']").html("<i class='fa fa-times-circle-o'></i> "+text_label);
			$("#div-"+id).addClass("has-error");
			return false;
		}
	}
}

function validaEmail(){
	var chares=$(this).val();
	var id =$(this).attr("id");
	var text_label=$("label[for='"+id+"']").text();
	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	if($(this).val()!=''){
		if (regex.test(chares.trim())) {
			$("label[for='"+id+"']").html("<i class='fa fa-check'></i> "+text_label);
			$("#div-"+id).removeClass("has-error").addClass("has-success");
			$("#bad-email").hide();
			return true;
		}else {
			$(this).val("");
			$("label[for='"+id+"']").html("<i class='fa fa-times-circle-o'></i> Correo no valido");
			$("#div-"+id).removeClass("has-success").addClass("has-error");
			$("#bad-email").show();
			return false;
		}
	}
}
function validaNumero(){
    $(this).numeric();
}


function migasDePan(){
	var pagina=$(this).attr("id");
    linkURL(pagina);
}

function linkURL(pagina){
	$("body, html").animate({scrollTop: $("#sistema").offset().top-100},200);//fin de animate
    $("#sistema").html('<div class="content"><div style="margin: 200px 300px;"><img src="dist/img/loading.gif"/></div></div>');
    $.ajax({
        type: "POST",
	    url: pagina,
        success: function(contenido) {
            $("#sistema").fadeIn('fast');
            $('#sistema').fadeIn(1000).html(contenido);
        }//fin de success
    });//fin de ajax
    return false;
}