<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'total_alumnos_programa_posgrado';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

$programa=$_POST['programa'];
$cantidad=$_POST['cantidad'];
$registrado_en=$_POST['registrado_en'];

$stmt = $conexion->prepare("insert into total_alumnos_programa_posgrado(id_carrera, cantidad, registrado_en) VALUES (?,?,?)");
$stmt->bind_param("iis",$programa,$cantidad,$registrado_en);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}
?>