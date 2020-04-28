<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'moocs_alumnos';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){

$id_moocs_alumnos=$_POST['id_moocs_alumnos'];
$cursos_mooc=$_POST['cursos_mooc'];
$numero_alumnos_inscritos=$_POST['numero_alumnos_inscritos'];

$stmt = $conexion->prepare("update moocs_alumnos set
                                   cursos_mooc=?,
                                    numero_alumnos_inscritos=?
                                   where id_moocs_alumnos=$id_moocs_alumnos");

$stmt->bind_param("si", $cursos_mooc,$numero_alumnos_inscritos);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();


}
else{
    echo 2;
}


?>
