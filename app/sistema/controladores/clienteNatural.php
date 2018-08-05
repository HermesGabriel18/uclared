<?php session_start();
require'../modelos/clienteNatural.php';
require'../modelos/persona.php';

// TODOS LOS MÉTODOS ENVIARÁN DATOS TIPO JSON A LOS CONTROLADORES
// DE JAVASCRIPT

class controllerClienteN{
    private $cliente;
    private $persona;

    public function __construct(){
        $this->cliente=new clienteNatural();
        $this->persona=new Persona();
    }// fin del contructor

    // MANDA A LEER LOS CLIENTES DE LA BASE DE DATOS

    public function listar(){
        $tirajson=array();
        $estatus="";
        if($_SESSION['rol']==1){
            $estatus="IN('A','I')";
        }elseif($_SESSION['rol']==2){
            $estatus="IN('A')";
        }
        $this->cliente->set("estatus", $estatus);
        $tirajson= $this->cliente->listar();
        echo json_encode($tirajson);
    }

    // MANDA A AGREGAR LOS DATOS PERSONALES DEL CLIENTE
    // (AL MODELO DE PERSONA)
    public function agregarPersona(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->persona->set("nacionalidad",$_POST['nac']);
        $this->persona->set("cedula",TRIM($_POST['persona']));
        $this->persona->set("nombre",$_POST['nombre']);
        $this->persona->set("apellido",$_POST['apellido']);
        $this->persona->set("sexo",$_POST['sexo']);
        $this->persona->set("edo_civil",$_POST['civil']);
        $this->persona->set("telefono",TRIM($_POST['telefono']));
        $this->persona->set("celular",TRIM($_POST['celular']));
        $this->persona->set("correo",TRIM($_POST['correo']));
        $this->persona->set("direccion",$_POST['direccion']);
        $this->persona->set("estatus",'A');
        if($this->persona->add()){
            $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ Persona agregada correctamente"}';
        }
        else{
            $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo agregar la persona..."}';
        }
        return $tirajson;
    }

    // MANDA A MODIFICAR LOS DATOS PERSONALES
    // (AL MODELO PERSONA)
    public function actualizarPersona(){
         $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
         $this->persona->set("cedula",TRIM($_POST['persona']));
         // MANDA A BUSCARLO PARA OBTENER TODOS SUS DATOS
         if($this->persona->find()){
            $this->persona->set("nacionalidad",$_POST['nac']);
            $this->persona->set("cedula",TRIM($_POST['persona']));
            $this->persona->set("nombre",$_POST['nombre']);
            $this->persona->set("apellido",$_POST['apellido']);
            $this->persona->set("sexo",$_POST['sexo']);
            $this->persona->set("edo_civil",$_POST['civil']);
            $this->persona->set("telefono",TRIM($_POST['telefono']));
            $this->persona->set("celular",TRIM($_POST['celular']));
            $this->persona->set("correo",TRIM($_POST['correo']));
            $this->persona->set("direccion",$_POST['direccion']);
            if($this->persona->edit()){
                $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ datos actualizados correctamente"}';
            }else{
                $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo actualizar los datos"}';
            }
        }
        return $tirajson;
    }

    // MANDA A AGREGAR EL CLIENTE NATURAL
    public function agregar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
            $this->persona->set("cedula",$_POST['persona']);
            // VERFIFICA SI YA SE ENCUENTRA REGISTRADO EL CLIENTE
            if($this->persona->find()){
                $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Ya hay alguien con esos datos"}';
            }else{
            $this->cliente->set("persona",TRIM($_POST['persona']));
            $this->cliente->set("rif",TRIM($_POST['rif']));
            $this->cliente->set("estatus",'A');
            if($this->cliente->add()){
                // LLAMA AL MÉTODO QUE LUEGO MANDARÁ A AGREGAR DATOS PERSONALES
                $this->agregarPersona();
                $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ cliente agregado correctamente"}';
            }else{
                $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo agregar el cliente..."}';
            }
        }
        echo $tirajson;
    }

    // MANDA A BUSCAR LOS DATOS DEL CLIENTE CON SU CÉDULA Y OBTIENE DICHOS DATOS
    public function buscar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Datos no encontrados"}';
        $this->cliente->set("persona", $_POST['cedula']);
        // VERFIFICA SI LO ENCUENTRÓ
        if($this->cliente->find()){
            $tirajson= '{"success": "true", "exito": "true",
            "persona":"'.$this->cliente->get("persona").'",
            "rif":"'.$this->cliente->get("rif").'",
            "estatus": "'.$this->cliente->get("estatus").'"}';
        }
        echo $tirajson;
    }


    // MANDA A MODIFICAR LOS DATOS DEL CLIENTE
    public function editar(){
        $tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->cliente->set("persona",TRIM($_POST['persona']));
        // VERFIFICA SI LO ENCUENTRÓ
        if($this->cliente->find()){
            $this->cliente->set("rif",TRIM($_POST['rif']));
            $this->cliente->edit();
            // LLAMA AL MÉTODO QUE LUEGO MANDARÁ A ACTUALIZAR DATOS PERSONALES
            $this->actualizarPersona();
            $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ datos actualizados correctamente"}';
        }
        echo $tirajson;
    }

    // MANDA A ELIMINAR UN REGISTRO DE CLIENTES
    public function borrar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->cliente->set("persona",TRIM($_POST['cedula']));
        // VERFIFICA SI LO ENCUENTRA
        if($this->cliente->find()){
            // MANDA A BORRARLO
            if($this->cliente->delete()){
                $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ cliente eliminado correctamente"}';  
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
    $micliente = new controllerClienteN();
    if(isset($_POST)){
        switch ($_POST['funcion']) {
            case 'add':
                $tirajson=$micliente->agregar();
                break;
            case 'load':
                $micliente->listar();
                break;
            case 'find':
                $micliente->buscar();
                break;
            case 'edit':
                $tirajson=$micliente->editar();
                break;
            default:
                $micliente->borrar();
                break;
        }
    }
}

?>