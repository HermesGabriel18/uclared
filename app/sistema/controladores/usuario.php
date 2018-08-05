<?php session_start();
require'../modelos/usuario.php';
require'../modelos/persona.php';
require'../modelos/usuarioRol.php';
require'../modelos/especialidad.php';

class controllerUsuario{
    private $usuario;
    private $persona;
    private $perfil;

    public function __construct(){
        $this->usuario=new Usuario();
        $this->persona=new Persona();
        $this->perfil= new usuarioRol();
        $this->especialidad=new Especialidad();
    }// fin del contructor


    public function listar(){
        $tirajson=array();
        $estatus="";
        if($_SESSION['rol']==1){
            $estatus="IN('A','I')";
        }elseif($_SESSION['rol']==2){
            $estatus="IN('A')";
        }
        $this->usuario->set("estatus", $estatus);
        $tirajson= $this->usuario->listar();
        echo json_encode($tirajson);
    }

    public function agregarPerfil(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo completar el registro"}';
        //if(isset($_POST['usuario'], $_POST['perfil'])){
        $this->perfil->set("usuario",TRIM($_POST['usuario']));
            //if($this->perfil->find()){
        $this->perfil->set("rol",TRIM($_POST['perfil']));
                //$tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ perfil agregado correctamente"}';
            //}else{
                //$this->perfil->set("rol", TRIM($_POST['perfil']));
        $this->perfil->set("estatus",'A');
        if($this->perfil->add()){
            $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ Perfil agregado correctamente"}';
               //}
        }else{
            $tirajson = '{"success": "true", "exito": "false", "mensaje": "¡Uy! No se pudo agregar el perfil"}';
            }
        // }else{
        // $tirajson='{"success: "true", "exito": "false", "mensaje": "error"}';
        // }
        return $tirajson;
    }

    public function actualizarPerfil(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo actualizar el registro"}';
            $this->perfil->set("usuario",TRIM($_POST['old']));
            $this->perfil->set("rol",TRIM($_POST['oldperfil']));
            $this->perfil->find();
                $this->perfil->set("oldusuario",TRIM($_POST['old']));
                $this->perfil->set("oldperfil",TRIM($_POST['oldperfil']));
                $this->perfil->set("usuario",TRIM($_POST['usuario']));
                $this->perfil->set("rol",TRIM($_POST['perfil']));
                $this->perfil->set("estatus",$_POST['estatus']);
                if($this->perfil->edit()){
                    $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ datos actualizados correctamente supuestamente edito"}';    
                }else{
                    $tirajson = '{"success": "true", "exito": "false", "mensaje": "No se actualizo el perfil no se edito"}';
                }
            // }else{
            //     $this->perfil->set("usuario",TRIM($_POST['usuario']));
            //     $this->perfil->set("rol",TRIM($_POST['perfil']));
            //     $this->perfil->set("estatus",'A');
            //     if($this->perfil->add())
            //         $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ datos actualizados correctamente no encontro"}';
            // }
        return $tirajson;
    }

    public function agregar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        //if(isset($_POST['usuario'], $_POST['clave'])){
            $this->usuario->set("user",TRIM($_POST['usuario']));
            $this->usuario->set("persona",TRIM($_POST['usuario']));
            $this->usuario->set("pass",TRIM($_POST['clave']));
            $this->usuario->set("especialidad",TRIM($_POST['especialidad']));
            $this->usuario->set("imagen",'user-160x160.jpg');
            $this->usuario->set("estatus",'A');
            if($this->usuario->add()){
                $this->agregarPerfil();
                $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ usuario agregado correctamente"}';
            }else{
                $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo agregar el usuario..."}';
            }
        echo $tirajson;
    }

    public function buscar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Datos no encontrados"}';
        $this->usuario->set("persona", $_POST['cedula']);
        if($this->usuario->find()){
            $this->especialidad->set('id',$this->usuario->get("especialidad"));
            $this->especialidad->find();
            $this->perfil->set("usuario", $this->usuario->get("user"));
            $this->perfil->find();

            $tirajson= '{"success": "true", "exito": "true",
            "user":"'.$this->usuario->get("user").'",
            "pass":"'.$this->usuario->get("pass").'",
            "persona":"'.$this->usuario->get("persona").'",
            "imagen":"'.$this->usuario->get("imagen").'",
            "estatus":"'.$this->usuario->get("estatus").'",
            "especialidad":"'.$this->especialidad->get("id").'",
            "nomespecialidad":"'.$this->especialidad->get("descripcion").'",
            "perfil": "'.$this->perfil->get("rol").'",
            "desperfil": "'.$this->perfil->get("descripcion").'"}';
        }
        echo $tirajson;
    }

    public function editar(){
        $tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->usuario->set("user",TRIM($_POST['old']));
        $this->usuario->set("persona",TRIM($_POST['persona']));
        if($this->usuario->find()){
            $this->usuario->set("user",TRIM($_POST['usuario']));
            $this->usuario->set("pass",TRIM($_POST['clave']));
            $this->usuario->set("especialidad",TRIM($_POST['especialidad']));
            $this->usuario->set("imagen",$_POST['imagen']);
            $this->usuario->set("estatus",$_POST['estatus']);
            //$this->usuario->set("oldusuario",TRIM($_POST['old']));
                //if($this->usuario->edit()){
                    $this->usuario->edit();
                    $this->actualizarPerfil();
                    $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ datos actualizados correctamente"}';
                // }else{
                //     $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo actualizar los datos"}';
                // }
        }
        echo $tirajson;
    }

    public function borrar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->usuario->set("persona",TRIM($_POST['cedula']));
        if($this->usuario->find()){
            if($this->usuario->delete()){
                //$this->borrarPerfil();
                $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ usuario eliminado correctamente"}';  
            }else{
                $tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se puede eliminar el registro"}';
            }
        }
        echo $tirajson;
    }
   
}

if(isset($_SESSION['usuario'])){
    $miusuario = new controllerUsuario();
    if(isset($_POST)){
        switch ($_POST['funcion']) {
            case 'add':
                $tirajson=$miusuario->agregar();
                break;
            case 'load':
                $miusuario->listar();
                break;
            case 'find':
                $miusuario->buscar();
                break;
            case 'edit':
                $tirajson=$miusuario->editar();
                break;
            default:
                $miusuario->borrar();
                break;
        }
    }
}

?>