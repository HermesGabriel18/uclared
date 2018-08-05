<?php session_start();
require_once('../UploadHelper/src/class.upload.php');
require'../modelos/usuario.php';
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
    $usuario= new Usuario();
    $nombre=$_SESSION['persona'];
    $usuario->set("persona",$_SESSION['persona']);
    $usuario->find();
    if(isset($_FILES['imagen'])&& !empty($_FILES['imagen'])){
        $ext=explode(".", $_FILES['imagen']['name']);
        if(validaImagen($ext[1])){
            $imagen= new Upload($_FILES['imagen']);
            $imagen->file_new_name_body=$nombre;
            $imagen->image_resize = true;
            $imagen->image_convert = 'jpg';
            $imagen->image_x = 160;
            $imagen->image_ratio_y = true;
            $imagen->Process('../img/user/');
            if($usuario->get("imagen")!=""||$usuario->get("imagen")!=NULL){
            	if($usuario->get("imagen")!="user-160x160.jpg"){
            		unlink('../img/user/'.$usuario->get("imagen"));	
            	}
            }
            if($imagen->processed){
                $usuario->set("imagen", $imagen->file_dst_name);
                $src=$imagen->file_dst_name;
                $usuario->edit();
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