<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'profesores_certificaciones';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){

$id_profesor = $_POST['id_profesor'];

$stmt = $conexion->prepare("delete from profesores where id_profesor=?");
$stmt->bind_param('i', $id_profesor);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo 2;
}
?>
