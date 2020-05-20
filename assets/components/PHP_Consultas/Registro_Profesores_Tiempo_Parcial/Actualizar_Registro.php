<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'profesores_tiempo_parcial';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){

$id_prof_tmp_parc=$_POST['id_prof_tmp_parc'];
$cantidad_tiempo_parcial=$_POST['cantidad_tiempo_parcial'];
$grado=$_POST['grado'];

$stmt = $conexion->prepare("update profesores_tiempo_parcial set
                                   cantidad_tiempo_parcial=?,
                                   grado=?
                                   where id_prof_tmp_parc=$id_prof_tmp_parc");

$stmt->bind_param("is", $cantidad_tiempo_parcial,$grado);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

}
else{
    echo 2;
}

?>
