<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_carrera=$_POST['id_carrera'];
$nombre_especialidad=$_POST['nombre_especialidad'];

$stmt = $conexion->prepare("insert into lineas_investigacion_licenciatura (ID_CARRERA, NOMBRE_ESPECIALIDAD) VALUES (?,?)");
$stmt->bind_param("is",$id_carrera,$nombre_especialidad);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
