<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'profesores_certificaciones';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){
$id_profesor=$_POST['id_profesor'];
$nombre_completo=$_POST['nombre_completo'];
$area_academica=$_POST['area_academica'];
$disciplina = $_POST['disciplina'];

$stmt = $conexion->prepare("update profesores set
                                                    nombre_completo=?,
                                                    id_area_academica=?,
                                                    disciplina=? 
                                               where id_profesor = $id_profesor");

$stmt->bind_param("sis",$nombre_completo,$area_academica,$disciplina);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
