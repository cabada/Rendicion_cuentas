<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_especialidad_carrera=$_POST['id_especialidad_carrera'];
$nombre_especialidad=$_POST['nombre_especialidad'];
$id_carrera=$_POST['id_carrera'];

$stmt = $conexion->prepare("update especialidad_carreras set
                                  NOMBRE_ESPECIALIDAD=?,
                                  ID_CARRERA=?
                                  where ID_ESPECIALIDAD_CARRERA=$id_especialidad_carrera");
$stmt->bind_param("si",$nombre_especialidad,$id_carrera);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
