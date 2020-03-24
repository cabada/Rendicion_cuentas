<?php

require_once "../Conexion.php";
$conexion = conexion();

$nombre_actividad=$_POST['nombre_actividad'];
$periodo_ene_jun=$_POST['periodo_ene_jun'];
$periodo_ago_dic=$_POST['periodo_ago_dic'];

$stmt = $conexion->prepare("insert into coordinacion_educativa_y_tutorias(nombre_actividad, periodo_ene_jun, periodo_ago_dic) values (?,?,?)");
$stmt->bind_param("sii" , $nombre_actividad,$periodo_ene_jun,$periodo_ago_dic);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>