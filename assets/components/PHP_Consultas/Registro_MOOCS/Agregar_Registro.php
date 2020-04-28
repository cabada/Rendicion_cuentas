<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'moocs';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

$periodo=$_POST['periodo'];
$numero_docentes=$_POST['numero_docentes'];

$stmt = $conexion->prepare("insert into moocs (periodo,numero_docentes) values (?,?)");
$stmt->bind_param("si", $periodo,$numero_docentes);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}


?>

