<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_prof_grado_acad=$_POST['id_prof_grado_acad'];

$stmt = $conexion->prepare("delete from total_profesores_grado_academico where id_prof_grado_acad=?");
$stmt->bind_param("i",$id_prof_grado_acad);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
