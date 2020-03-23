<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_estudiantes_capacidades_diferentes=$_POST['id_estudiantes_capacidades_diferentes'];
$periodo=$_POST['periodo'];
$anio=$_POST['anio'];
$cantidad_alumnos=$_POST['cantidad_alumnos'];

$stmt = $conexion->prepare("update estudiantes_capacidades_diferentes set
                                   PERIODO=?,
                                   ANIO=?,
                                   CANTIDAD_ALUMNOS=?
                                   where ID_ESTUDIANTES_CAPACIDADES_DIFERENTES=$id_estudiantes_capacidades_diferentes");
$stmt->bind_param("sii",$periodo,$anio,$cantidad_alumnos);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
