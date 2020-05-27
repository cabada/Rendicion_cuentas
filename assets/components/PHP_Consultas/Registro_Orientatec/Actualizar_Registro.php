<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'orientatec';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){

$id_orientatec=$_POST['id_orientatec'];
$nombre_preparatoria=$_POST['nombre_preparatoria'];
$fecha=$_POST['fecha'];
$estudiantes_atendidos=$_POST['estudiantes_atendidos'];

$stmt = $conexion->prepare("update orientatec set
                                   NOMBRE_PREPARATORIA=?,
                                   FECHA=?,
                                   ESTUDIANTES_ATENDIDOS=?
                                   where ID_ORIENTATEC=$id_orientatec");

$stmt->bind_param("ssi",$nombre_preparatoria,$fecha,$estudiantes_atendidos);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();


}
else{
    echo 2;
}

?>
