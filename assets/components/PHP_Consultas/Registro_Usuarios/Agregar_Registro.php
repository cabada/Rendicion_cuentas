<?php

    require_once "../Conexion.php";
    $conexion=conexion();

    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $email=$_POST['email'];
    $contrasena=$_POST['contrasena'];
    $contrasena = md5($contrasena);
    $rol=$_POST['rol'];

    $stmt = $conexion->prepare("insert into usuarios(nombre_usuario,apellido_usuario,email_usuario,contrasena_usuario,id_rol_usuario) values (?,?,?,?,?)");
    $stmt->bind_param("ssssi", $nombre, $apellido,$email,$contrasena,$rol);


echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>

