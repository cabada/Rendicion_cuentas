<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_area_academica=$_POST['id_area_academica'];
$nombre_cuerpo_academico=$_POST['nombre_cuerpo_academico'];
$grado=$_POST['grado'];
$estado=$_POST['estado'];
$anio_registro=$_POST['anio_registro'];
$vigencia=$_POST['vigencia'];

$stmt = $conexion->prepare("insert into cuerpos_academicos (ID_AREA_ACADEMICA, NOMBRE_CUERPO_ACADEMICO, GRADO, ESTADO, ANIO_REGISTRO, VIGENCIA) values (?,?,?,?,?,?)");
$stmt->bind_param("isssis", $id_area_academica,$nombre_cuerpo_academico,
    $grado, $estado,$anio_registro,$vigencia);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
