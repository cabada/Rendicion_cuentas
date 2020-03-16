<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_equipo_ms=$_POST['id_equipo_ms'];
$nombre_docente=$_POST['nombre_docente'];
$categoria=$_POST['categoria'];
$grado_estudios=$_POST['grado_estudios'];
$sni=$_POST['sni'];
$area_especializacion=$_POST['area_especializacion'];
$experiencia_profesional=$_POST['experiencia_profesional'];
$experiencia_docente=$_POST['experiencia_docente'];

$stmt = $conexion->prepare("update equipo_maestros_itcj set
                                   nombre_docente=?,
                                   categoria_hora=?,
                                   grado_estudios=?,
                                   sni=?,
                                   area_especializacion=?,
                                   experiencia_profesional=?,
                                   experiencia_docente=?
                                   where id_equipo_maestros_itcj=$id_equipo_ms");

$stmt->bind_param("sssssii", $nombre_docente,$categoria,$grado_estudios,$sni,$area_especializacion,$experiencia_profesional,$experiencia_docente );

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
