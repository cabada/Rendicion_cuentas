<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_periodo=$_POST['id_periodo'];
$tipo_nombramiento=$_POST['tipo_nombramiento'];
$total_docentes=$_POST['total_docentes'];
$no_docentes_capacitados=$_POST['no_docentes_capacitados'];
$porcentaje=$_POST['porcentaje'];
$periodo=$_POST['periodo'];

$stmt = $conexion->prepare("update periodo_docentes_capacitados set
                                            tipo_nombramiento=?,
                                            total_docentes=?,
                                            no_docentes_capacitados=?,
                                            porcentaje_docentes_capacitados=?,
                                            periodo=?
                                            where id_periodo_docentes_capacitados = $id_periodo");

$stmt->bind_param("siiss", $tipo_nombramiento, $total_docentes,$no_docentes_capacitados,$porcentaje,$periodo);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>
