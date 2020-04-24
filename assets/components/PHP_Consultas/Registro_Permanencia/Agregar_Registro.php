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

$programa=$_POST['programa'];
$porcentaje=$_POST['porcentaje'];

$stmt = $conexion->prepare("insert into permanencia (PROGRAMA, PORCENTAJE) values (?,?)");
$stmt->bind_param("ss",$programa,$porcentaje);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo "2";
}

?>
