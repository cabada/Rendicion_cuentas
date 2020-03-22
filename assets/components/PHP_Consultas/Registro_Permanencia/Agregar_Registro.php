<?php

require_once "../Conexion.php";
$conexion=conexion();

$programa=$_POST['programa'];
$porcentaje=$_POST['porcentaje'];

$stmt = $conexion->prepare("insert into permanencia (PROGRAMA, PORCENTAJE) values (?,?)");
$stmt->bind_param("ss",$programa,$porcentaje);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
