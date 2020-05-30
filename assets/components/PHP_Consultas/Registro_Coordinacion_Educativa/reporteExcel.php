<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Reporte de Registro de Coordinacion Educativa.xls"); //nombre del documento

require_once "../conexion.php";
$conexion = conexion();

$sentencia = ("select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias");
$query = mysqli_query($conexion,$sentencia);
?>
<table>
    <tr>
        <h4>Reporte de Registro de Coordinacion Educativa</h4>
        <th>ID</th>
        <th>Nombre actividad</th>
        <th>Periodo ENE-JUN</th>
        <th>Periodo AGO-DIC</th>
    </tr>
    <?php

    while($registros = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?php echo utf8_decode($registros['id_actividad']); ?></td>
            <td><?php echo utf8_decode($registros['nombre_actividad']); ?></td>
            <td><?php echo utf8_decode($registros['PERIODO_ENE_JUN']); ?></td>
            <td><?php echo utf8_decode($registros['PERIODO_AGO_DIC']); ?></td>
        </tr>
        <?php
    }
    ?>
</table>

