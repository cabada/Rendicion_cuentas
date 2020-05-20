<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'producto_anio_sabatico';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){

    $id_sabatico=$_POST['id_sabatico'];
    $profesor=$_POST['profesor'];
    $proyecto_realizado=$_POST['proyecto_realizado'];

    $stmt = $conexion->prepare("update producto_anio_sabatico set
                                   profesor=?,
                                    proyecto_realizado=?
                                   where id_sabatico=$id_sabatico");

    $stmt->bind_param("ss", $profesor,$proyecto_realizado);

    echo $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();



}
else{
    echo 2;
}



?>
