<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_cuerpos_academicos_posgrado=$_POST['id_cuerpos_academicos_posgrado'];

$stmt = $conexion->prepare("delete from cuerpos_academicos_posgrado where ID_CUERPOS_ACADEMICOS_POSGRADO=?");
$stmt->bind_param("i",$id_cuerpos_academicos_posgrado);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
