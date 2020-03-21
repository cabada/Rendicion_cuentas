<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_curso=$_POST['id_curso'];

$stmt = $conexion->prepare("delete from cursos_formacion_docente_actualizacion_profesional where id_curso=?");
$stmt->bind_param("i",$id_curso);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
