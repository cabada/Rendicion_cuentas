<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'moocs_alumnos';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){

$id_moocs=$_POST['id_moocs_alumnos'];

$stmt = $conexion->prepare("delete from moocs_alumnos where id_moocs_alumnos=?");
$stmt->bind_param("i",$id_moocs);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo 2;
}
?>
