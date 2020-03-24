<?php

require_once "../Conexion.php";
$conexion = conexion();

$programa=$_POST['programa'];
$cantidad=$_POST['cantidad'];
$porcentaje=$_POST['porcentaje'];
$registrado_en=$_POST['registrado_en'];

$stmt = $conexion->prepare("insert into total_alumnos_programa_posgrado(programa, cantidad, porcentaje, registrado_en) VALUES (?,?,?,?)");
$stmt->bind_param("siss",$programa,$cantidad,$porcentaje,$registrado_en);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>