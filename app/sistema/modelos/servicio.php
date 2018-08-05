<?php 
require_once 'conexion.php';

class Servicio extends Conexion{

	private $codigo="";
	private $descripcion="";
	private $imagen="";
	private $observacion="";
	private $presupuesto ="";
    private $duracion ="";
	private $estatus="";

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
    		$cadena="codigo='{$this->codigo}'";
    	}
    	$this->conectar();
    	
        $sql="SELECT codigo, descripcion, imagen, observacion, presupuesto, duracion, estatus FROM servicios WHERE ".$cadena;
        //echo $sql;
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                $f=$c->fetch_assoc();
                $this->set("codigo",$f['codigo']);
                $this->set("descripcion",$f['descripcion']);
                $this->set("imagen",$f['imagen']);
                $this->set("observacion",$f['observacion']);
                $this->set("presupuesto",$f['presupuesto']);
                $this->set("duracion",$f['duracion']);
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
		$sql="INSERT INTO servicios(descripcion, imagen, observacion, duracion, presupuesto, estatus) VALUES('{$this->descripcion}','{$this->imagen}','{$this->observacion}','{$this->duracion}','{$this->presupuesto}','{$this->estatus}')";

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
        $sql="SELECT codigo, descripcion, imagen, observacion, presupuesto, duracion, estatus FROM servicios $cadena ORDER BY codigo";
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
                            "descripcion"=>$row['descripcion'],
                            "imagen"=>$row['imagen'],
                            "observacion"=>$row['observacion'],
                            "presupuesto"=>$row['presupuesto'],
                            "duracion"=>$row['duracion'],
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

    public function edit(){
        $modifico= false;
        $sql="UPDATE servicios SET descripcion='{$this->descripcion}', imagen='{$this->imagen}' , observacion='{$this->observacion}', duracion='{$this->duracion}', presupuesto='{$this->presupuesto}', estatus='{$this->estatus}' WHERE codigo='{$this->codigo}'";
        //echo $sql;
        $this->conectar();
        if($this->query($sql)){
            if($this->ejecuto_query()>0){
                $modifico=true;
            }   
        }
        //$this->liberar($c);
        $this->desconectar();
        return $modifico;
    }

     public function delete(){
        $elimino=false;
        $sql="DELETE FROM servicios WHERE codigo='{$this->codigo}'";
        //echo $sql;
        $this->conectar();
        if($this->query($sql)){
            if($this->ejecuto_query()>0){
                $elimino=true;
            }   
        }
        //$this->liberar($c);
        $this->desconectar();
        return $elimino;
    }

    public function cantServicios($estatus){
        $cuantos=0;
        $sql=$this->query("SELECT COUNT(*) FROM servicios WHERE estatus='$estatus'");
        if($this->numero_de_filas($sql)>0){
            $f=$sql->fetch_row();
            $cuantos=$f[0];
        }
        return $cuantos;    
    }

    public function contar(){
        $cuantos=0;
        $this->conectar();
        $sql=$this->query("SELECT COUNT(*) FROM servicios s INNER JOIN proyecto_servicio ps ON s.codigo = ps.servicio");
        if($this->numero_de_filas($sql)>0){
            $f=$sql->fetch_row();
            $cuantos=$f[0];
        }
        return $cuantos; 
    }

}


 ?>
