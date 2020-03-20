<?php

require_once "../Conexion.php";
$conexion = conexion();

$nombre_actividad=$_POST['nombre_actividad'];
$periodo=$_POST['periodo'];

$stmt = $conexion->prepare("insert into coordinacion_educativa_y_tutorias (NOMBRE_ACTIVIDAD, PERIODO) values (?,?)");
$stmt->bind_param("ss" , $nombre_actividad,$periodo);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>