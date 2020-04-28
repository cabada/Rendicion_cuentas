<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_usuario=$_POST['id_usuario'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$email=$_POST['email'];
$contrasena=$_POST['contrasena'];
$contrasena = md5($contrasena);
$rol=$_POST['rol'];


$stmt = $conexion->prepare("update usuarios set
                                            nombre_usuario=?,
                                            apellido_usuario=?,
                                            email_usuario=?,
                                            contrasena_usuario=?,
                                            id_rol_usuario=?
                                            where id_usuario = $id_usuario");

$stmt->bind_param("ssssi", $nombre, $apellido,$email,$contrasena,$rol);
echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>
