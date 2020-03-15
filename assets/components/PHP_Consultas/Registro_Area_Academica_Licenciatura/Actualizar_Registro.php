<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_cuerpo_academico=$_POST['id_cuerpo_academico'];
$id_area_academica=$_POST['id_area_academica'];
$nombre_cuerpo_academico=$_POST['nombre_cuerpo_academico'];
$grado=$_POST['grado'];
$estado=$_POST['estado'];
$anio_registro=$_POST['anio_registro'];
$vigencia=$_POST['vigencia'];

$stmt = $conexion->prepare("update cuerpos_academicos set
                                   ID_AREA_ACADEMICA=?,
                                   NOMBRE_CUERPO_ACADEMICO=?,
                                   GRADO=?,
                                   ESTADO=?,
                                   ANIO_REGISTRO=?,
                                   VIGENCIA=?
                                   where ID_CUERPO_ACADEMICO=$id_cuerpo_academico");

$stmt->bind_param("isssis",$id_area_academica,$nombre_cuerpo_academico,
                                         $grado,$estado,$anio_registro,$vigencia);
echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>
