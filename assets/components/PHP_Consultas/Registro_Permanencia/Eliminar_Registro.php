<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'permanencia';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){
$id_permanencia=$_POST['id_permanencia'];

$stmt = $conexion->prepare("delete from permanencia where ID_PERMANENCIA=?");
$stmt->bind_param("i",$id_permanencia);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo 2;
}
?>
