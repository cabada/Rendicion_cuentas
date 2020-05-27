<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'matriculas';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){
$id_matricula=$_POST['id_matricula'];
$id_carrera=$_POST['id_carrera'];
$cantidad_alumnos=$_POST['cantidad_alumnos'];

$stmt = $conexion->prepare("update matriculas set
                                   ID_CARRERA=?,
                                   CANTIDAD_ALUMNOS=?
                                   where ID_MATRICULA=$id_matricula");
$stmt->bind_param("ii",$id_carrera,$cantidad_alumnos);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
