<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'programa_delfin';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){
$id_programa = $_POST['id_programa'];
$nombre_proyecto = $_POST['nombre_proyecto'];
$cantidad_alumnos = $_POST['cantidad_alumnos'];
$id_carrera = $_POST['id_carrera'];
$anio = $_POST['anio'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_termino = $_POST['fecha_termino'];

$id = "";
$sql = "select ID_CARRERA from carreras where NOMBRE_CARRERA ='$id_carrera'";
if ($resultado = $conexion->query($sql)) {
    while ($fila = $resultado->fetch_row()) {
     $id = $fila[0];
    }
}
$stmt = $conexion->prepare("update programa_delfin set
                                  NOMBRE_PROYECTO=?,
                                  CANTIDAD_ALUMNOS=?,
                                  ID_CARRERA=?,
                                  ANIO=?,
                                  FECHA_INICIO=?,
                                  FECHA_TERMINO=?
                                where ID_PROGRAMA = $id_programa");

$stmt->bind_param("siisss", $nombre_proyecto, $cantidad_alumnos,$id_carrera , $anio, $fecha_inicio, $fecha_termino);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo 2;
}


?>