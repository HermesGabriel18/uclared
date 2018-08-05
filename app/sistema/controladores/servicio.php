<?php session_start();
require'../modelos/servicio.php';

class controllerServicio{
    private $servicio;

    public function __construct(){
        $this->servicio=new Servicio();
    }// fin del contructor


    public function listar(){
        $tirajson=array();
        $estatus="";
        if($_SESSION['rol']==1){
            $estatus="IN('A','I')";
        }elseif($_SESSION['rol']==2){
            $estatus="IN('A')";
        }
        $this->servicio->set("estatus", $estatus);
        $tirajson= $this->servicio->listar();
        echo json_encode($tirajson);
    }

    public function agregar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
            $this->servicio->set("descripcion",$_POST['descripcion']);
            $this->servicio->set("imagen",$_POST['imagen']);
            $this->servicio->set("observacion",$_POST['observacion']);
            $this->servicio->set("duracion",$_POST['duracion']);
            $this->servicio->set("presupuesto",$_POST['presupuesto']);
            $this->servicio->set("estatus",'A');
            if($this->servicio->add()){
                $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ servicio agregado correctamente"}';
            }else{
                $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo agregar el servicio..."}';
            }
        echo $tirajson;
    }

    public function buscar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Datos no encontrados"}';
        $this->servicio->set("codigo", $_POST['codigo']);
        if($this->servicio->find()){
            $tirajson= '{"success": "true", "exito": "true",
            "codigo":"'.$this->servicio->get("codigo").'",
            "descripcion":"'.$this->servicio->get("descripcion").'",
            "imagen":"'.$this->servicio->get("imagen").'",
            "observacion":"'.$this->servicio->get("observacion").'",
            "duracion":"'.$this->servicio->get("duracion").'",
            "presupuesto":"'.$this->servicio->get("presupuesto").'",
            "estatus":"'.$this->servicio->get("estatus").'"}';
        }
        echo $tirajson;
    }

    public function editar(){
        $tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->servicio->set("codigo",TRIM($_POST['codigo']));
        if($this->servicio->find()){
            $this->servicio->set("descripcion",$_POST['descripcion']);
            $this->servicio->set("imagen",$_POST['imagen']);
            $this->servicio->set("observacion",$_POST['observacion']);
            $this->servicio->set("duracion",$_POST['duracion']);
            $this->servicio->set("presupuesto",$_POST['presupuesto']);
            $this->servicio->set("estatus",$_POST['estatus']);
            $this->servicio->edit();
                $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ datos actualizados correctamente"}';
               
        }
        echo $tirajson;
    }

    public function borrar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->servicio->set("codigo",TRIM($_POST['codigo']));
        if($this->servicio->find()){
            if($this->servicio->delete()){
                $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ servicio eliminado correctamente"}';  
            }else{
                $tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se puede eliminar el registro"}';
            }
        }
        echo $tirajson;
    }

}


if(isset($_SESSION['usuario'])){
    $miservicio = new controllerServicio();
    if(isset($_POST)){
        switch ($_POST['funcion']) {
            case 'add':
                $tirajson=$miservicio->agregar();
                break;
            case 'load':
                $miservicio->listar();
                break;
            case 'find':
                $miservicio->buscar();
                break;
            case 'edit':
                $tirajson=$miservicio->editar();
                break;
            default:
                $miservicio->borrar();
                break;
        }
    }
}

?>