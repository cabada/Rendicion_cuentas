<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'evaluacion_docente';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {
     $periodo=$_POST['periodo'];
     $docentes_evaluados=$_POST['docentes_evaluados'];
     $porcentaje=$_POST['porcentaje'];

$stmt = $conexion->prepare("insert into evaluacion_docente(periodo, docentes_activos_evaluados, porcentaje) values (?,?,?)");
$stmt->bind_param("sis",$periodo,$docentes_evaluados,$porcentaje);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();


}
else{
     echo "2";
}




?>
