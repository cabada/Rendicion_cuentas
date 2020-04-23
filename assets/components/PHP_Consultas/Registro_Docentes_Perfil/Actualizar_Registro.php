<?php

require_once "../Conexion.php";
$conexion = conexion();
$id_profesor=$_POST['id_profesor'];
$nombre_completo=$_POST['nombre_completo'];
$area_academica=$_POST['area_academica'];
$vigencia = $_POST['vigencia'];

$stmt = $conexion->prepare("update profesores set
                                                    nombre_completo=?,
                                                    id_area_academica=?,
                                                    vigencia=? 
                                               where id_profesor = $id_profesor");

$stmt->bind_param("sis",$nombre_completo,$area_academica,$vigencia);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();
?>
