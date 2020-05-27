<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'programa_delfin';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){

$id_programa = $_POST['id_programa'];

$stmt = $conexion->prepare("delete from programa_delfin where ID_PROGRAMA=?");
$stmt->bind_param('i',$id_programa);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
