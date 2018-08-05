<?php 
require_once 'conexion.php';

class clienteJuridico extends Conexion{

    private $rif="";
    private $nombre="";

    private $persona="";
    private $nacionalidad="";
    private $ubicacion="";
    private $telefono="";
    private $correo="";

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

        if ($this->rif!=""){
            $cadena="rif='{$this->rif}'";
        }
        $this->conectar();
        
        $sql="SELECT rif, nombre, persona, nacionalidad, ubicacion, telefono, correo, estatus FROM clientes_juridicos WHERE ".$cadena;
        //echo $sql;
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                $f=$c->fetch_assoc();
                $this->set("rif",$f['rif']);
                $this->set("nombre",$f['nombre']);
                $this->set("persona",$f['persona']);
                $this->set("nacionalidad",$f['nacionalidad']);
                $this->set("ubicacion",$f['ubicacion']);
                $this->set("telefono",$f['telefono']);
                $this->set("correo",$f['correo']);
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
        $sql="INSERT INTO clientes_juridicos(rif, nombre, persona, nacionalidad, ubicacion, telefono, correo, estatus) VALUES('{$this->rif}','{$this->nombre}','{$this->persona}','{$this->nacionalidad}','{$this->ubicacion}','{$this->telefono}','{$this->correo}','{$this->estatus}')";

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
        $sql="UPDATE clientes_juridicos SET nombre='{$this->nombre}', persona='{$this->persona}', nacionalidad='{$this->nacionalidad}', ubicacion='{$this->ubicacion}', telefono='{$this->telefono}', correo='{$this->correo}', estatus='{$this->estatus}' WHERE rif='{$this->rif}'";
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
        $sql="DELETE FROM clientes_juridicos WHERE rif='{$this->rif}'";
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
        $sql="SELECT rif, c.nombre AS jnombre, persona, c.telefono AS jtelefono, c.estatus AS estatus, p.nombre AS nompersona, 
        p.apellido AS apepersona FROM clientes_juridicos c INNER JOIN personas p ON persona=cedula $cadena ORDER BY persona";
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
                            "jnombre"=>utf8_encode($row['jnombre']),
                            "jtelefono"=>utf8_encode($row['jtelefono']),
                            "nompersona"=>utf8_encode($row['nompersona']),
                            "apepersona"=>utf8_encode($row['apepersona']),
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

    public function cantJuridicos($estatus){
        $cuantos=0;
        $sql=$this->query("SELECT COUNT(*) FROM clientes_juridicos WHERE estatus $estatus");
        if($this->numero_de_filas($sql)>0){
            $f=$sql->fetch_row();
            $cuantos=$f[0];
        }
        return $cuantos;    
    }
}

 ?>