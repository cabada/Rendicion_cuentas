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

$id_carrera=$_POST['id_carrera'];
$cantidad=$_POST['cantidad'];
$porcentaje=$_POST['porcentaje'];
$registrado_en=$_POST['registrado_en'];

$stmt = $conexion->prepare("insert into total_alumnos_programa_posgrado(ID_CARRERA, cantidad, porcentaje, registrado_en) VALUES (?,?,?,?)");
$stmt->bind_param("iiss",$programa,$cantidad,$porcentaje,$registrado_en);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}
?>