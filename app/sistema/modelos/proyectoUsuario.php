<?php 
require_once 'conexion.php';

class proyectoUsuario extends Conexion{

  private $proyecto;
  private $usuario;
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
    $sql="INSERT INTO proyecto_usuario(proyecto, usuario, estatus) VALUES('{$this->proyecto}','{$this->usuario}','{$this->estatus}')";

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
        
        $sql="SELECT proyecto, usuario, estatus FROM proyecto_usuario WHERE ".$cadena;
        //echo $sql;
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                $f=$c->fetch_assoc();
                $this->set("proyecto",$f['proyecto']);
                $this->set("usuario",$f['usuario']);
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
            $cadena="WHERE proyecto = '{$this->proyecto}'";
            $sql="SELECT proyecto, usuario, estatus FROM proyecto_usuario ".$cadena;
        
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
                                "proyecto"=>$row['proyecto'],
                                "usuario"=>$row['usuario'],
                                "estatus"=>$estado,
                                "numero"=>$i++,
                            );
                    }
                }
            }
        }else if($this->usuario!=""){
            $cadena=" INNER JOIN proyectos p ON pu.proyecto = p.codigo INNER JOIN personas per ON p.responsable = per.cedula AND pu.usuario='{$this->usuario}' ";
            $sql="SELECT pu.proyecto AS proyecto, pu.usuario, p.estatus AS estatus, p.fecha_fin AS fecha_fin, p.responsable AS responsable, p.cliente AS cliente, per.nombre AS nombre, per.apellido AS apellido FROM proyecto_usuario pu ".$cadena;
        
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
                        else $estado="Cancelado";
                        $post[]=array(
                                "proyecto"=>$row['proyecto'],
                                "usuario"=>$row['usuario'],
                                "resp"=>$row['responsable'],
                                "nombre"=>$row['nombre'],
                                "apellido"=>$row['apellido'],
                                "cliente"=>$row['cliente'],
                                "ffin"=>$row['fecha_fin'],
                                "estatus"=>$estado,
                                "numero"=>$i++,
                            );
                    }
                }
            }
        }
        
        $this->liberar($c);
        $this->desconectar();
        return $post;
    }

    public function delete(){
        $elimino=false;
        $sql="DELETE FROM proyecto_usuario WHERE proyecto='{$this->proyecto}'";
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

}





 ?>