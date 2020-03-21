<?php

require_once "../Conexion.php";
$conexion = conexion();


$profesor=$_POST['profesor'];
$proyecto_realizado=$_POST['proyecto_realizado'];

$stmt = $conexion->prepare("insert into producto_anio_sabatico (profesor,proyecto_realizado) values (?,?)");
$stmt->bind_param("ss", $profesor,$proyecto_realizado);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>

