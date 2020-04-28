<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'lineas_investigacion_posgrado';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){
$id_linea=$_POST['id_linea'];
$id_carrera=$_POST['id_carrera'];
$nombre_especialidad=$_POST['nombre_especialidad'];

$stmt = $conexion->prepare("update lineas_investigacion_posgrado set
                                  ID_CARRERA=?,
                                  NOMBRE_ESPECIALIDAD=?
                                  where ID_LINEA=$id_linea");
$stmt->bind_param("is", $id_carrera,$nombre_especialidad);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo 2;
}


?>
