<?php


require_once "../Conexion.php";
$conexion = conexion();
$id_carrera = $_POST['carrera'];
$modalidad = $_POST['modalidad'];
$nuevo_ingreso = $_POST['nuevo_ingreso'];
$reingreso = $_POST['reingreso'];
$estatus = $_POST['status'];
$periodo = $_POST['periodo'];

$stmt = $conexion->prepare("insert into programa_educativo(id_carrera,modalidad,nuevo_ingreso,reingreso,estatus,periodo) values (?,?,?,?,?,?)");
$stmt->bind_param("isiiss",$id_carrera,$modalidad, $nuevo_ingreso,
    $reingreso,$estatus,$periodo);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>
