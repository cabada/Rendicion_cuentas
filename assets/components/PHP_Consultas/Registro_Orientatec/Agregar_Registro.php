<?php

require_once "../Conexion.php";
$conexion=conexion();

   $nombre_preparatoria=$_POST['nombre_preparatoria'];
   $fecha=$_POST['fecha'];
   $estudiantes_atendidos=$_POST['estudiantes_atendidos'];

$stmt = $conexion->prepare("insert into orientatec(nombre_preparatoria, fecha, estudiantes_atendidos) values (?,?,?)");
$stmt->bind_param("ssi",$nombre_preparatoria,$fecha,$estudiantes_atendidos);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>
