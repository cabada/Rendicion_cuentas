<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_equipo_ms=$_POST['id_equipo_ms'];

$stmt = $conexion->prepare("delete from equipo_maestros_itcj where id_equipo_maestros_itcj=?");
$stmt->bind_param("i",$id_equipo_ms);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
