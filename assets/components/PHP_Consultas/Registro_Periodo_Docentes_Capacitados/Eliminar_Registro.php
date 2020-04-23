<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_periodo=$_POST['id_periodo'];

$stmt = $conexion->prepare("delete from periodo_docentes_capacitados where id_periodo_docentes_capacitados=?");
$stmt->bind_param('i',$id_periodo);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
