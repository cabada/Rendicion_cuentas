<?php

require_once "../Conexion.php";
$conexion = conexion();
$id_prof_tiemp_comp=$_POST['id_prof_tiemp_comp'];
$grado=$_POST['grado'];
$mujer=$_POST['mujer'];
$hombre=$_POST['hombre'];
$total=$_POST['total'];
$stmt = $conexion->prepare("update profesores_tiempo_completo set
                                                    grado=?,
                                                    mujer=?,
                                                    hombre=?,
                                                    total=? 
                                               where id_prof_tiemp_comp= $id_prof_tiemp_comp");

$stmt->bind_param("siii",$grado,$mujer, $hombre,$total);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();
?>

