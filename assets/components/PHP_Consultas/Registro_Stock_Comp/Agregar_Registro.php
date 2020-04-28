<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'stock_salas_comp';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

    $area_academica=$_POST['area_academica'];
    $numeroSala=$_POST['numeroSala'];
    $numeroComp=$_POST['numeroComp'];
    $total=$_POST['total'];

    $stmt = $conexion->prepare("insert into stock_salas_comp(id_area_academica,sala,numero_comp,total_comp) values (?,?,?,?)");
    $stmt->bind_param("issi", $area_academica,$numeroSala,$numeroComp,$total);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

}
else{
    echo "2";
}


?>

