<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_prof_tmp_parc=$_POST['id_prof_tmp_parc'];

$stmt = $conexion->prepare("delete from profesores_tiempo_parcial where id_prof_tmp_parc=?");
$stmt->bind_param("i",$id_prof_tmp_parc);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
