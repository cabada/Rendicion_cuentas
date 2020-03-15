<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_cuerpo_academico=$_POST['id_cuerpo_academico'];

$stmt = $conexion->prepare("delete from cuerpos_academicos where ID_CUERPO_ACADEMICO=?");
$stmt->bind_param("i",$id_cuerpo_academico);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>