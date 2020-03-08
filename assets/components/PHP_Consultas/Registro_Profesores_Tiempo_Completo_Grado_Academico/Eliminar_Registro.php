<?php


require_once "../Conexion.php";
$conexion = conexion();

$id_registro = $_POST['id_registro'];

$stmt = $conexion->prepare("delete from profesores_tiempo_completo where id_prof_tiemp_comp=?");
$stmt->bind_param('i', $id_registro);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
