<?php
require_once 'conexion.php';
class Persona extends Conexion{
	private $nacionalidad="";
	private $cedula="";
	
	private $nombre="";
	private $apellido="";
	private $sexo="";
    private $edo_civil="";
    private $telefono="";
    private $celular="";
    private $correo="";
    private $direccion="";

    private $estatus="";

    public function __construct(){
		$this->conectar();
	}// fin del contructor
	
	public function set($atributo, $valor){
        $this->$atributo=$valor;
    }
    public function get($atributo){
        return $this->$atributo;
    }
	
	
	public function getEstadoCivil(){
		$edo="";
		if($this->edo_civil=="S"){
			$edo="SOLTERO";
		}elseif ($this->edo_civil=="C") {
			$edo="CASADO";
		}elseif($this->edo_civil=="V"){
			$edo="VIUDO";
		}elseif($this->edo_civil=="D"){
			$edo="DIVORCIADO";
		}
		return $edo;
	}
	public function getNomNacionalidad(){
		$nom="";
		if($this->nacionalidad=="V"){
			$nom="VENEZOLANO";
		}elseif($this->nacionalidad=="E"){
			$nom="EXTRANJERO";
		}
		return $nom;
	}
	public function getIndexNacionalidad(){
		$nom="";
		if($this->nacionalidad=="V"){
			$nom="0";
		}elseif($this->nacionalidad=="E"){
			$nom="1";
		}
		return $nom;
	}
	public function getNomSexo(){
		$nom="";
		if($this->sexo=="M"){
			$nom="MASCULINO";
		}elseif($this->sexo=="F"){
			$nom="FEMENINO";
		}
		return $nom;
	}
	public function getIndexEstadoCivil(){
		$edo="";
		if($this->edo_civil=="S"){
			$edo="0";
		}elseif ($this->edo_civil=="C") {
			$edo="1";
		}elseif($this->edo_civil=="V"){
			$edo="2";
		}elseif($this->edo_civil=="D"){
			$edo="3";
		}
		return $edo;
	}
	public function find(){
		$encontro=false;
		if($this->cedula!=NULL){
			$sql="SELECT nacionalidad, cedula, nombre, apellido, sexo, edo_civil, telefono, 
			celular, correo, direccion, estatus
            FROM personas WHERE cedula='{$this->cedula}'";
            //echo $sql;
            $this->conectar();
			if($c=$this->query($sql)){
                if($this->numero_de_filas($c)>0){
					$f=$c->fetch_assoc();
					$this->set("nacionalidad",$f["nacionalidad"]);
					$this->set("cedula",$f["cedula"]);
					$this->set("nombre",utf8_encode($f["nombre"]));
					$this->set("apellido",utf8_encode($f["apellido"]));
					$this->set("sexo",$f["sexo"]);
					$this->set("edo_civil",$f["edo_civil"]);
					$this->set("telefono",$f["telefono"]);
	                $this->set("celular",$f["celular"]);
	                $this->set("correo",$f["correo"]);
					$this->set("direccion",utf8_encode($f["direccion"]));
					$this->set("estatus",$f["estatus"]);
					$encontro=true;
                }
                $this->liberar($c);
			}//fin de realizo la consulta
		}
		$this->desconectar();
		return $encontro;
	}
   
	public function add(){
        $inserto=false;
        $sql="INSERT INTO personas(nacionalidad, cedula, nombre, apellido, sexo, edo_civil, telefono, celular, correo, direccion, estatus) 
         VALUES('{$this->nacionalidad}','{$this->cedula}','{$this->nombre}', '{$this->apellido}','{$this->sexo}',
        '{$this->edo_civil}','{$this->telefono}','{$this->celular}','{$this->correo}','{$this->direccion}','{$this->estatus}')";
        //echo $sql;
        $this->conectar();
        //$this->query('SET NAMES utf8;');
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
    	$modifico=false;
    	$sql="UPDATE personas SET nacionalidad='{$this->nacionalidad}', nombre='{$this->nombre}', apellido='{$this->apellido}', sexo='{$this->sexo}', edo_civil='{$this->edo_civil}', telefono='{$this->telefono}', celular='{$this->celular}', correo='{$this->correo}', direccion='{$this->direccion}' WHERE cedula='{$this->cedula}'";
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
    
	public function lowerString($cadena){
		return utf8_encode(ucwords(strtolower($cadena)));
	}
	public function getShortNombreApellido(){
		$nombre= explode(" ",$this->nombre);
        $apellido= explode(" ",$this->apellido);
        return utf8_encode(ucwords(strtolower($nombre[0]." ".$apellido[0])));
	}

    public function mayuscula($valor){
		$valor = strtr(strtoupper($valor),"àèìòùáéíóúñäëïöü","ÀÈÌÒÙÁÉÍÓÚÑÄËÏÖÜ");
		return $valor;
	}

	public function listar(){
		$encontro=false;
		$cadena="";
		if($this->nacionalidad!="")
			$cadena=" WHERE nacionalidad='{$this->nacionalidad}'";

		$sql="SELECT nacionalidad, cedula, nombre, apellido, sexo, edo_civil, telefono, 
		celular, correo, direccion, estatus
        FROM personas ".$cadena;
        $this->conectar();
        $i=1;
        $post=array();
        if($query=$this->query($sql)){
            if($this->numero_de_filas($query)>0){
                while ($row=$query->fetch_assoc()) {
                    if($row['estatus']=="A")
                        $estado="Activo";
                    else $estado="Inactivo";
                    $post[]=array(
                        "nacionalidad"=>$row["nacionalidad"],
						"cedula"=>$row["cedula"],
						"nombre"=>utf8_encode($row["nombre"]),
						"apellido"=>utf8_encode($row["apellido"]),
						"sexo"=>$row["sexo"],
						"edo_civil"=>$row["edo_civil"],
						"telefono"=>$row["telefono"],
		                "celular"=>$row["celular"],
		                "correo"=>$row["correo"],
						"direccion"=>utf8_encode($row["direccion"]),
						"estatus"=>$row["estatus"],
                        "numero"=>$i++,
                    );
                }
                $this->liberar($query);
            }
		}
		$this->desconectar();
		return $post;
	}

	public function delete(){
        $elimino=false;
        $sql="DELETE FROM personas WHERE cedula='{$this->cedula}'";
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