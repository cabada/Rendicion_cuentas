<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'orientatec';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

   $nombre_preparatoria=$_POST['nombre_preparatoria'];
   $fecha=$_POST['fecha'];
   $estudiantes_atendidos=$_POST['estudiantes_atendidos'];

$stmt = $conexion->prepare("insert into orientatec(nombre_preparatoria, fecha, estudiantes_atendidos) values (?,?,?)");
$stmt->bind_param("ssi",$nombre_preparatoria,$fecha,$estudiantes_atendidos);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();


}
else{
   echo "2";
}


?>
