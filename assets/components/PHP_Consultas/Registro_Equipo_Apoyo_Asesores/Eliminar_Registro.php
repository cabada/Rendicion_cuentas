<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'equipo_apoyo_asesores_pda';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){

$id_equipo_apoyo_as=$_POST['id_equipo_apoyo_as'];

$stmt = $conexion->prepare("delete from equipo_apoyo_asesores_pda where id_equipo_apoyo=?");
$stmt->bind_param("i",$id_equipo_apoyo_as);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}
?>
