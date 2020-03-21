<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_curso=$_POST['id_curso'];
$nombre_curso=$_POST['nombre_curso'];
$periodo=$_POST['periodo'];
$num_participantes=$_POST['num_participantes'];
$horas_capacitacion=$_POST['horas_capacitacion'];

$stmt = $conexion->prepare("update cursos_formacion_docente_actualizacion_profesional set
                                   nombre_curso=?,
                                   periodo=?,
                                   num_participantes=?,
                                   horas_capacitacion=?
                                   where id_curso=$id_curso");

$stmt->bind_param("ssii", $nombre_curso,$periodo,$num_participantes,$horas_capacitacion);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
