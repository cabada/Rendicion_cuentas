<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'permanencia';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){

$id_permanencia=$_POST['id_permanencia'];
$id_carrera=$_POST['programa'];
$porcentaje=$_POST['porcentaje'];
$porcentaje = strval($porcentaje);

$stmt = $conexion->prepare("update permanencia set
                                   ID_CARRERA=?,
                                   PORCENTAJE=?
                                   where ID_PERMANENCIA=$id_permanencia");

$stmt->bind_param("is",$id_carrera,$porcentaje);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo 2;
}

?>
