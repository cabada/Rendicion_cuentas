<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'moocs_alumnos';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {


$cursos_mooc=$_POST['cursos_mooc'];
$numero_alumnos_inscritos=$_POST['numero_alumnos_inscritos'];

$stmt = $conexion->prepare("insert into moocs_alumnos (cursos_mooc,numero_alumnos_inscritos) values (?,?)");
$stmt->bind_param("si", $cursos_mooc,$numero_alumnos_inscritos);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo "2";
}

?>

