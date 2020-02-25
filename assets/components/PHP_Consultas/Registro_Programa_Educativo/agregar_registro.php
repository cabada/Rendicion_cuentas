<?php


require_once "../Conexion.php";
$conexion = conexion();
$id_profesor = $_POST['id_profesor'];
$nombre_completo = $_POST['nombre_completo'];
$sexo = $_POST['sexo'];
$grado_estudios = $_POST['grado_estudios'];
$horas_jornada = $_POST['horas_jornada'];
$area_academica = $_POST['area_academica'];
$disciplina = $_POST['disciplina'];
$vigencia = $_POST['vigencia'];
$area_experiencia = $_POST['area_experiencia'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$stmt = $conexion->prepare("update profesores set
                                                    nombre_completo=?,
                                                    sexo=?,
                                                    grado_estudios=?,
                                                    hora_jornada=?,
                                                    id_area_academica=?,
                                                    id_disciplina=?,
                                                    vigencia=?,
                                                    area_experiencia=?,
                                                    fecha_ingreso=? 
                                               where id_profesor = $id_profesor");

$stmt->bind_param("ssssiisss", $nombre_completo, $sexo, $grado_estudios,
    $horas_jornada, $area_academica, $disciplina, $vigencia, $area_experiencia, $fecha_ingreso);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();


?>
