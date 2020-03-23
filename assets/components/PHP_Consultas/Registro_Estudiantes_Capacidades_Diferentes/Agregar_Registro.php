<?php

require_once "../Conexion.php";
$conexion=conexion();

$periodo=$_POST['periodo'];
$anio=$_POST['anio'];
$cantidad_alumnos=$_POST['cantidad_alumnos'];

$stmt = $conexion->prepare("insert into estudiantes_capacidades_diferentes(periodo, anio, cantidad_alumnos) VALUES (?,?,?)");
$stmt->bind_param("sii",$periodo,$anio,$cantidad_alumnos);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
