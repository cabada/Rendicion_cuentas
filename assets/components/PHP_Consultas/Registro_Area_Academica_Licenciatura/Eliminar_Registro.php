<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'cuerpos_academicos';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()) {
    $id_cuerpo_academico = $_POST['id_cuerpo_academico'];

    $stmt = $conexion->prepare("delete from cuerpos_academicos where ID_CUERPO_ACADEMICO=?");
    $stmt->bind_param("i", $id_cuerpo_academico);

    echo $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
}else{
        echo 2;
    }


?>