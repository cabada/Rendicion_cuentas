<?php

require_once "../Conexion.php";
$conexion = conexion();

$nombre_especialidad=$_POST['nombre_especialidad'];
$id_carrera=$_POST['id_carrera'];

$stmt = $conexion->prepare("insert into especialidad_carreras (NOMBRE_ESPECIALIDAD, ID_CARRERA) VALUES (?,?)");
$stmt->bind_param("si",$nombre_especialidad,$id_carrera);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>