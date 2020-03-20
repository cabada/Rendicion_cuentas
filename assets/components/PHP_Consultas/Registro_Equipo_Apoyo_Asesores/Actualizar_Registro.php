<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_equipo_apoyo_as=$_POST['id_equipo_apoyo_as'];
$nombre=$_POST['nombre'];
$puesto=$_POST['puesto'];
$grado_estudios=$_POST['grado_estudios'];
$funciones=$_POST['funciones'];

$stmt = $conexion->prepare("update equipo_apoyo_asesores_pda set
                                   nombre=?,
                                   puesto=?,
                                   grado_estudios=?,
                                   funciones_med_tecnm=?
                                   where id_equipo_apoyo=$id_equipo_apoyo_as");

$stmt->bind_param("ssss", $nombre,$puesto,$grado_estudios,$funciones);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
