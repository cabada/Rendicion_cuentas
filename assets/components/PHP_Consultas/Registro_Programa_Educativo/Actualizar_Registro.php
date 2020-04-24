<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'programa_educativo';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){
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

$stmt->bind_param("isiiss", $id_carrera,$modalidad,$nuevo_ingreso,$reingreso,$estatus,$periodo);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>

