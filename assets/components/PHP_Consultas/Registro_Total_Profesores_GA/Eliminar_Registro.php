<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'total_profesores_grado_academico';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){

$id_prof_grado_acad=$_POST['id_prof_grado_acad'];

$stmt = $conexion->prepare("delete from total_profesores_grado_academico where id_prof_grado_acad=?");
$stmt->bind_param("i",$id_prof_grado_acad);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}
?>
