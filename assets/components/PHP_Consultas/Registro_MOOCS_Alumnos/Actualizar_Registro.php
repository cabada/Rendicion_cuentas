<?php

require_once "../Conexion.php";
$conexion = conexion();

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

?>
