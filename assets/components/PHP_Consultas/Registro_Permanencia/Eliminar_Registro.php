<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_permanencia=$_POST['id_permanencia'];

$stmt = $conexion->prepare("delete from permanencia where ID_PERMANENCIA=?");
$stmt->bind_param("i",$id_permanencia);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
