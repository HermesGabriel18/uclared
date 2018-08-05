<?php 
require_once 'conexion.php';
class Especialidad extends Conexion{
	private $id;
	private $descripcion;
	private $estatus;

	public function __construct(){
		$this->conectar();
	}// fin del contructor
	
	public function set($atributo,$valor){
		$this->$atributo=$valor;
	}
	public function get($atributo){
		return $this->$atributo;
	}

	public function find(){
		$cadena="";
        $encontro=false;
        if($this->id!=""){
            $cadena="WHERE id='{$this->id}'";
        }
        $sql="SELECT id, descripcion, estatus FROM especialidades ".$cadena;
        if($c=$this->query($sql)){
             if($this->numero_de_filas($c)>0){
                $f=$c->fetch_assoc();
                $this->set("id",$f["id"]);
                $this->set("descripcion",$f["descripcion"]);
                $this->set("estatus",$f["estatus"]);
                $encontro=true;
             }
        }
        $this->liberar($c);
        $this->desconectar();
        return $encontro;
	}

    public function listar(){
        $post=array();
        $cadena="";
        $i=1;
        $this->id="NOT IN(1)";
        if($this->id!=""){
            $cadena="WHERE id {$this->id} ";
        }
        $sql="SELECT id, descripcion, estatus FROM especialidades WHERE estatus='{$this->estatus}' ORDER BY id ASC";
        //echo $sql;
        $this->conectar();
        if($query=$this->query($sql)){
            if($this->numero_de_filas($query)>0){
                while ($row=$query->fetch_assoc()) {
                    $post[]=array(
                        "idespecialidad"=>$row['id'],
                        "descripcion"=>utf8_encode($row['descripcion']),
                        "numero"=>$i++,
                    );
                }
            }
        }
        $this->liberar($query);
        $this->desconectar();
        return $post;
    }


}

 ?>