<?php session_start();
require'../modelos/rol.php';
class controllerPerfil{
    private $perfil;

    public function __construct(){
        $this->perfil=new Rol();
    }// fin del contructor
    
    public function listar(){
        $tirajson=array();
        $this->perfil->set("estatus","A");
        $tirajson= $this->perfil->listar();
        echo json_encode($tirajson);
    }
}

if(isset($_SESSION['usuario'])){
    $miperfil= new controllerPerfil();
    if(isset($_POST)){
        switch ($_POST['funcion']){
            case "list":
                $miperfil->listar();
            break;
        }//end switch
    }
}
?>