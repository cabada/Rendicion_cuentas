<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'total_profesores_grado_academico';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

$grado=$_POST['grado'];
$cantidad=$_POST['cantidad'];

$stmt = $conexion->prepare("insert into total_profesores_grado_academico (grado,cantidad) values (?,?)");
$stmt->bind_param("si", $grado,$cantidad);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}


?>

