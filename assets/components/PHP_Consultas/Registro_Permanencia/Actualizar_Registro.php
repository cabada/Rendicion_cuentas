<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_permanencia=$_POST['id_permanencia'];
$programa=$_POST['programa'];
$porcentaje=$_POST['porcentaje'];

$stmt = $conexion->prepare("update permanencia set
                                   PROGRAMA=?,
                                   PORCENTAJE=?
                                   where ID_PERMANENCIA=$id_permanencia");

$stmt->bind_param("ss",$programa,$porcentaje);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
