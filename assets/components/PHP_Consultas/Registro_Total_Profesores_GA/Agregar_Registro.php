<?php

require_once "../Conexion.php";
$conexion = conexion();


$grado=$_POST['grado'];
$cantidad=$_POST['cantidad'];

$stmt = $conexion->prepare("insert into total_profesores_grado_academico (grado,cantidad) values (?,?)");
$stmt->bind_param("si", $cantidad_tiempo_parcial,$grado);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>

