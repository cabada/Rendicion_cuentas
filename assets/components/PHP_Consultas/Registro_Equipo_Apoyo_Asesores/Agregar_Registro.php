<?php

require_once "../Conexion.php";
$conexion = conexion();

$nombre=$_POST['nombre'];
$puesto=$_POST['puesto'];
$grado_estudios=$_POST['grado_estudios'];
$funciones=$_POST['funciones'];

$stmt = $conexion->prepare("insert into equipo_apoyo_asesores_pda (nombre,puesto,grado_estudios,funciones_med_tecnm) values (?,?,?,?)");
$stmt->bind_param("ssss", $nombre,$puesto,$grado_estudios,$funciones);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>

