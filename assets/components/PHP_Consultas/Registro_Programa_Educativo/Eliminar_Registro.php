<?php

require_once "../Conexion.php";
$conexion = conexion();
$id_programa_educativo=$_POST['id_programa_educativo'];

$stmt = $conexion->prepare("delete from programa_educativo where ID_PROGRAMA_EDUCATIVO=?");
$stmt->bind_param("i",$id_programa_educativo);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
