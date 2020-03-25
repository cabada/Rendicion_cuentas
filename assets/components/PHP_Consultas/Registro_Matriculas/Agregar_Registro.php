<?php

require_once "../Conexion.php";
$conexion = conexion();

$programa_educativo=$_POST['programa_educativo'];
$cantidad_alumnos=$_POST['cantidad_alumnos'];

$stmt = $conexion->prepare("insert into matriculas(programa_educativo, cantidad_alumnos) values (?,?)");
$stmt->bind_param("si",$programa_educativo,$cantidad_alumnos);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
