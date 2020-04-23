<?php

require_once "../Conexion.php";
$conexion = conexion();

$nombre_completo=$_POST['nombre_completo'];
$area_academica=$_POST['area_academica'];
$disciplina = $_POST['disciplina'];
$id_categoria = 1;

$stmt = $conexion->prepare("insert into profesores(nombre_completo,id_area_academica,disciplina,id_categoria_profesores) values (?,?,?,?)");
$stmt->bind_param("sisi",$nombre_completo,$area_academica,$disciplina,$id_categoria);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>