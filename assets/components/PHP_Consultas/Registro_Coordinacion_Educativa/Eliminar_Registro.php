<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'coordinacion_educativa_y_tutorias';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){
$id_coordinacion_educativa=$_POST['id_coordinacion_educativa'];

$stmt = $conexion->prepare("delete from coordinacion_educativa_y_tutorias where ID_ACTIVIDAD=?");
$stmt->bind_param("i", $id_coordinacion_educativa);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}


?>
