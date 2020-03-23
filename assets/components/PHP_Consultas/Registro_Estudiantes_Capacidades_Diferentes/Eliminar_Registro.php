<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_estudiantes_capacidades_diferentes=$_POST['id_estudiantes_capacidades_diferentes'];

$stmt = $conexion->prepare("delete from estudiantes_capacidades_diferentes where ID_ESTUDIANTES_CAPACIDADES_DIFERENTES=?");
$stmt->bind_param("i",$id_estudiantes_capacidades_diferentes);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close()
?>
