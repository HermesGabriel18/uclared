<?php 
require_once 'conexion.php';
class Mensaje extends Conexion{
    private $codigo;
	private $origen;
    private $asunto;
    private $contenido;
    private $fecha;
	private $estatus;

	public function __construct(){
	}// fin del contructor

	public function set($atributo, $valor){
        $this->$atributo=$valor;
    }
    public function get($atributo){
        return $this->$atributo;
    }

    public function find(){
        $encontro=false;
        $cadena="";

        if ($this->codigo!="") {
            $cadena=" codigo='{$this->codigo}' ";
        }
        $this->conectar();
        
        $sql="SELECT codigo, origen, asunto, contenido, fecha, estatus FROM mensajes WHERE ".$cadena;
        //echo $sql;
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                $f=$c->fetch_assoc();
                $this->set("codigo",$f['codigo']);
                $this->set("origen",$f['origen']);
                $this->set("asunto",$f['asunto']);
                $this->set("contenido",$f['contenido']);
                $this->set("fecha",$f['fecha']);
                $this->set("estatus",$f['estatus']);
                $encontro=true;
            }
        }
        $this->liberar($c);
        $this->desconectar();
        return $encontro;
        
    }

    public function add(){
        $inserto=false;
        $sql="INSERT INTO mensajes(origen, asunto, contenido, fecha, estatus) VALUES('{$this->origen}','{$this->asunto}','{$this->contenido}', CURTIME(),'{$this->estatus}')";

        $this->conectar();
        if($c=$this->query($sql)){
            if($this->ejecuto_query()>0){
                $inserto=true;  
            }
        }
        //$this->liberar($c);
        $this->desconectar();
        return $inserto;
    }

    public function listar(){
        $post=array();
        $cadena="";
        $i=1;
        if($this->estatus!=""){
            $cadena=" WHERE estatus {$this->estatus}";
        }
        $sql="SELECT codigo, origen, asunto, contenido, fecha, estatus FROM mensajes $cadena ORDER BY codigo";
        //echo $sql;
        $this->conectar();
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                while ($row=$c->fetch_assoc()) {
                    $estado="";
                    if($row['estatus']=="I")
                         $estado="Inactivo";
                    elseif($row['estatus']=="A")
                         $estado="Activo";
                    else $estado="Eliminado";
                    $post[]=array(
                            "codigo"=>$row['codigo'],
                            "origen"=>$row['origen'],
                            "asunto"=>$row['asunto'],
                            "contenido"=>$row['contenido'],
                            "fecha"=>$row['fecha'],
                            "estatus"=>$estado,
                            "numero"=>$i++,
                        );
                }
            }
        }
        $this->liberar($c);
        $this->desconectar();
        return $post;
    }


}

 ?>