<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'equipo_maestros_itcj';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){

$id_equipo_ms=$_POST['id_equipo_ms'];

$stmt = $conexion->prepare("delete from equipo_maestros_itcj where id_equipo_maestros_itcj=?");
$stmt->bind_param("i",$id_equipo_ms);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
