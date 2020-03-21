<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_prof_grado_acad=$_POST['id_prof_grado_acad'];
$grado=$_POST['grado'];
$cantidad=$_POST['cantidad'];

$stmt = $conexion->prepare("update total_profesores_grado_academico set
                                   grado=?,
                                    cantidad=?,
                                   where id_prof_grado_acad=$id_prof_grado_acad");

$stmt->bind_param("si", $grado,$cantidad);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
