<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_coordinacion_educativa=$_POST['id_coordinacion_educativa'];

$stmt = $conexion->prepare("delete from coordinacion_educativa_y_tutorias where ID_ACTIVIDAD=?");
$stmt->bind_param("i", $id_coordinacion_educativa);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close()

?>
