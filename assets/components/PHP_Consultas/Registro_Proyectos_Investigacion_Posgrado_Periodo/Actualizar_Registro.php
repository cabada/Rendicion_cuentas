<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_proyecto_inv_posgrado_periodo=$_POST['id_proyecto_inv_posgrado_periodo'];
$clave=$_POST['clave'];
$nombre_proyecto=$_POST['nombre_proyecto'];
$responsable=$_POST['responsable'];

$stmt = $conexion->prepare("update proyectos_investigacion_posgrado_periodo set
                                    CLAVE=?,
                                    NOMBRE_PROYECTO=?,
                                    RESPONSABLE=?
                                    where ID_PROYECTO_INV_POSGRADO_PERIODO=$id_proyecto_inv_posgrado_periodo");

$stmt->bind_param("sss",$clave,$nombre_proyecto,$responsable);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();
?>
