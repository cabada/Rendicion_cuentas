<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'matriculas';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {
$programa_educativo=$_POST['programa_educativo'];
$cantidad_alumnos=$_POST['cantidad_alumnos'];

$stmt = $conexion->prepare("insert into matriculas(programa_educativo, cantidad_alumnos) values (?,?)");
$stmt->bind_param("si",$programa_educativo,$cantidad_alumnos);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo "2";
}

?>
