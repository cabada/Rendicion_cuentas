<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'estudiantes_capacidades_diferentes';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {
$periodo=$_POST['periodo'];
$anio=$_POST['anio'];
$cantidad_alumnos=$_POST['cantidad_alumnos'];

$stmt = $conexion->prepare("insert into estudiantes_capacidades_diferentes(periodo, anio, cantidad_alumnos) VALUES (?,?,?)");
$stmt->bind_param("sii",$periodo,$anio,$cantidad_alumnos);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}

?>
