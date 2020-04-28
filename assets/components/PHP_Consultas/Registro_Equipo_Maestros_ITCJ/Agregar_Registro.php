<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'equipo_maestros_itcj';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {

$nombre_docente=$_POST['nombre_docente'];
$categoria=$_POST['categoria'];
$grado_estudios=$_POST['grado_estudios'];
$sni=$_POST['sni'];
$area_especializacion=$_POST['area_especializacion'];
$experiencia_profesional=$_POST['experiencia_profesional'];
$experiencia_docente=$_POST['experiencia_docente'];

$stmt = $conexion->prepare("insert into equipo_maestros_itcj (nombre_docente,categoria_hora,grado_estudios,sni,area_especializacion,experiencia_profesional, experiencia_docente) values (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssii", $nombre_docente,$categoria,$grado_estudios,$sni,$area_especializacion,$experiencia_profesional,$experiencia_docente );

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo "2";
}

?>
