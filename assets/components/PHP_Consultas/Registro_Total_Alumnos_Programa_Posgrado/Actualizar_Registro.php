<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'total_alumnos_programa_posgrado';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){
$id_total_prog_posgrado=$_POST['id_total_prog_posgrado'];
$id_carrera=$_POST['id_carrera'];
$cantidad=$_POST['cantidad'];
$porcentaje=$_POST['porcentaje'];
$registrado_en=$_POST['registrado_en'];

$stmt = $conexion->prepare("update total_alumnos_programa_posgrado set
                                  ID_CARRERA=?,
                                  CANTIDAD=?,
                                  PORCENTAJE=?,
                                  REGISTRADO_EN=?
                                  where ID_TOTAL_PROG_POSGRADO=$id_total_prog_posgrado");
$stmt->bind_param("iiss",$id_carrera,$cantidad,$porcentaje,$registrado_en);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo 2;
}
?>