<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'lineas_investigacion_posgrado';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

    $id_carrera=$_POST['id_carrera'];
$nombre_especialidad=$_POST['nombre_especialidad'];

$stmt = $conexion->prepare("insert into lineas_investigacion_posgrado (ID_CARRERA, NOMBRE_ESPECIALIDAD) VALUES (?,?)");
$stmt->bind_param("is",$id_carrera,$nombre_especialidad);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}


?>