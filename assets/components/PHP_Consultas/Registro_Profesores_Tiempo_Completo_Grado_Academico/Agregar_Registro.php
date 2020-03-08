<?php

require_once "../Conexion.php";
$conexion = conexion();

$grado=$_POST['grado'];
$mujer=$_POST['mujer'];
$hombre=$_POST['hombre'];
$total=$_POST['total'];
$porcentaje=$_POST['porcentaje'];

$stmt = $conexion->prepare("insert into profesores_tiempo_completo(grado,mujer,hombre,total,porcentaje) values (?,?,?,?,?)");
$stmt->bind_param("siiis",$grado,$mujer, $hombre,
    $total,$porcentaje);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>