<?php session_start();
require_once('../UploadHelper/src/class.upload.php');
require'../modelos/servicio.php';
function validaImagen($extension){
	 switch($extension){
        case 'jpg': case 'gif': case 'png': case 'jpeg':
            return true;
        break;
        default:
            return false;
        break;
    }
}
function subirImagen(&$src){
    $guardo=false;
    $servicio= new Servicio();
    $nombre=$_SESSION['persona'];
    if(isset($_FILES['imagen'])&& !empty($_FILES['imagen'])){
        $ext=explode(".", $_FILES['imagen']['name']);
        if(validaImagen($ext[1])){
            $imagen= new Upload($_FILES['imagen']);
            $imagen->file_new_name_body=$nombre;
            $imagen->image_resize = true;
            $imagen->image_convert = 'jpg';
            $imagen->image_x = 300;
            $imagen->image_ratio_y = true;
            $imagen->Process('../img/service/');
            if($servicio->get("imagen")!=""||$servicio->get("imagen")!=NULL){
            	if($servicio->get("imagen")!="default.png"){
            		unlink('../img/service/'.$servicio->get("imagen"));	
            	}
            }
            if($imagen->processed){
                $servicio->set("imagen", $imagen->file_dst_name);
                $src=$imagen->file_dst_name;
                //$servicio->edit();
                //$servicio->add();
                $imagen->Clean();
                $guardo=true;
            }   
        }
    }
    return $guardo;
}
if(isset($_SESSION['usuario'])){
	if(isset($_FILES['imagen'])){
		$ruta="";
		if(subirImagen($ruta)){
		    $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exitó¡","sources":"'.$ruta.'"}';
		}else $tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error..." }';
	}else $tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ Foto no cargada..." }';
	echo $tirajson;
}
?>