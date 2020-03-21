<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_sabatico=$_POST['id_sabatico'];
$profesor=$_POST['profesor'];
$proyecto_realizado=$_POST['proyecto_realizado'];

$stmt = $conexion->prepare("update producto_anio_sabatico set
                                   profesor=?,
                                    proyecto_realizado=?
                                   where id_sabatico=$id_sabatico");

$stmt->bind_param("ss", $profesor,$proyecto_realizado);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
