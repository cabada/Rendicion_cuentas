<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_sabatico=$_POST['id_sabatico'];

$stmt = $conexion->prepare("delete from producto_anio_sabatico where id_sabatico=?");
$stmt->bind_param("i",$id_sabatico);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
