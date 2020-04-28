<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'moocs';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){
$id_moocs=$_POST['id_moocs'];
$periodo=$_POST['periodo'];
$numero_docentes=$_POST['numero_docentes'];

$stmt = $conexion->prepare("update moocs set
                                   periodo=?,
                                    numero_docentes=?
                                   where id_moocs=$id_moocs");

$stmt->bind_param("si", $periodo,$numero_docentes);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
}
else{
    echo 2;
}


?>
