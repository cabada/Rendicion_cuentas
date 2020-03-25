<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_matricula=$_POST['id_matricula'];
$programa_educativo=$_POST['programa_educativo'];
$cantidad_alumnos=$_POST['cantidad_alumnos'];

$stmt = $conexion->prepare("update matriculas set
                                   PROGRAMA_EDUCATIVO=?,
                                   CANTIDAD_ALUMNOS=?
                                   where ID_MATRICULA=$id_matricula");
$stmt->bind_param("si",$programa_educativo,$cantidad_alumnos);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
