<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_orientatec=$_POST['id_orientatec'];

$stmt = $conexion->prepare("delete from orientatec where ID_ORIENTATEC=?");
$stmt->bind_param('i',$id_orientatec);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
