<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'cuerpos_academicos_posgrado';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {
$nombre_cuerpo=$_POST['nombre_cuerpo'];
$grado=$_POST['grado'];
$estado=$_POST['estado'];
$anio_registro=$_POST['anio_registro'];
$vigencia=$_POST['vigencia'];
$area=$_POST['area'];

$stmt = $conexion->prepare("insert into cuerpos_academicos_posgrado (NOMBRE_CUERPO, GRADO, ESTADO, ANIO_REGISTRO, VIGENCIA, AREA) values (?,?,?,?,?,?)");
$stmt->bind_param("sssiss", $nombre_cuerpo,$grado,$estado,$anio_registro,$vigencia,$area );

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}

?>
