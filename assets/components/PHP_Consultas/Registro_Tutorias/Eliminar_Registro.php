<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_tutorias=$_POST['id_tutorias'];


$stmt = $conexion->prepare("delete from tutorias where ID_TUTORIAS=?");
$stmt->bind_param('i',$id_tutorias);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
