<?php 
require_once 'conexion.php';

class proyectoServicio extends Conexion{

  private $proyecto;
  private $servicio;
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
    $sql="INSERT INTO proyecto_servicio(proyecto, servicio, estatus) VALUES('{$this->proyecto}','{$this->servicio}','{$this->estatus}')";

    //echo $sql;
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

  public function find(){
        $encontro=false;
        $cadena="";

        if ($this->proyecto!="") {
            $cadena=" proyecto='{$this->proyecto}'";
        }
        $this->conectar();
        
        $sql="SELECT proyecto, servicio, estatus FROM proyecto_servicio WHERE ".$cadena;
        //echo $sql;
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                $f=$c->fetch_assoc();
                $this->set("proyecto",$f['proyecto']);
                $this->set("servicio",$f['servicio']);
                $this->set("estatus",$f['estatus']);
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
        if($this->proyecto!=""){
            $cadena="proyecto = '{$this->proyecto}'";
        }else if($this->servicio!=""){
            $cadena="servicio = '{$this->servicio}'";
        }
        $sql="SELECT proyecto, servicio, estatus FROM proyecto_servicio WHERE ".$cadena;
        //echo $sql;
        $this->conectar();
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                while ($row=$c->fetch_assoc()) {
                    $estado="";
                    if($row['estatus']=="I")
                         $estado="Finalizado";
                    elseif($row['estatus']=="A")
                         $estado="Activo";
                    $post[]=array(
                            "proyecto"=>$row['proyecto'],
                            "servicio"=>$row['servicio'],
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

    public function delete(){
        $elimino=false;
        $sql="DELETE FROM proyecto_servicio WHERE proyecto='{$this->proyecto}' AND estatus='A'";
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

    public function end(){
        $modifico= false;
        $sql="UPDATE proyecto_servicio SET estatus='{$this->estatus}' WHERE proyecto='{$this->proyecto}' AND servicio='{$this->servicio}'";
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

    public function contarActivos($codigo){
        $cuantos=0;
        $this->conectar();
        $sql=$this->query("SELECT COUNT(*) FROM proyecto_servicio WHERE estatus='A' AND proyecto = '{$codigo}'");
        if($this->numero_de_filas($sql)>0){
            $f=$sql->fetch_row();
            $cuantos=$f[0];
        }
        return $cuantos;    
    }

    public function contarInactivos($codigo){
        $cuantos=0;
        $this->conectar();
        $sql=$this->query("SELECT COUNT(*) FROM proyecto_servicio WHERE estatus='I' AND proyecto = '{$codigo}'");
        if($this->numero_de_filas($sql)>0){
            $f=$sql->fetch_row();
            $cuantos=$f[0];
        }
        return $cuantos;    
    }

}





 ?>