<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'permanencia';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

$id_carrera=$_POST['id_carrera'];
$porcentaje=$_POST['porcentaje'];

$stmt = $conexion->prepare("insert into permanencia (ID_CARRERA, PORCENTAJE) values (?,?)");
$stmt->bind_param("is",$id_carrera,$porcentaje);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo "2";
}

?>
