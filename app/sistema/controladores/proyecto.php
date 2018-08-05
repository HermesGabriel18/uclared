<?php session_start();
require'../modelos/proyecto.php';
require'../modelos/proyectoUsuario.php';
require'../modelos/servicio.php';
require'../modelos/proyectoServicio.php';

class controllerProyecto{
    private $proyecto;
    private $usuario;
    private $serv;
    private $servicio;


    public function __construct(){
        $this->proyecto=new Proyecto();
        $this->usuario=new proyectoUsuario();
        $this->serv=new Servicio();
        $this->servicio=new proyectoServicio();

    }// fin del contructor

    public function listar(){
        $tirajson=array();
        $estatus="";
        if($_SESSION['rol']==1){
            $estatus="IN('A','I','E')";
        }elseif($_SESSION['rol']==2){
            $estatus="IN('A','I','E')";
        }
        else{
            $estatus="IN('A')";
        }
        $this->proyecto->set("estatus", $estatus);
        $tirajson= $this->proyecto->listar();
        echo json_encode($tirajson);
    }

    public function listar2(){
        $tirajson=array();
        $cliente="";
        
        $this->proyecto->set("cliente", $_POST['cliente']);
        $tirajson= $this->proyecto->listar();
        echo json_encode($tirajson);
    }

    public function listar3(){
        $tirajson=array();
        $usuario="";
        
        $this->usuario->set("usuario", $_POST['usuario']);
        $tirajson= $this->usuario->listar();
        echo json_encode($tirajson);
    }

    public function listarbuena(){
        $tirajson=array();
        $tirajson= $this->proyecto->listarbuena();
        echo json_encode($tirajson);
    }

    public function listarmala(){
        $tirajson=array();
        $tirajson= $this->proyecto->listarmala();
        echo json_encode($tirajson);
    }

    public function agregarUsuarios(){

    	$usuarios=$_POST['usuariop'];
    	$totalusuarios=sizeof($usuarios);

    	$tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo completar el registro"}';
    	//foreach ($_POST['usuariop'] as $usuarios) {
        $this->usuario->set("proyecto",$_POST['codigo']);
        $this->usuario->set("usuario",$_POST['resp']);
        $this->usuario->set("estatus",'A');
        $this->usuario->add();
    	for($i=0; $i<$totalusuarios; $i++){

            if($usuarios[$i]!=$_POST['resp']){

        		$this->usuario->set("proyecto",$_POST['codigo']);
        		$this->usuario->set("usuario",$usuarios[$i]);
        		$this->usuario->set("estatus",'A');
        		if($this->usuario->add()){
        		$tirajson = '{"success": "true", "exito": "true", "mensaje": "Si se pudo completar el registro de usuarios asignados"}';
        		}
            }

    	}
    	//}
    	return $tirajson;
    	
    }

    public function agregarServicios(){

    	$servicios=$_POST['serviciop'];
    	$totalservicios=sizeof($servicios);

    	$tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo completar el registro"}';
    	//foreach ($_POST['usuariop'] as $usuarios) {
    	for($i=0; $i<$totalservicios; $i++){
    		$this->servicio->set("proyecto",$_POST['codigo']);
    		$this->servicio->set("servicio",$servicios[$i]);
    		$this->servicio->set("estatus",'A');
    		if($this->servicio->add()){
    		$tirajson = '{"success": "true", "exito": "true", "mensaje": "Si se pudo completar el registro de servicios asignados"}';
    		}
    	}
    	//}
    	return $tirajson;
    	
    }

    public function eliminarUsuarios(){

        $usuarios=$_POST['usuariop'];
        $totalusuarios=sizeof($usuarios);

        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';

        for($i=0; $i<$totalusuarios; $i++){
            $this->usuario->set("proyecto",$_POST['codigo']);
            if($this->usuario->find()){
                if($this->usuario->delete()){
                    //$this->borrarPerfil();
                    $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ usuario eliminado correctamente"}';  
                }else{
                    $tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se puede eliminar el registro"}';
                }
            }
        }
        return $tirajson;
    }

