<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_cuerpos_academicos_posgrado=$_POST['id_cuerpos_academicos_posgrado'];
$area_academica=$_POST['area_academica'];
$nombre_cuerpo=$_POST['nombre_cuerpo'];
$grado=$_POST['grado'];
$estado=$_POST['estado'];
$anio_registro=$_POST['anio_registro'];
$vigencia=$_POST['vigencia'];
$area=$_POST['area'];

$stmt = $conexion->prepare("update cuerpos_academicos_posgrado set
                                   AREA_ACADEMICA=?,
                                   NOMBRE_CUERPO=?,
                                   GRADO=?,
                                   ESTADO=?,
                                   ANIO_REGISTRO=?,
                                   VIGENCIA=?,
                                   AREA=? 
                                   where ID_CUERPOS_ACADEMICOS_POSGRADO=$id_cuerpos_academicos_posgrado");

$stmt->bind_param("ssssiss", $area_academica,$nombre_cuerpo,$grado,$estado,$anio_registro,$vigencia,$area);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
