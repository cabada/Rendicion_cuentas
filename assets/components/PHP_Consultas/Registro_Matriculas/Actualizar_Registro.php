<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'matriculas';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){
$id_matricula=$_POST['id_matricula'];
$programa_educativo=$_POST['programa_educativo'];
$cantidad_alumnos=$_POST['cantidad_alumnos'];

$stmt = $conexion->prepare("update matriculas set
                                   PROGRAMA_EDUCATIVO=?,
                                   CANTIDAD_ALUMNOS=?
                                   where ID_MATRICULA=$id_matricula");
$stmt->bind_param("si",$programa_educativo,$cantidad_alumnos);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
