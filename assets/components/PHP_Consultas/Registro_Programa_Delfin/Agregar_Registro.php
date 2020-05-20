<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'programa_delfin';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

     $nombre_proyecto=$_POST['nombre_proyecto'];
     $cantidad_alumnos=$_POST['cantidad_alumnos'];
     $id_carrera=$_POST['id_carrera'];
     $anio=$_POST['anio'];
     $fecha_inicio=$_POST['fecha_inicio'];
     $fecha_termino=$_POST['fecha_termino'];

$stmt = $conexion->prepare("insert into programa_delfin(nombre_proyecto, cantidad_alumnos, id_carrera, anio, fecha_inicio, fecha_termino) values (?,?,?,?,?,?)");
$stmt->bind_param("siisss",$nombre_proyecto,$cantidad_alumnos,$id_carrera,$anio,$fecha_inicio,$fecha_termino);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

}
else{
     echo "2";
}


?>
