<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'profesores_tiempo_completo';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){
$id_registro=$_POST['id_registro'];
$grado=$_POST['grado'];
$mujer=$_POST['mujer'];
$hombre=$_POST['hombre'];
$total=$_POST['total'];
$stmt = $conexion->prepare("update profesores_tiempo_completo set
                                                    grado=?,
                                                    mujer=?,
                                                    hombre=?,
                                                    total=? 
                                               where id_prof_tiemp_comp= $id_registro");

$stmt->bind_param("siii",$grado,$mujer, $hombre,$total);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>