    public function eliminarServicios(){

        $servicios=$_POST['serviciop'];
        $totalservicios=sizeof($servicios);

        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';

        for($i=0; $i<$totalservicios; $i++){
            $this->servicio->set("proyecto",$_POST['codigo']);
            if($this->servicio->find()){
                if($this->servicio->delete()){
                    //$this->borrarPerfil();
                    $tirajson='{"success": "true", "exito": "true", "mensaje": "!Exito¡ servicio eliminado correctamente"}';  
                }else{
                    $tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se puede eliminar el registro"}';
                }
            }
        }
        return $tirajson;
    }

    public function buscarUsuarios(){
        $tirajson=array();
        $this->usuario->set("proyecto",$_POST['codigo']);
        $tirajson= $this->usuario->listar();
        echo json_encode($tirajson);
    }

    public function buscarServicios(){
        $tirajson=array();
        $this->servicio->set("proyecto",$_POST['codigo']);
        $tirajson= $this->servicio->listar();
        echo json_encode($tirajson);
    }

    public function buscarServiciosP(){
        $tirajson=array();
        $this->servicio->set("servicio",$_POST['servicio']);
        $tirajson= $this->servicio->listar();
        echo json_encode($tirajson);
    }

    public function finalizarServicio(){
        //$json=array();
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->servicio->set("proyecto",$_POST['proyecto']);
        $this->servicio->set("servicio",$_POST['servicio']);
        $this->servicio->set("estatus",'I');
        if($this->servicio->end()){
                $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ servicio finalizado correctamente"}';
                // $json[]=array(
                // "success"=>"true",
                // "exito"=>"true",
                // "mensaje"=>"!Exito¡ servicio finalizado correctamente");
            }else{
                $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo finalizar el servicio..."}';
                // $json[]=array(
                // "success"=>"true",
                // "exito"=>"false",
                // "mensaje"=>"!Uy¡ No se pudo finalizar el servicio...");

            }
            echo $tirajson;
            //echo json_encode($json);
    }

    public function calcularTotal(){
    	$servicios=$_POST['serviciop'];
    	$totalservicios=sizeof($servicios);

    	$acum=0;

    	for($i=0; $i<$totalservicios; $i++){
    		$this->serv->set("codigo",$servicios[$i]);
    		$this->serv->find();
    		$acum+=$this->serv->get("presupuesto");
    	}
    	return $acum+($acum*0.12);
    }

    public function agregar(){

        $max=0;
        
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';

        $servicios=$_POST['serviciop'];
        $totalservicios=sizeof($servicios);

        for($i=0; $i<$totalservicios; $i++){
            $this->serv->set("codigo",$servicios[$i]);
            if($this->serv->find()){
                if($this->serv->get("duracion")>$max){
                    $max=$this->serv->get("duracion");
                }
            }
        }

        $dateInicio=new DateTime($_POST['inicio']);
        $dateFin=new DateTime($_POST['fin']);

        $diff= $dateInicio->diff($dateFin);

        if($diff->days < $max){
            $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ La duración del proyecto no es suficiente para los servicios incluidos!"}';
        }else{

        


        $this->proyecto->set("codigo",$_POST['codigo']);
        $this->proyecto->set("responsable",$_POST['resp']);
        $this->proyecto->set("cliente",$_POST['cliente']);
        $this->proyecto->set("fechaInicio",$_POST['inicio']);
        $this->proyecto->set("fechaFin",$_POST['fin']);
        $this->proyecto->set("total",$this->calcularTotal());
        $this->proyecto->set("estatus",'A');
        if($this->proyecto->add()){
            $this->agregarUsuarios();
            $this->agregarServicios();
            $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ proyecto agregado correctamente"}';
        }else{
            $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo agregar el proyecto..."}';
        }
        }
        
        echo $tirajson;
    }

