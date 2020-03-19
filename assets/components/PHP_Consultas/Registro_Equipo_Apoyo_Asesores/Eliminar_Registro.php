<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_equipo_apoyo_as=$_POST['id_equipo_apoyo'];

$stmt = $conexion->prepare("delete from equipo_apoyo_asesores_pda where id_equipo_apoyo=?");
$stmt->bind_param("i",$id_equipo_apoyo_as);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
