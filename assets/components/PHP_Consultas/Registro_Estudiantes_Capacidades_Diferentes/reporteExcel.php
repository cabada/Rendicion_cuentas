<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Reporte de Registro de Estudiantes con Capacidades Diferentes.xls"); //nombre del documento

require_once "../conexion.php";
$conexion = conexion();

$sentencia = ("select id_estudiantes_capacidades_diferentes,PERIODO,ANIO,CANTIDAD_ALUMNOS 
                              from estudiantes_capacidades_diferentes");
$query = mysqli_query($conexion,$sentencia);
?>
<table>
    <tr>
        <h4>Reporte de Registro de Estudiantes con Capacidades Diferentes</h4>
        <th>ID</th>
        <th>Periodo</th>
        <th>Año</th>
        <th>Cantidad de estudiantes</th>
    </tr>
    <?php

    while($registros = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?php echo utf8_decode($registros['id_estudiantes_capacidades_diferentes']); ?></td>
            <td><?php echo utf8_decode($registros['PERIODO']); ?></td>
            <td><?php echo utf8_decode($registros['ANIO']); ?></td>
            <td><?php echo utf8_decode($registros['CANTIDAD_ALUMNOS']); ?></td>
        </tr>
        <?php
    }
    ?>
</table>
