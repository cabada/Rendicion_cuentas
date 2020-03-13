<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_programa = $_POST['id_programa'];

$stmt = $conexion->prepare("delete from programa_delfin where ID_PROGRAMA=?");
$stmt->bind_param('i',$id_programa);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
