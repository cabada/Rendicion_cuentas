<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'lineas_investigacion_licenciatura';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {
$id_carrera=$_POST['id_carrera'];
$nombre_especialidad=$_POST['nombre_especialidad'];

$stmt = $conexion->prepare("insert into lineas_investigacion_licenciatura (ID_CARRERA, NOMBRE_ESPECIALIDAD) VALUES (?,?)");
$stmt->bind_param("is",$id_carrera,$nombre_especialidad);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}


?>
