<?php

class Conexion{
    private $localhost='localhost';
    private $usuario='root';
    private $password='';
    private $database = "proyecto_gestion";
    private $mysqli;

    
    public function conectar(){
        $this->mysqli = mysqli_connect($this->localhost, $this->usuario, $this->password,  $this->database);
        if (mysqli_connect_errno()) {
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        }
    }//fin de conectar
    public function query($q){
        $resultado = mysqli_query($this->mysqli, $q);
        if(!$resultado){
            echo 'ERROR en Base de Datos, contacte al Administrador del Sistema';
            exit();
        }
        return $resultado;
           
    }//fin de query
    
    public function numero_de_filas($result){
        return mysqli_num_rows($result);
    }
    public function ejecuto_query(){
        $ejecuto=false;
        $ejecuto=mysqli_affected_rows($this->mysqli);
        return $ejecuto;
    }
    public function auto_commit($valor){
        return mysqli_autocommit($this->mysqli, $valor);
    }
    public function commit_transaccion(){
        return mysqli_commit($this->mysqli);
    }
    public function desconectar(){
        $this->mysqli->close();
    }
    public function liberar($result){
        return mysqli_free_result($result);
    }
    public function insert_id(){
        return mysqli_insert_id($this->mysqli);
    }
}//fin de la clase
?>