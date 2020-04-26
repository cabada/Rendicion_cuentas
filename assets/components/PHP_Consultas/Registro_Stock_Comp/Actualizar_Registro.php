<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'stock_salas_comp';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){

$id_registro=$_POST['id_registro'];
$area_academica=$_POST['area_academica'];
$numeroSala=$_POST['numeroSala'];
$numeroComp=$_POST['numeroComp'];
$total=$_POST['total'];

$stmt = $conexion->prepare("update stock_salas_comp set
                                            id_area_academica=?,
                                            sala=?,
                                            numero_comp=?,
                                            total_comp=?
                                            where id_stock_comp = $id_registro");

$stmt->bind_param("issi", $area_academica, $numeroSala,
                      $numeroComp,$total);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

}
else{
    echo 2;
}


?>
