<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'profesores_tiempo_parcial';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){
$id_prof_tmp_parc=$_POST['id_prof_tmp_parc'];

$stmt = $conexion->prepare("delete from profesores_tiempo_parcial where id_prof_tmp_parc=?");
$stmt->bind_param("i",$id_prof_tmp_parc);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
