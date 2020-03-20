<?php

require_once "../Conexion.php";
$conexion = conexion();

     $periodo=$_POST['periodo'];
     $docentes_evaluados=$_POST['docentes_evaluados'];
     $porcentaje=$_POST['porcentaje'];

$stmt = $conexion->prepare("insert into evaluacion_docente(periodo, docentes_activos_evaluados, porcentaje) values (?,?,?)");
$stmt->bind_param("sis",$periodo,$docentes_evaluados,$porcentaje);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>
