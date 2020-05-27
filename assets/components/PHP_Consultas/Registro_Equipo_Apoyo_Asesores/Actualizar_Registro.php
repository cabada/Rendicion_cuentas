<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'equipo_apoyo_asesores_pda';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){

$id_equipo_apoyo_as=$_POST['id_equipo_apoyo_as'];
$nombre=$_POST['nombre'];
$puesto=$_POST['puesto'];
$grado_estudios=$_POST['grado_estudios'];
$funciones=$_POST['funciones'];

$stmt = $conexion->prepare("update equipo_apoyo_asesores_pda set
                                   nombre=?,
                                   puesto=?,
                                   grado_estudios=?,
                                   funciones_med_tecnm=?
                                   where id_equipo_apoyo=$id_equipo_apoyo_as");

$stmt->bind_param("ssss", $nombre,$puesto,$grado_estudios,$funciones);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}


?>
