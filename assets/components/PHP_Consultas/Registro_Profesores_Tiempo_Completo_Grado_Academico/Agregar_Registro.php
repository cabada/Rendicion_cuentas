<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'profesores_tiempo_completo';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

$grado=$_POST['grado'];
$mujer=$_POST['mujer'];
$hombre=$_POST['hombre'];
$total=$_POST['total'];

$stmt = $conexion->prepare("insert into profesores_tiempo_completo(grado,mujer,hombre,total) values (?,?,?,?)");
$stmt->bind_param("siii",$grado,$mujer, $hombre,
    $total);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();


}
else{
    echo "2";
}


?>