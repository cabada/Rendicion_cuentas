<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_coordinacion_educativa=$_POST['id_coordinacion_educativa'];
$nombre_actividad=$_POST['nombre_actividad'];
$periodo_ene_jun=$_POST['periodo_ene_jun'];
$periodo_ago_dic=$_POST['periodo_ago_dic'];

$stmt = $conexion->prepare("update coordinacion_educativa_y_tutorias set
                                   NOMBRE_ACTIVIDAD=?,
                                   PERIODO_ENE_JUN=?,
                                   PERIODO_AGO_DIC=?
                                   where ID_ACTIVIDAD=$id_coordinacion_educativa");

$stmt->bind_param("sii",$nombre_actividad,$periodo_ene_jun,$periodo_ago_dic);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
