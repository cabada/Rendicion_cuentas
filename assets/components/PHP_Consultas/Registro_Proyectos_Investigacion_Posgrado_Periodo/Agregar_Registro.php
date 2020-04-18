<?php

require_once "../Conexion.php";
$conexion=conexion();

$clave=$_POST['clave'];
$nombre_proyecto=$_POST['nombre_proyecto'];
$responsable=$_POST['responsable'];

$stmt = $conexion->prepare("insert into proyectos_investigacion_posgrado_periodo(clave,nombre_proyecto,responsable) values (?,?,?)");
$stmt->bind_param("sss",$clave,$nombre_proyecto,$responsable);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
