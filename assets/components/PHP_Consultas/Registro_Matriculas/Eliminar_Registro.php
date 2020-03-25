<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_matricula=$_POST['id_matricula'];

$stmt = $conexion->prepare("delete from matriculas where ID_MATRICULA=?");
$stmt->bind_param("i",$id_matricula);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
