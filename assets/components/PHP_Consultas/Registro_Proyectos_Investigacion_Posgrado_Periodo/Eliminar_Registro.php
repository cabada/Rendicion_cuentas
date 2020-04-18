<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_proyecto_inv_posgrado_periodo=$_POST['id_proyecto_inv_posgrado_periodo'];

$stmt = $conexion->prepare("delete from proyectos_investigacion_posgrado_periodo where ID_PROYECTO_INV_POSGRADO_PERIODO=?");
$stmt->bind_param("i",$id_proyecto_inv_posgrado_periodo);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
