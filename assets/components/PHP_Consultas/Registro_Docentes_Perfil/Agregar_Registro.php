<?php

require_once "../Conexion.php";
$conexion = conexion();

$nombre_completo=$_POST['nombre_completo'];
$area_academica=$_POST['area_academica'];
$vigencia = $_POST['vigencia'];
$id_categoria = 2;

$stmt = $conexion->prepare("insert into profesores(nombre_completo,id_area_academica,vigencia,id_categoria_profesores) values (?,?,?,?)");
$stmt->bind_param("sisi",$nombre_completo,$area_academica,$vigencia,$id_categoria);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>