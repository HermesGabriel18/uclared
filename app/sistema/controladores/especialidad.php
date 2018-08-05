<?php session_start();
require'../modelos/especialidad.php';

// TODOS LOS MÉTODOS ENVIARÁN DATOS TIPO JSON A LOS CONTROLADORES
// DE JAVASCRIPT

class controllerEspecialidad{
    private $especialidad;

    public function __construct(){
        $this->especialidad=new Especialidad();
    }// fin del contructor
    
    // MANDA A LEER LAS ESPECIALIDADES REGISTRADAS
    public function listar(){
        $tirajson=array();
        $this->especialidad->set("estatus","A");
        $tirajson= $this->especialidad->listar();
        echo json_encode($tirajson);
    }
}//FIN DE LA CLASE CONTROLADOR

// ENLAZADOR CON EL CONTROLADOR DE JAVASCRIPT
// LOS CONTROLADORES JAVASCRIPT ESTÁN CONSTANTEMENTE ENVIANDO VARIABLES GLOBALES
// ESTE ENLAZADOR LOS EVALÚA PARA LUEGO LLAMAR A CIERTOS MÉTODOS
if(isset($_SESSION['usuario'])){
    $miespecialidad= new controllerEspecialidad();
    if(isset($_POST)){
        switch ($_POST['funcion']){
            case "list":
                $miespecialidad->listar();
            break;
        }//end switch
    }
}
?>