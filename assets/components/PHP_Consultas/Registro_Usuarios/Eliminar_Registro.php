<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_usuario=$_POST['id_usuario'];

$stmt = $conexion->prepare("delete from usuarios where id_usuario=?");
$stmt->bind_param('i',$id_usuario);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
