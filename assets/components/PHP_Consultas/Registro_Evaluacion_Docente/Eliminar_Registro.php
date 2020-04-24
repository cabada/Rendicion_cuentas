<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'evaluacion_docente';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){
$id_evaluacion_doc = $_POST['id_evaluacion_doc'];

$stmt = $conexion->prepare("delete from evaluacion_docente where id_eva_docente=?");
$stmt->bind_param('i',$id_evaluacion_doc);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
