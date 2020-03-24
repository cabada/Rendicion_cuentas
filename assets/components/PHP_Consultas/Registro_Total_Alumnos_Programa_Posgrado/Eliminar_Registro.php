<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_total_prog_posgrado=$_POST['id_total_prog_posgrado'];

$stmt = $conexion->prepare("delete from total_alumnos_programa_posgrado where ID_TOTAL_PROG_POSGRADO=?");
$stmt->bind_param("i",$id_total_prog_posgrado);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
