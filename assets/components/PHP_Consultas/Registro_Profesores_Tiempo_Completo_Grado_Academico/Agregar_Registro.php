<?php

require_once "../Conexion.php";
$conexion = conexion();

$grado=$_POST['grado'];
$mujer=$_POST['mujer'];
$hombre=$_POST['hombre'];
$total=$_POST['total'];

$stmt = $conexion->prepare("insert into profesores_tiempo_completo(grado,mujer,hombre,total) values (?,?,?,?)");
$stmt->bind_param("siii",$grado,$mujer, $hombre,
    $total);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>