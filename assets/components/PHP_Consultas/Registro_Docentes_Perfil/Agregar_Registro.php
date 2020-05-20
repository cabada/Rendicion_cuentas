<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'profesores_perfil';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {
$nombre_completo=$_POST['nombre_completo'];
$area_academica=$_POST['area_academica'];
$vigencia = $_POST['vigencia'];
$id_categoria = 2;

$stmt = $conexion->prepare("insert into profesores(nombre_completo,id_area_academica,vigencia,id_categoria_profesores) values (?,?,?,?)");
$stmt->bind_param("sisi",$nombre_completo,$area_academica,$vigencia,$id_categoria);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

}
else{
    echo "2";
}

?>