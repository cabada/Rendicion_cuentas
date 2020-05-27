<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'cursos_formacion_docente_actualizacion_profesional';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){

$id_curso=$_POST['id_curso'];

$stmt = $conexion->prepare("delete from cursos_formacion_docente_actualizacion_profesional where id_curso=?");
$stmt->bind_param("i",$id_curso);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}
?>
