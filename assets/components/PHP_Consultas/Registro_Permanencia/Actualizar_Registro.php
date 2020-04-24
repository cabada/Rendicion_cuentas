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
$programa=$_POST['programa'];
$porcentaje=$_POST['porcentaje'];

$stmt = $conexion->prepare("update permanencia set
                                   PROGRAMA=?,
                                   PORCENTAJE=?
                                   where ID_PERMANENCIA=$id_permanencia");

$stmt->bind_param("ss",$programa,$porcentaje);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo 2;
}

?>
