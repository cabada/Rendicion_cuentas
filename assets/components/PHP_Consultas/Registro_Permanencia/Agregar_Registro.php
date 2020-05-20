<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'permanencia';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

$id_carrera=$_POST['permanencia'];
$porcentaje=$_POST['porcentaje'];
$porcentaje = strval($porcentaje);

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
