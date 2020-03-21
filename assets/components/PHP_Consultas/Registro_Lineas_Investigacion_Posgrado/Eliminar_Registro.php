<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_linea=$_POST['id_linea'];

$stmt = $conexion->prepare("delete from lineas_investigacion_posgrado where ID_LINEA=?");
$stmt->bind_param("i",$id_linea);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>