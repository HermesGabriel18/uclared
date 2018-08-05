<?php 
require_once 'conexion.php';

class Proyecto extends Conexion{

	private $codigo;//AUTO_INCREMENT
	private $responsable;//PERSONA->USUARIO
	private $cliente;//PERSONA O RIF->CLIENTE
    private $fechaInicio;
    private $fechaFin;
    private $fechaCreate;
	private $total;//SUM(SERVICIOS)
	private $estatus;//ACTIVO POR DEFECTO

    private $calificacion;
    private $comentario;

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
            $cadena=" codigo='{$this->codigo}'";
        }
        $this->conectar();
        
        $sql="SELECT codigo, responsable, cliente, fecha_inicio, fecha_fin, fecha_create, total, calificacion, comentario, estatus FROM proyectos WHERE ".$cadena;
        //echo $sql;
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                $f=$c->fetch_assoc();
                $this->set("codigo",$f['codigo']);
                $this->set("responsable",$f['responsable']);
                $this->set("cliente",$f['cliente']);
                $this->set("fechaInicio",$f['fecha_inicio']);
                $this->set("fechaFin",$f['fecha_fin']);
                $this->set("fechaCreate",$f['fecha_create']);
                $this->set("total",$f['total']);
                $this->set("calificacion",$f['calificacion']);
                $this->set("comentario",$f['comentario']);
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
		$sql="INSERT INTO proyectos(codigo, responsable, cliente, fecha_inicio, fecha_fin, fecha_create, total, estatus) VALUES('{$this->codigo}','{$this->responsable}','{$this->cliente}','{$this->fechaInicio}','{$this->fechaFin}',CURTIME(),'{$this->total}','{$this->estatus}')";

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

  public function listar(){
        $post=array();
        $cadena="";
        $i=1;
        if($this->estatus!=""){
            $cadena=" pro.estatus {$this->estatus}";
        }else if($this->cliente!=""){
            $cadena=" pro.cliente = {$this->cliente}";
        }
        $sql="SELECT codigo, responsable, nombre, apellido, cliente, fecha_inicio, fecha_fin, fecha_create, total, pro.estatus AS estatus 
        FROM proyectos pro INNER JOIN personas ON responsable = cedula 
        AND $cadena ORDER BY fecha_create";
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
                            "codigo"=>$row['codigo'],
                            "responsable"=>$row['responsable'],
                            "nombre"=>$row['nombre'],
                            "apellido"=>$row['apellido'],
                            "cliente"=>$row['cliente'],
                            "finicio"=>$row['fecha_inicio'],
                            "ffin"=>$row['fecha_fin'],
                            "fcreate"=>$row['fecha_create'],
                            "total"=>$row['total'],
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

    public function listarbuena(){
        $post=array();
        $i=1;

        $sql="SELECT codigo, cliente, comentario, calificacion, c.descripcion AS nomcali FROM proyectos p INNER JOIN calificaciones c ON p.calificacion = c.id AND calificacion IN(4,5)";
        //echo $sql;
        $this->conectar();
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                while ($row=$c->fetch_assoc()) {
                    $post[]=array(
                            "codigo"=>$row['codigo'],
                            "cliente"=>$row['cliente'],
                            "calificacion"=>$row['nomcali'],
                            "comentario"=>$row['comentario'],
                            "numero"=>$i++,
                        );
                }
            }
        }
        $this->liberar($c);
        $this->desconectar();
        return $post;
    }

    public function listarmala(){
        $post=array();
        $i=1;

        $sql="SELECT codigo, cliente, comentario, calificacion, c.descripcion AS nomcali FROM proyectos p INNER JOIN calificaciones c ON p.calificacion = c.id AND calificacion IN(1,2)";
        //echo $sql;
        $this->conectar();
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                while ($row=$c->fetch_assoc()) {
                    $post[]=array(
                            "codigo"=>$row['codigo'],
                            "cliente"=>$row['cliente'],
                            "calificacion"=>$row['nomcali'],
                            "comentario"=>$row['comentario'],
                            "numero"=>$i++,
                        );
                }
            }
        }
        $this->liberar($c);
        $this->desconectar();
        return $post;
    }

    public function editP(){
        $modifico= false;
        $sql="UPDATE proyectos SET responsable='{$this->responsable}', fecha_inicio='{$this->fechaInicio}', fecha_fin='{$this->fechaFin}', total='{$this->total}' WHERE codigo='{$this->codigo}'";
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

    public function edit(){
        $modifico= false;
        $sql="UPDATE proyectos SET calificacion='{$this->calificacion}', comentario='{$this->comentario}' WHERE codigo='{$this->codigo}'";
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

    public function end(){
        $modifico= false;
        $sql="UPDATE proyectos SET estatus='{$this->estatus}' WHERE codigo='{$this->codigo}'";
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

    public function progreso($activos, $inactivos){
        return ($inactivos*100)/($activos+$inactivos);   
    }

    public function contar($cali){
        $cuantos=0;
        $this->conectar();
        $sql=$this->query("SELECT COUNT(*) FROM proyectos WHERE calificacion IN({$cali})");
        if($this->numero_de_filas($sql)>0){
            $f=$sql->fetch_row();
            $cuantos=$f[0];
        }
        return $cuantos; 
    }

    public function porc($cali){
        $cuantos=0;
        $this->conectar();
        $sql=$this->query("SELECT COUNT(*) FROM proyectos WHERE calificacion IS NOT NULL");
        if($this->numero_de_filas($sql)>0){
            $f=$sql->fetch_row();
            $cuantos=$f[0];
        }
        return ($this->contar($cali)*100)/$cuantos; 
    }

    public function contarTodos($estatus){
        $cuantos=0;
        $this->conectar();
        if($estatus!="todosj" && $estatus!="todosn"){
        $sql=$this->query("SELECT COUNT(*) FROM proyectos WHERE estatus IN({$estatus})");
        }else if($estatus=="todosj"){
           //$sql=$this->query("SELECT COUNT(*) FROM proyectos");
           $sql=$this->query("SELECT COUNT(*) FROM proyectos p INNER JOIN clientes_juridicos cj ON p.cliente=cj.rif"); 
        }
        else{
            $sql=$this->query("SELECT COUNT(*) FROM proyectos p INNER JOIN clientes_naturales cn ON p.cliente=cn.persona"); 
        }
        //echo $sql;
        if($this->numero_de_filas($sql)>0){
            $f=$sql->fetch_row();
            $cuantos=$f[0];
        }
        return $cuantos; 
    }


}





 ?>