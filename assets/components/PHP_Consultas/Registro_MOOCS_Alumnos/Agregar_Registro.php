<?php

require_once "../Conexion.php";
$conexion = conexion();


$cursos_mooc=$_POST['cursos_mooc'];
$numero_alumnos_inscritos=$_POST['numero_alumnos_inscritos'];

$stmt = $conexion->prepare("insert into moocs_alumnos (cursos_mooc,numero_alumnos_inscritos) values (?,?)");
$stmt->bind_param("si", $cursos_mooc,$numero_alumnos_inscritos);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>

