<?php 
require_once 'conexion.php';
class usuarioRol extends Conexion{
	private $usuario;
	private $rol;
    private $descripcion;
	private $estatus;

    private $oldperfil;
    private $oldusuario;

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
        if($this->usuario!=""){
            $cadena="usuario='{$this->usuario}'";
        }
        $this->conectar();
        $sql="SELECT usuario, rol, descripcion, ur.estatus AS estatus FROM usuario_rol ur INNER JOIN roles ON rol=id AND ".$cadena;
        //echo $sql;
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                $f=$c->fetch_assoc();
                $this->set("usuario",$f['usuario']);
                $this->set("rol",$f['rol']);
                $this->set("descripcion",utf8_encode($f['descripcion']));
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
        $sql="INSERT INTO usuario_rol(usuario, rol, estatus) VALUES('{$this->usuario}','{$this->rol}','{$this->estatus}')";
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

    public function edit(){
        $modifico= false;
        $sql="UPDATE usuario_rol SET rol='{$this->rol}', usuario='{$this->usuario}' , estatus='{$this->estatus}' WHERE usuario='{$this->oldusuario}' AND rol='{$this->oldperfil}'";
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

    // public function delete(){
    //     $elimino=false;
    //     $sql="DELETE * FROM usuario_rol WHERE usuario='{$this->oldusuario}'";
    //     //echo $sql;
    //     $this->conectar();
    //     if($this->query($sql)){
    //         if($this->ejecuto_query()>0){
    //             $elimino=true;
    //         } 
    //     }
    //     $this->desconectar();
    //     return $elimino;
    // }

    public function listar(){
        $cadena="";
        $i=1;
        $post=array();
        if($this->estatus!=""){
            $cadena=" AND u.estatus=$this->estatus ";
        }
        if($this->rol!=""){
            $cadena.=" AND ur.rol=$this->rol ";
        }
        if($this->usuario!=""){
            $cadena.=" AND usuario='{$this->usuario}' ";
        }

        $sql="SELECT usuario, rol, descripcion, ur.estatus AS estatus, persona, nombre, apellido
        FROM usuario_rol ur INNER JOIN roles ON rol=id
        INNER JOIN usuarios u ON u.user=ur.usuario INNER JOIN
        personas p ON u.persona=p.cedula ".$cadena;
        //echo $sql;
        $this->conectar();
        if($c=$this->query($sql)){
            if($this->numero_de_filas($c)>0){
                while ($row=$c->fetch_assoc()) {
                    $estado="Activo";
                    if($row['estatus']=="I")
                        $estado="Inactivo";
                    $post[]=array(
                        "usuario"=>$row['usuario'],
                        "rol"=>$row['rol'],
                        "descripcion"=>utf8_encode($row['descripcion']),
                        "estatus"=>$estado,
                        "persona"=>$row['persona'],
                        "nombre"=>utf8_encode($row['nombre']),
                        "apellido"=>utf8_encode($row['apellido']),
                        "numero"=>$i++,
                    );
                }
            }
        }
        $this->liberar($c);
        $this->desconectar();
        return $post;
    }


    public function getdescripcionPerfil(){
        $descripcion="";
        $i=1;
        $query_roles="SELECT rol, u.estatus, descripcion  FROM usuario_rol u INNER JOIN roles r ON rol=r.id AND usuario=.$this->getUsuario(). AND u.estatus='A'";
        if($query=$this->query($query_roles)){
            if($numero=$this->numero_de_filas($query)>0){
                while ($roles=$query->fetch_assoc()) {
                    $descripcion.=$roles['descripcion'];
                    if($i<$numero)
                        $descripcion.=", ";
                    $i++;
                }
            }
        }
        return $descripcion;
    }   

}


 ?>