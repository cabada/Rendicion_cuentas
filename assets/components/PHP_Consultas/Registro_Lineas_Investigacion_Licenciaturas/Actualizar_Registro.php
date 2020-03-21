<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_linea=$_POST['id_linea'];
$id_carrera=$_POST['id_carrera'];
$nombre_especialidad=$_POST['nombre_especialidad'];

$stmt = $conexion->prepare("update lineas_investigacion_licenciatura set
                                  ID_CARRERA=?,
                                  NOMBRE_ESPECIALIDAD=?
                                  where ID_LINEA=$id_linea");
$stmt->bind_param("is", $id_carrera,$nombre_especialidad);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
