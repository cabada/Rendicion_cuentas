<?php


require_once "../Conexion.php";
$conexion = conexion();

$correo_electronico = $_POST['correo_electronico'];
$contrasena = $_POST['contrasena'];


$stmt = $conexion->prepare("select nombre_usuario from usuarios where email_usuario=? and contrasena_usuario=?");
$stmt->bind_param("ss", $correo_electronico, $contrasena);


$result = $stmt->execute();



 if($stmt->fetch()){
     echo $result;
 }

$stmt->close();
$conexion->close();
?>