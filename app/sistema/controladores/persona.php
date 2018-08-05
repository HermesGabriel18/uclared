<?php session_start();
require'../modelos/persona.php';

// TODOS LOS MÉTODOS ENVIARÁN DATOS TIPO JSON A LOS CONTROLADORES
// DE JAVASCRIPT

class controllerPersona{
	private $persona;

	public function __construct()
	{
		$this->persona=new Persona();
	}

	public function set($atributo,$valor){
        $this->$atributo=$valor;
    }
    public function get($atributo){
        return $this->$atributo;
    }

    // MANDA A LEER LOS DATOS PERSONALES DE LA BASE DE DATOS
    public function listar(){
        $tirajson=array();
        $tirajson= $this->persona->listar();
        echo json_encode($tirajson);
    }

    // MANDA A AGREGAR LOS DATOS PERSONALES
	public function agregar(){
		$tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->persona->set("cedula",TRIM($_POST['ced']));
        // VERIFICA SI YA HAY UN REGISTRO CON ESA CÉDULA
        if($this->persona->find()){
            $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Ya existe alguien con esa cédula"}';
        }else{
    		$this->persona->set("nacionalidad",$_POST['nac']);
    		$this->persona->set("cedula",TRIM($_POST['ced']));
    		$this->persona->set("nombre",$_POST['nom']);
    		$this->persona->set("apellido",$_POST['ape']);
    		$this->persona->set("sexo",$_POST['sexo']);
    		$this->persona->set("edo_civil",$_POST['civil']);
    		$this->persona->set("telefono",$_POST['tel']);
    		$this->persona->set("celular",$_POST['cel']);
    		$this->persona->set("correo",$_POST['correo']);
    		$this->persona->set("direccion",$_POST['dir']);
    		$this->persona->set("estatus",'A');
    		if($this->persona->add()){
    			$tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ Persona agregada correctamente"}';
    		}
    		else{
    			$tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo agregar la persona..."}';
    		}
		
        }
        echo $tirajson;
    }

    // MANDA A BUSCAR LOS DATOS PERSONALES CON UNA CÉDULA Y OBTIENE DICHOS DATOS
	public function buscar(){
		$tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Datos no encontrados"}';
        $this->persona->set("cedula", $_POST['cedula']);
        if($this->persona->find()){
            $tirajson= '{"success": "true", "exito": "true",
            "nacionalidad":"'.$this->persona->get("nacionalidad").'",
            "cedula":"'.$this->persona->get("cedula").'",
            "nombre":"'.$this->persona->get("nombre").'",
            "apellido":"'.$this->persona->get("apellido").'",
            "sexo":"'.$this->persona->get("sexo").'",
            "civil":"'.$this->persona->get("edo_civil").'",
            "direccion":"'.$this->persona->get("direccion").'",
            "telefono": "'.$this->persona->get("telefono").'",
            "celular": "'.$this->persona->get("celular").'",
            "correo": "'.$this->persona->get("correo").'"}';
        }
        echo $tirajson;
	}

    // MANDA A MODIFICAR LOS DATOS PERSONALES
	public function editar(){
		$tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
		$this->persona->set("cedula",$_POST['ced']);
        // VERIFICA SI LO ENCONTRÓ
		if($this->persona->find()){
			$this->persona->set("nacionalidad",$_POST['nac']);
			$this->persona->set("cedula",TRIM($_POST['ced']));
			$this->persona->set("nombre",$_POST['nom']);
			$this->persona->set("apellido",$_POST['ape']);
			$this->persona->set("sexo",$_POST['sexo']);
			$this->persona->set("edo_civil",$_POST['civil']);
			$this->persona->set("telefono",TRIM($_POST['tel']));
			$this->persona->set("celular",TRIM($_POST['cel']));
			$this->persona->set("correo",TRIM($_POST['correo']));
			$this->persona->set("direccion",$_POST['dir']);
			if($this->persona->edit()){
				$tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ datos actualizados correctamente"}';
			}else{
				$tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo actualizar los datos"}';
			}
		}
		echo $tirajson;
	}

    //MANDA A BORRAR LOS DATOS PERSONALES
	public function borrar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->persona->set("cedula",$_POST['cedula']);
        // VERIFICA SI LO ENCONTRÓ
        if($this->persona->find()){
            // MANDA A BORRARLO
            if($this->persona->delete()){
                $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ persona eliminada correctamente"}';  
            }else{
                $tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se puede eliminar el registro"}';
            }
        }
        echo $tirajson;
    }

}//FIN DE LA CLASE CONTROLADOR


// ENLAZADOR CON EL CONTROLADOR DE JAVASCRIPT
// LOS CONTROLADORES JAVASCRIPT ESTÁN CONSTANTEMENTE ENVIANDO VARIABLES GLOBALES
// ESTE ENLAZADOR LOS EVALÚA PARA LUEGO LLAMAR A CIERTOS MÉTODOS
if(isset($_SESSION['usuario'])){
    $mipersona = new controllerPersona();
    if($_POST){
    //if(isset($_POST)){
        switch ($_POST['funcion']) {
            case 'add':
                $tirajson=$mipersona->agregar();
                break;
            case 'find':
                $mipersona->buscar();
                break;
            case 'edit':
            	$tirajson=$mipersona->editar();
            	break;
            default:
                $mipersona->borrar();
                break;
        }
    }
}

?>