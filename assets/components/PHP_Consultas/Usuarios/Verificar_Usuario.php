<?php


require_once "../Conexion.php";
require_once "Start_Session.php";
iniciarSesion();
$conexion = conexion();


$correo_electronico = $_POST['correo_electronico'];
$contrasena = $_POST['contrasena'];
$contrasena = md5($contrasena);

$stmt = $conexion->prepare("select id_usuario from usuarios where email_usuario=? and contrasena_usuario=?");
$stmt->bind_param("ss", $correo_electronico, $contrasena);


$result = $stmt->execute();

$stmt->bind_result($resultado);

 if($stmt->fetch()){
     echo $result;
     $_SESSION["id_usuario"] = $resultado;
 }
 else{
     session_destroy();
 }

$stmt->close();
$conexion->close();

?>