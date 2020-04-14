<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_rol=$_POST['id_rol'];

$stmt = $conexion->prepare("delete from roles where id_rol=?");
$stmt->bind_param('i',$id_rol);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
