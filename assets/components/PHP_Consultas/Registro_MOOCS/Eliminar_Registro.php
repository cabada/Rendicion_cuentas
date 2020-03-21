<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_moocs=$_POST['id_moocs'];

$stmt = $conexion->prepare("delete from moocs where id_moocs=?");
$stmt->bind_param("i",$id_moocs);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
