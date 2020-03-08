<?php
require_once "../Conexion.php";
$conexion = conexion();
$id_programa_educativo=$_POST['id_programa_educativo'];
$id_carrera = $_POST['carrera'];
$modalidad = $_POST['modalidad'];
$nuevo_ingreso = $_POST['nuevo_ingreso'];
$reingreso = $_POST['reingreso'];
$estatus = $_POST['status'];
$periodo = $_POST['periodo'];

$stmt = $conexion->prepare("update programa_educativo set
                                    ID_CARRERA=?,
                                    MODALIDAD=?,
                                    NUEVO_INGRESO=?,
                                    REINGRESO=?,
                                    ESTATUS=?,
                                    PERIODO=?
                                    where ID_PROGRAMA_EDUCATIVO=$id_programa_educativo");

$stmt->bind_param("iisiiss", $id_carrera,$modalidad,$nuevo_ingreso,$reingreso,$estatus,$periodo);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>

