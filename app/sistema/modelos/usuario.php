<?php 
require_once 'conexion.php';
class Usuario extends Conexion{
	private $user;
	private $pass;
    private $persona;
    private $imagen;
	private $estatus;

    private $especialidad;

    //private $oldusuario;

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

    	if ($this->user!="") {
            if($this->persona!=""){
                $cadena=" persona='{$this->persona}' AND user='{$this->user}'";
            }else
    		$cadena="user='{$this->user}'";
    	}elseif($this->persona!=""){
            $cadena=" persona='{$this->persona}' ";
        }
    	$this->conectar();
    	
        $sql="SELECT user, password, persona, especialidad, imagen, estatus FROM usuarios WHERE ".$cadena;
        //echo $sql;
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                $f=$c->fetch_assoc();
                $this->set("user",$f['user']);
                $this->set("pass",$f['password']);
                $this->set("persona",$f['persona']);
                $this->set("especialidad",$f['especialidad']);
                $this->set("imagen",$f['imagen']);
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
		$sql="INSERT INTO usuarios(user, password, persona, especialidad, imagen, estatus) VALUES('{$this->user}','{$this->pass}','{$this->persona}','{$this->especialidad}','{$this->imagen}','{$this->estatus}')";

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
            $cadena=" AND u.estatus {$this->estatus}";
        }
        $sql="SELECT user, password, persona, especialidad, imagen, u.estatus AS estatus, p.nombre AS nompersona, 
        p.apellido AS apepersona, rol, r.descripcion AS nomperfil, p.celular AS celpersona, p.correo AS correopersona, e.descripcion AS nomespecialidad
        FROM usuarios u INNER JOIN personas p ON persona=cedula 
        INNER JOIN usuario_rol ON user=usuario 
        INNER JOIN especialidades e ON especialidad=e.id
        INNER JOIN roles r ON rol=r.id $cadena ORDER BY persona";
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
                            "user"=>$row['user'],
                            "pass"=>$row['password'],
                            "persona"=>$row['persona'],
                            "imagen"=>$row['imagen'],
                            "nompersona"=>utf8_encode($row['nompersona']),
                            "apepersona"=>utf8_encode($row['apepersona']),
                            "idperfil"=>$row['rol'],
                            "nomperfil"=>utf8_encode($row['nomperfil']),
                            "especialidad"=>utf8_encode($row['nomespecialidad']),
                            "celpersona"=>utf8_encode($row['celpersona']),
                            "correopersona"=>utf8_encode($row['correopersona']),
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
        $sql="UPDATE usuarios SET user='{$this->user}', password='{$this->pass}', especialidad='{$this->especialidad}' , imagen='{$this->imagen}', estatus='{$this->estatus}' WHERE persona='{$this->persona}'";
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
        $sql="DELETE FROM usuarios WHERE persona='{$this->persona}'";
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