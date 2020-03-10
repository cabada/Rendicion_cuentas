<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_programa=$_POST['id_programa'];
$nombre_proyecto=$_POST['nombre_proyecto'];
$cantidad_alumnos=$_POST['cantidad_alumnos'];
$id_carrera=$_POST['id_carrera'];
$anio=$_POST['anio'];
$fecha_inicio=$_POST['fecha_inicio'];
$fecha_termino=$_POST['fecha_termino'];

$stmt = $conexion->prepare("update programa_delfin set
                                  NOMBRE_PROYECTO=?,
                                  CANTIDAD_ALUMNOS=?,
                                  ID_CARRERA=?,
                                  ANIO=?,
                                  FECHA_INICIO=?,
                                  FECHA_TERMINO=?
                                  where ID_PROGRAMA = $id_programa");

$stmt->bind_param("siisss", $nombre_proyecto,$cantidad_alumnos,$id_carrera,$anio,$fecha_inicio,$fecha_termino);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>
