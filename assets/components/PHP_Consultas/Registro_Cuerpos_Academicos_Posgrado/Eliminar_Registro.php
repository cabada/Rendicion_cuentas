<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'cuerpos_academicos_posgrado';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){

$id_cuerpos_academicos_posgrado=$_POST['id_cuerpos_academicos_posgrado'];

$stmt = $conexion->prepare("delete from cuerpos_academicos_posgrado where ID_CUERPOS_ACADEMICOS_POSGRADO=?");
$stmt->bind_param("i",$id_cuerpos_academicos_posgrado);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
