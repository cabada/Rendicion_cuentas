<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_moocs=$_POST['id_moocs_alumnos'];

$stmt = $conexion->prepare("delete from moocs_alumnos where id_moocs_alumnos=?");
$stmt->bind_param("i",$id_moocs);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