   public function buscar(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Datos no encontrados"}';
        $this->proyecto->set("codigo", $_POST['codigo']);
        if($this->proyecto->find()){
            //$this->buscarUsuarios();
            //$this->buscarServicios();

            $tirajson= '{"success": "true", "exito": "true",
            "codigo":"'.$this->proyecto->get("codigo").'",
            "responsable":"'.$this->proyecto->get("responsable").'",
            "cliente":"'.$this->proyecto->get("cliente").'",
            "fechaInicio":"'.$this->proyecto->get("fechaInicio").'",
            "fechaFin":"'.$this->proyecto->get("fechaFin").'",
            "fechaCreate": "'.$this->proyecto->get("fechaCreate").'",
            "total": "'.$this->proyecto->get("total").'",
            "calificacion": "'.$this->proyecto->get("calificacion").'",
            "comentario": "'.$this->proyecto->get("comentario").'",
            "estatus": "'.$this->proyecto->get("estatus").'"}';
        }
        echo $tirajson;
    }

    public function editar(){
        $tirajson='{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->proyecto->set("codigo",$_POST['codigo']);
        if($this->proyecto->find()){
            $this->proyecto->set("responsable",$_POST['resp']);
            $this->proyecto->set("fechaInicio",$_POST['inicio']);
            $this->proyecto->set("fechaFin",$_POST['fin']);
            $this->proyecto->set("total",$this->calcularTotal());
                $this->proyecto->editP();
                $this->eliminarUsuarios();
                $this->eliminarServicios();
                $this->agregarUsuarios();
                $this->agregarServicios();
                $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ proyecto actualizado correctamente"}';
        }
        echo $tirajson;
    }

    public function calcularProgreso(){
        $json='{"success": "false", "resultado": ""}';
        $this->proyecto->set("codigo", $_POST['codigo']);
        $this->proyecto->find();
        //$json=array();
        // $json[]=array("resultado"=>$this->proyecto->progreso($this->servicio->contarActivos($_POST['codigo']),$this->servicio->contarInactivos($_POST['codigo'])));
        //     echo json_encode($json);
            $json='{"success": "true", "resultado": '.$this->proyecto->progreso($this->servicio->contarActivos($_POST['codigo']),$this->servicio->contarInactivos($_POST['codigo'])).', "estatus": "'.$this->proyecto->get('estatus').'"}';
            echo $json;
    }

    public function agregarComentario(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
            $this->proyecto->set("codigo",$_POST['cocodigo']);
            $this->proyecto->set("calificacion",$_POST['cali']);
            $this->proyecto->set("comentario",$_POST['comen']);
            if($this->proyecto->edit()){
                $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ calificación agregada correctamente"}';
            }else{
                $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo enviar la información..."}';
            }
            echo $tirajson;
    }

    public function finalizarProyecto(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->proyecto->set("codigo",$_POST['codigo']);
        $this->proyecto->set("estatus",'I');
        if($this->proyecto->end()){
                $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ proyecto finalizado correctamente"}';
            }else{
                $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo finalizar el proyecto..."}';
            }
            echo $tirajson;
    }

    public function cancelarProyecto(){
        $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ Error de conexión"}';
        $this->proyecto->set("codigo",$_POST['codigo']);
        $this->proyecto->set("estatus",'E');
        if($this->proyecto->end()){
                $tirajson = '{"success": "true", "exito": "true", "mensaje": "!Exito¡ proyecto cancelado correctamente"}';
            }else{
                $tirajson = '{"success": "true", "exito": "false", "mensaje": "!Uy¡ No se pudo cancelar el proyecto..."}';
            }
            echo $tirajson;
    }
}


if(isset($_SESSION['usuario'])){
	//var_dump($_POST);

	//$usuarios =$_POST['usuariop'];
	//echo implode(",", $usuarios);

	// $servicios =$_POST['serviciop'];
	// echo implode(",", $servicios);

	// echo $_POST['usuariop'];
    $miproyecto = new controllerProyecto();
    if(isset($_POST)){
        switch ($_POST["funcion"]) {
            case 'add':
                $tirajson=$miproyecto->agregar();
                break;
            case 'load':
                $miproyecto->listar();
                break;
            case 'load2':
                $miproyecto->listar2();
                break;
            case 'loada':
                $miproyecto->listar3();
                break;
            case 'calibuena':
                $miproyecto->listarbuena();
                break;
            case 'calimala':
                $miproyecto->listarmala();
                break;
            case 'find':
                $miproyecto->buscar();
                break;
            case 'edit':
                $miproyecto->editar();
                break;
            case 'progress':
                $miproyecto->calcularProgreso();
                break;
            case 'findU':
                $miproyecto->buscarUsuarios();
                break;
            case 'findS':
                $miproyecto->buscarServicios();
                break;
            case 'findSP':
                $miproyecto->buscarServiciosP();
                break;
            case 'finServicio':
                $miproyecto->finalizarServicio();
                break;
            case 'addC':
                $miproyecto->agregarComentario();
                break;
            case 'finP':
                $miproyecto->finalizarProyecto();
                break;
            default:
                $miproyecto->cancelarProyecto();
                break;
        }
    }
}

?>