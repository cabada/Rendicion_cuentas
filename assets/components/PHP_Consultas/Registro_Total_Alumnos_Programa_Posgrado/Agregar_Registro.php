<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'total_alumnos_programa_posgrado';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

$programa=$_POST['programa'];
$cantidad=$_POST['cantidad'];
$registrado_en=$_POST['registrado_en'];

$stmt = $conexion->prepare("insert into total_alumnos_programa_posgrado(programa, cantidad, registrado_en) VALUES (?,?,?,?)");
$stmt->bind_param("sis",$programa,$cantidad,$registrado_en);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}
?>