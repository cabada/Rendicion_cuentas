<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_total_prog_posgrado=$_POST['id_total_prog_posgrado'];
$programa=$_POST['programa'];
$cantidad=$_POST['cantidad'];
$porcentaje=$_POST['porcentaje'];
$registrado_en=$_POST['registrado_en'];

$stmt = $conexion->prepare("update total_alumnos_programa_posgrado set
                                  PROGRAMA=?,
                                  CANTIDAD=?,
                                  PORCENTAJE=?,
                                  REGISTRADO_EN=?
                                  where ID_TOTAL_PROG_POSGRADO=$id_total_prog_posgrado");
$stmt->bind_param("siss",$programa,$cantidad,$porcentaje,$registrado_en);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>