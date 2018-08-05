<?php session_start();
require'../modelos/mensaje.php';

// TODOS LOS MÉTODOS ENVIARÁN DATOS TIPO JSON A LOS CONTROLADORES
// DE JAVASCRIPT

class controllerMensaje{

	private $mensaje;

	public function __construct(){
        $this->mensaje=new Mensaje();
    }// fin del contructor

    // MANDA A LEER LOS MENSAJES DE LA BASE DE DATOS
    public function listar(){
        $tirajson=array();
        $estatus="";
        if($_SESSION['rol']==1){
            $estatus="IN('A','I')";
        }elseif($_SESSION['rol']==2){
            $estatus="IN('A')";
        }
        $this->mensaje->set("estatus", $estatus);
        $tirajson= $this->mensaje->listar();
        echo json_encode($tirajson);
    }

    // MANDA A AGREGAR EL MENSAJE
	public function agregar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
            $this->mensaje->set("origen",$_POST['origen']);
            $this->mensaje->set("asunto",$_POST['asunto']);
            $this->mensaje->set("contenido",$_POST['contenido']);
            $this->mensaje->set("estatus",'A');
            if($this->mensaje->add()){
                $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ mensaje enviado correctamente"}';
            }else{
                $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo enviar el mensaje..."}';
            }
        echo $tirajson;
    }

    // MANDA A BUSCAR LOS DATOS DEL MENSAJE CON SU CÓDIGO Y OBTIENE DICHOS DATOS
    public function buscar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Datos no encontrados"}';
        $this->mensaje->set("codigo", $_POST['codigo']);
        // VERFIFICA SI LO ENCUENTRÓ
        if($this->mensaje->find()){
            $tirajson= '{"success": "true", "exito": "true",
            "codigo":"'.$this->mensaje->get("codigo").'",
            "origen":"'.$this->mensaje->get("origen").'",
            "asunto":"'.$this->mensaje->get("asunto").'",
            "contenido":"'.$this->mensaje->get("contenido").'",
            "fecha":"'.$this->mensaje->get("fecha").'",
            "estatus": "'.$this->mensaje->get("estatus").'"}';
        }
        echo $tirajson;
    }

    // MANDA A AGREGAR EL MENSAJE RECIBIDO DEL FORMULARIO DE RECUPERAR CONTRASEÑA
    public function resetear(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
            $this->mensaje->set("origen",$_POST['cedula']);
            $this->mensaje->set("asunto","Recuperar contraseña");
            $this->mensaje->set("contenido","Especialidad: "+$_POST['especialidad']+", Nueva contraseña: "+$_POST['newpassword']);
            $this->mensaje->set("estatus",'A');
            if($this->mensaje->add()){
                $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ mensaje enviado correctamente"}';
            }else{
                $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo enviar el mensaje..."}';
            }
        echo $tirajson;
    }

}//FIN DE LA CLASE CONTROLADOR

// ENLAZADOR CON EL CONTROLADOR DE JAVASCRIPT
// LOS CONTROLADORES JAVASCRIPT ESTÁN CONSTANTEMENTE ENVIANDO VARIABLES GLOBALES
// ESTE ENLAZADOR LOS EVALÚA PARA LUEGO LLAMAR A CIERTOS MÉTODOS
$mimensaje = new controllerMensaje();
if(isset($_POST)){
    switch ($_POST['funcion']) {
        case 'add':
            $tirajson=$mimensaje->agregar();
            break;
        case 'load':
            $mimensaje->listar();
            break;
         case 'reset':
            $mimensaje->resetear();
            break;
        default:
            $mimensaje->buscar();
            break;
    }
}

?>