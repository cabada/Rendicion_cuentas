<?php

require_once "../Conexion.php";
$conexion = conexion();

$nombre_completo=$_POST['nombre_completo'];
$sexo=$_POST['sexo'];
$grado_estudios=$_POST['grado_estudios'];
$horas_jornada=$_POST['horas_jornada'];
$area_academica=$_POST['area_academica'];
$disciplina = $_POST['disciplina'];
$vigencia = $_POST['vigencia'];
$area_experiencia = $_POST['area_experiencia'];
$fecha_ingreso = $_POST['fecha_ingreso'];


$stmt = $conexion->prepare("insert into profesores(
                                        nombre_completo,
                                        sexo,
                                        grado_estudios,
                                        hora_jornada,
                                        id_area_academica,
                                        id_disciplina,
                                        vigencia,
                                        area_experiencia,
                                        fecha_ingreso)
                                        values (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssiisss",$nombre_completo,$sexo, $grado_estudios,
    $horas_jornada,$area_academica,$disciplina,$vigencia,$area_experiencia,$fecha_ingreso);

echo $resultado = $stmt->execute();

if(!$resultado){
    echo "No salio";
}

else{
    echo "Si salio";
}

$stmt->close();
$conexion->close();

?>