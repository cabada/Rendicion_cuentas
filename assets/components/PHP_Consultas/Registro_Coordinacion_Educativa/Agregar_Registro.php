<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'coordinacion_educativa_y_tutorias';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {
$nombre_actividad=$_POST['nombre_actividad'];
$periodo_ene_jun=$_POST['periodo_ene_jun'];
$periodo_ago_dic=$_POST['periodo_ago_dic'];

$stmt = $conexion->prepare("insert into coordinacion_educativa_y_tutorias(nombre_actividad, periodo_ene_jun, periodo_ago_dic) values (?,?,?)");
$stmt->bind_param("sii" , $nombre_actividad,$periodo_ene_jun,$periodo_ago_dic);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}

?>