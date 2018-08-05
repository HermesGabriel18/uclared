<?php 
require_once 'conexion.php';
class pruebas extends Conexion{
	private $nombre;
	private $edad;
	private $estatus;

	public function __construct(){
	}// fin del contructor

	public function set($atributo, $valor){
        $this->$atributo=$valor;
    }
    public function get($atributo){
        return $this->$atributo;
    }

    public function add(){
    	$inserto=false;
		$sql="INSERT INTO pruebas(nombre, edad, estatus) VALUES('{$this->nombre}','{$this->edad}','{$this->estatus}')";

		$this->conectar();
        if($c=$this->query($sql)){
           	if($this->ejecuto_query()>0){
               	$inserto=true;  
           	}
       	}
        $this->desconectar();
        return $inserto;
    }
}

 ?>