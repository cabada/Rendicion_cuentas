<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
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
$total = $_POST['total'];

$stmt = $conexion->prepare("update programa_educativo set
                                    ID_CARRERA=?,
                                    MODALIDAD=?,
                                    NUEVO_INGRESO=?,
                                    REINGRESO=?,
                                    ESTATUS=?,
                                    PERIODO=?,
                                    TOTAL=?
                                    where ID_PROGRAMA_EDUCATIVO=$id_programa_educativo");

$stmt->bind_param("isiissi", $id_carrera,$modalidad,$nuevo_ingreso,$reingreso,$estatus,$periodo,$total);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>

