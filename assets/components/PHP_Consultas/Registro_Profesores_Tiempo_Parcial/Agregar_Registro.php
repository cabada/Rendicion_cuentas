<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'profesores_tiempo_parcial';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

$cantidad_tiempo_parcial=$_POST['cantidad_tiempo_parcial'];
$grado=$_POST['grado'];

$stmt = $conexion->prepare("insert into profesores_tiempo_parcial (cantidad_tiempo_parcial,grado) values (?,?)");
$stmt->bind_param("ss", $cantidad_tiempo_parcial,$grado);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo "2";
}


?>

