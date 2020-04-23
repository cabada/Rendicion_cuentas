<?php


require_once "../Conexion.php";
$conexion = conexion();

$correo_electronico = $_POST['correo_electronico'];
$contrasena = $_POST['contrasena'];

$stmt = $conexion->prepare("select id_usuario from usuarios where email_usuario=? and contrasena_usuario=?");
$stmt->bind_param("ss", $correo_electronico, $contrasena);


$result = $stmt->execute();

$stmt->bind_result($resultado);

 if($stmt->fetch()){
     echo $result;
     session_start();
     $_SESSION["id_usuario"] = $resultado;
 }

$stmt->close();
$conexion->close();

?>