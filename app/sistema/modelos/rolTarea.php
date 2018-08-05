<?php 
require_once 'conexion.php';
class rolTarea extends Conexion{
	private $rol;
	private $tarea;
	private $estatus;

	public function __construct(){
    }// fin del contructor
    
    public function set($atributo, $valor){
        $this->$atributo=$valor;
    }
    public function get($atributo){
        return $this->$atributo;
    }

    public function listTareaRolDeActividad($rol,$act){
        //$this->conectar();
        $sql=$this->query("SELECT t.id,descripcion,ruta,actividad FROM rol_tarea rt 
        INNER JOIN tareas t ON tarea=t.id AND rol=$rol AND actividad=$act AND t.estatus='A'");
        //$this->desconectar();
        return ($this->numero_de_filas($sql)>0) ? $sql : false;
    }

    public function tareasDeUsuario($usuario,$actividad){
        $tareas=array();
        $this->conectar();
        $roles="SELECT rol FROM usuario_rol WHERE usuario='$usuario' AND estatus='A'";
        if($c=$this->query($roles)){
            while($f=$c->fetch_row()){
                if($c2=$this->listTareaRolDeActividad($f[0],$actividad)){
                    while($f2=$c2->fetch_row()){
                        if(!$this->buscarEnArreglo($f2[0],$tareas)){
                            $tareas[]= array(
                                'id'=>$f2[0],
                                'tarea'=>utf8_encode($f2[1]),
                                'ruta'=>$f2[2]
                            );
                        }
                    }
                    $this->liberar($c2);
                }//fin del if primero
            }//fin del while que recorre roles
            $this->liberar($c);    
        }
        $this->desconectar();
        return $tareas;
    }

    public function listActividadesDeRol($usuario,$rol){
        $sql=$this->query("SELECT a.id, a.descripcion, a.icono
        FROM usuario_rol ur
        INNER JOIN rol_tarea rt ON ur.rol = rt.rol
        AND ur.rol=$rol
        AND usuario = '$usuario'
        INNER JOIN tareas t ON tarea = t.id
        INNER JOIN actividades a ON actividad = a.id AND a.estatus='A' GROUP BY a.id");
        return ($this->numero_de_filas($sql)>0) ? $sql : false;
    }

    public function actividadesDelUsuario($usuario){
        $inserto=false;
        $roles="SELECT rol 
        FROM usuario_rol WHERE usuario='$usuario' AND estatus='A'";
        $arreglo=array();
        $this->conectar();
        if($c=$this->query($roles)){
            while($f=$c->fetch_row()){
                if($c2=$this->listActividadesDeRol($usuario,$f[0])){
                    while($f2=$c2->fetch_row()){
                        if(!$this->buscarEnArreglo($f2[0],$arreglo)){
                            $arreglo[]= array(
                                'id'=>$f2[0],
                                'actividad'=>utf8_encode($f2[1]),
                                'icono'=>$f2[2]
                            );
                        }
                    }
                }    
            }//fin del while que recorre roles
            $this->liberar($c);
        }
        $this->desconectar();
        return $arreglo;
    }

    public function buscarEnArreglo($id, $arreglo){
        $encontro=false;
        foreach ($arreglo as $key => $valor) {
            if($valor['id']==$id){
                $encontro= true;
                break;
            }
        }
        return $encontro;
    }

}


 ?>