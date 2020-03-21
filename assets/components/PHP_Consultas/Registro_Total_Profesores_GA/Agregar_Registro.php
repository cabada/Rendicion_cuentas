<?php

require_once "../Conexion.php";
$conexion = conexion();


$grado=$_POST['grado'];
$cantidad=$_POST['cantidad'];

$stmt = $conexion->prepare("insert into total_profesores_grado_academico (grado,cantidad) values (?,?)");
$stmt->bind_param("si", $grado,$cantidad);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>

