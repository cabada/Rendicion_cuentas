<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'equipo_apoyo_asesores_pda';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {
$nombre=$_POST['nombre'];
$puesto=$_POST['puesto'];
$grado_estudios=$_POST['grado_estudios'];
$funciones=$_POST['funciones'];

$stmt = $conexion->prepare("insert into equipo_apoyo_asesores_pda (nombre,puesto,grado_estudios,funciones_med_tecnm) values (?,?,?,?)");
$stmt->bind_param("ssss", $nombre,$puesto,$grado_estudios,$funciones);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}


?>

