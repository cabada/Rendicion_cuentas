<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_coordinacion_educativa=$_POST['id_coordinacion_educativa'];
$nombre_actividad=$_POST['nombre_actividad'];
$periodo=$_POST['periodo'];

$stmt = $conexion->prepare("update coordinacion_educativa_y_tutorias set
                                   NOMBRE_ACTIVIDAD=?,
                                   PERIODO=?
                                   where ID_ACTIVIDAD=$id_coordinacion_educativa");

$stmt->bind_param("ss",$nombre_actividad,$periodo);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
