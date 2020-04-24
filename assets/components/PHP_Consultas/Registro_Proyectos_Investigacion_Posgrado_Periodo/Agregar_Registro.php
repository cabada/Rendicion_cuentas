<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'proyectos_investigacion_posgrado_periodo';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

$clave=$_POST['clave'];
$nombre_proyecto=$_POST['nombre_proyecto'];
$responsable=$_POST['responsable'];

$stmt = $conexion->prepare("insert into proyectos_investigacion_posgrado_periodo(clave,nombre_proyecto,responsable) values (?,?,?)");
$stmt->bind_param("sss",$clave,$nombre_proyecto,$responsable);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}

?>
