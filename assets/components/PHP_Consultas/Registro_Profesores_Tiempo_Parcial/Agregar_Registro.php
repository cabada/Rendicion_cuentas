<?php

require_once "../Conexion.php";
$conexion = conexion();

$cantidad_tiempo_parcial=$_POST['cantidad_tiempo_parcial'];
$grado=$_POST['grado'];

$stmt = $conexion->prepare("insert into profesores_tiempo_parcial (cantidad_tiempo_parcial,grado) values (?,?)");
$stmt->bind_param("ss", $cantidad_tiempo_parcial,$grado);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>

