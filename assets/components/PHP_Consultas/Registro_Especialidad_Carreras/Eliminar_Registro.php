<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_especialidad_carrera=$_POST['id_especialidad_carrera'];

$stmt = $conexion->prepare("delete from especialidad_carreras where ID_ESPECIALIDAD_CARRERA=?");
$stmt->bind_param("i",$id_especialidad_carrera);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
