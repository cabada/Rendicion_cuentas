<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'proyectos_investigacion_posgrado_periodo';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){

$id_proyecto_inv_posgrado_periodo=$_POST['id_proyecto_inv_posgrado_periodo'];

$stmt = $conexion->prepare("delete from proyectos_investigacion_posgrado_periodo where ID_PROYECTO_INV_POSGRADO_PERIODO=?");
$stmt->bind_param("i",$id_proyecto_inv_posgrado_periodo);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
