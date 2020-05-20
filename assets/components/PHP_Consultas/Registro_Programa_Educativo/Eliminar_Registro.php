<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'programa_educativo';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){
$id_programa_educativo=$_POST['id_programa_educativo'];

$stmt = $conexion->prepare("delete from programa_educativo where ID_PROGRAMA_EDUCATIVO=?");
$stmt->bind_param("i",$id_programa_educativo);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo 2;
}
?>
