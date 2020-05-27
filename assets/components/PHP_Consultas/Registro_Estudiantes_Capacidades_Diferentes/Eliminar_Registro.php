<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'estudiantes_capacidades_diferentes';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){
$id_estudiantes_capacidades_diferentes=$_POST['id_estudiantes_capacidades_diferentes'];

$stmt = $conexion->prepare("delete from estudiantes_capacidades_diferentes where ID_ESTUDIANTES_CAPACIDADES_DIFERENTES=?");
$stmt->bind_param("i",$id_estudiantes_capacidades_diferentes);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
