<?php

require_once "../Conexion.php";
$conexion = conexion();

$id_moocs=$_POST['id_moocs'];
$periodo=$_POST['periodo'];
$numero_docentes=$_POST['numero_docentes'];

$stmt = $conexion->prepare("update moocs set
                                   periodo=?,
                                    numero_docentes=?
                                   where id_moocs=$id_moocs");

$stmt->bind_param("si", $periodo,$numero_docentes);

echo $resultado = $stmt->execute();
$stmt->close();
$conexion->close();

?>
