<?php 
require_once 'conexion.php';

class clienteNatural extends Conexion{

	private $persona="";
	private $rif="";
	private $estatus="";
	
	public function __construct(){
		$this->conectar();

	}//fin del constructor

	public function set($atributo, $valor){
        $this->$atributo=$valor;
    }
    public function get($atributo){
        return $this->$atributo;
    }

    public function find(){
    	$encontro=false;
        $cadena="";

        if ($this->persona!=""){
            $cadena="persona='{$this->persona}'";
        }
        $this->conectar();
        
        $sql="SELECT persona, rif, estatus FROM clientes_naturales WHERE ".$cadena;
        //echo $sql;
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                $f=$c->fetch_assoc();
                $this->set("persona",$f['persona']);
                $this->set("rif",$f['rif']);
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
        $sql="INSERT INTO clientes_naturales(persona, rif, estatus) VALUES('{$this->persona}','{$this->rif}','{$this->estatus}')";

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

    public function edit(){
        $modifico= false;
        $sql="UPDATE clientes_naturales SET rif='{$this->rif}' WHERE persona='{$this->persona}'";
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
        $sql="DELETE FROM clientes_naturales WHERE persona='{$this->persona}'";
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

    public function listar(){
        $post=array();
        $cadena="";
        $i=1;
        if($this->estatus!=""){
            $cadena=" AND c.estatus {$this->estatus}";
        }
        $sql="SELECT persona, rif, celular, c.estatus AS estatus, p.nombre AS nompersona, 
        p.apellido AS apepersona, correo FROM clientes_naturales c INNER JOIN personas p ON persona=cedula $cadena ORDER BY persona";
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
                            "persona"=>$row['persona'],
                            "rif"=>$row['rif'],
                            "nompersona"=>utf8_encode($row['nompersona']),
                            "apepersona"=>utf8_encode($row['apepersona']),
                            "celular"=>$row['celular'],
                            "correo"=>$row['correo'],
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

    public function cantNaturales($estatus){
        $cuantos=0;
        $sql=$this->query("SELECT COUNT(*) FROM clientes_naturales WHERE estatus $estatus");
        if($this->numero_de_filas($sql)>0){
            $f=$sql->fetch_row();
            $cuantos=$f[0];
        }
        return $cuantos;    
    }
}

 ?>