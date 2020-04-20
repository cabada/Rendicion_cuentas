<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'producto_anio_sabatico';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

    $profesor = $_POST['profesor'];
    $proyecto_realizado = $_POST['proyecto_realizado'];

    $stmt = $conexion->prepare("insert into producto_anio_sabatico (profesor,proyecto_realizado) values (?,?)");
    $stmt->bind_param("ss", $profesor, $proyecto_realizado);

    echo $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();

}

echo "2";


?>

