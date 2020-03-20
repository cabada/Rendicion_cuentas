<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_evaluacion_doc = $_POST['id_evaluacion_doc'];

$stmt = $conexion->prepare("delete from evaluacion_docente where id_eva_docente=?");
$stmt->bind_param('i',$id_evaluacion_doc);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
