<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'cuerpos_academicos';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){
$id_cuerpo_academico=$_POST['id_cuerpo_academico'];
$id_area_academica=$_POST['id_area_academica'];
$nombre_cuerpo_academico=$_POST['nombre_cuerpo_academico'];
$grado=$_POST['grado'];
$estado=$_POST['estado'];
$anio_registro=$_POST['anio_registro'];
$vigencia=$_POST['vigencia'];
$area=$_POST['area'];

$stmt = $conexion->prepare("update cuerpos_academicos set
                                   ID_AREA_ACADEMICA=?,
                                   NOMBRE_CUERPO_ACADEMICO=?,
                                   GRADO=?,
                                   ESTADO=?,
                                   ANIO_REGISTRO=?,
                                   VIGENCIA=?,
                                   AREA=?
                                   where ID_CUERPO_ACADEMICO=$id_cuerpo_academico");

$stmt->bind_param("isssiss",$id_area_academica,$nombre_cuerpo_academico,
                                         $grado,$estado,$anio_registro,$vigencia,$area);
echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

}
else{
    echo 2;
}


?>
