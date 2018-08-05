<?php 
session_start();
require '../modelos/usuario.php';
require '../modelos/usuarioRol.php';

$tirajson='{"success": "true", "mensaje": "ERROR DE CONECCION"}';

//if(isset($_POST['usu'],$_POST['pass']) && !empty($_POST['usu']) && !empty($_POST['pass'])){
//if(isset($_POST['user'],$_POST['pass']) && !empty($_POST['user']) && !empty($_POST['pass'])){
	$usu=new Usuario();
    $rol=new UsuarioRol();
    /*$Usuario = $_POST['user'];*///, $usu->get("user");
    /*$Clave = $_POST['pass'];*///, $usu->get("pass");
    $usu->set("user", $_POST['usu']/*$Usuario*/);
    if($usu->find()){
            if($usu->get("estatus")=='A') {
                if($usu->get("pass")==$_POST['pass']){
                    $rol->set("usuario",$_POST['usu']);
                    $rol->find();
                    $_SESSION["usuario"]=$_POST['usu'];
                    $_SESSION["rol"]=$rol->get("rol");
                    $_SESSION["persona"]=$usu->get("persona");
                    $tirajson = '{"success": "true", "exito": "true", "msg": "Sesion Iniciada. Redireccionando...", "url": "app/index.php"}';
                }else 
                    $tirajson = '{"success": "true", "exito": "false", "msg": "Credenciales invalidas" }';
            }else 
                $tirajson = '{"success": "true", "exito": "false", "msg": "Usuario se encuentra inactivo" }';
        }else 
            $tirajson = '{"success": "true", "exito": "false", "msg": "Credenciales invalidas" }';
//}
echo $tirajson;

 ?>