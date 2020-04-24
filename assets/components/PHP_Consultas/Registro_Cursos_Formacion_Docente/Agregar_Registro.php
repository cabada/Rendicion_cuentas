<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'cursos_formacion_docente_actualizacion_profesional';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {
$nombre_curso=$_POST['nombre_curso'];
$periodo=$_POST['periodo'];
$num_participantes=$_POST['num_participantes'];
$horas_capacitacion=$_POST['horas_capacitacion'];

$stmt = $conexion->prepare("insert into cursos_formacion_docente_actualizacion_profesional 
                                (nombre_curso,periodo,num_participantes,horas_capacitacion) values (?,?,?,?)");
$stmt->bind_param("ssii", $nombre_curso,$periodo,$num_participantes,$horas_capacitacion);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}

?>

