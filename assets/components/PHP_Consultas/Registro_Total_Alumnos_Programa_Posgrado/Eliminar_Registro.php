<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'total_alumnos_programa_posgrado';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){

$id_total_prog_posgrado=$_POST['id_total_prog_posgrado'];

$stmt = $conexion->prepare("delete from total_alumnos_programa_posgrado where ID_TOTAL_PROG_POSGRADO=?");
$stmt->bind_param("i",$id_total_prog_posgrado);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}
?>
