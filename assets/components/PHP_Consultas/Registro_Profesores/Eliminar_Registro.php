<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_profesor = $_POST['id_profesor'];

$stmt = $conexion->prepare("delete from profesores where id_profesor=?");
$stmt->bind_param('i', $id_profesor);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
