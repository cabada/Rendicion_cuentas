<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'total_profesores_grado_academico';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){

$id_prof_grado_acad=$_POST['id_prof_grado_acad'];
$grado=$_POST['grado'];
$cantidad=$_POST['cantidad'];

$stmt = $conexion->prepare("update total_profesores_grado_academico set
                                   grado=?,
                                    cantidad=?
                                   where id_prof_grado_acad=$id_prof_grado_acad");

$stmt->bind_param("si", $grado,$cantidad);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo 2;
}


?>
