<?php

require_once "../Conexion.php";
$conexion = conexion();


$periodo=$_POST['periodo'];
$numero_docentes=$_POST['numero_docentes'];

$stmt = $conexion->prepare("insert into moocs (periodo,numero_docentes) values (?,?)");
$stmt->bind_param("si", $periodo,$numero_docentes);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>

