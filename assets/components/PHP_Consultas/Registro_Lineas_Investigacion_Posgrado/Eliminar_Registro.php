<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'lineas_investigacion_posgrado';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){


    $id_linea=$_POST['id_linea'];

$stmt = $conexion->prepare("delete from lineas_investigacion_posgrado where ID_LINEA=?");
$stmt->bind_param("i",$id_linea);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>