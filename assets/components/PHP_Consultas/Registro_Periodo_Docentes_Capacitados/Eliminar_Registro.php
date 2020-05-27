<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'periodo_docentes_capacitados';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Delete');

$stmt->execute();

if($stmt->fetch()){


$id_periodo=$_POST['id_periodo'];

$stmt = $conexion->prepare("delete from periodo_docentes_capacitados where id_periodo_docentes_capacitados=?");
$stmt->bind_param('i',$id_periodo);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
