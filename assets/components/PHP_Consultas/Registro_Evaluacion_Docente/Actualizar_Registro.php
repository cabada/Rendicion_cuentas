<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_evaluacion_doc = $_POST['id_evaluacion_doc'];
$periodo = $_POST['periodo'];
$docentes_evaluados = $_POST['docentes_evaluados'];
$porcentaje = $_POST['porcentaje'];

$stmt = $conexion->prepare("update evaluacion_docente set
                                  periodo=?,
                                  docentes_activos_evaluados=?,
                                  porcentaje=?
                                where id_eva_docente = $id_evaluacion_doc");

$stmt->bind_param("sis", $periodo, $docentes_evaluados,$porcentaje);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>