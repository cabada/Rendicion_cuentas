<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Registro_Proyectos_Investigacion_Posgrado_Periodo.xls"); //nombre del documento

require_once "../conexion.php";
$conexion = conexion();

$sentencia = ("select ID_PROYECTO_INV_POSGRADO_PERIODO,CLAVE,NOMBRE_PROYECTO,RESPONSABLE
                      from proyectos_investigacion_posgrado_periodo");
$query = mysqli_query($conexion,$sentencia);

?>
<table>
    <tr>
        <h4>Reporte de Registro de Proyectos de Investigacion Pertenecientes a Posgrado</h4>
        <th>ID</th>
        <th>Clave</th>
        <th>Nombre del proyecto</th>
        <th>Responsable</th>
    </tr>
    <?php

    while($registros = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?php echo utf8_decode($registros['ID_PROYECTO_INV_POSGRADO_PERIODO']); ?></td>
            <td><?php echo utf8_decode($registros['CLAVE']); ?></td>
            <td><?php echo utf8_decode($registros['NOMBRE_PROYECTO']); ?></td>
            <td><?php echo utf8_decode($registros['RESPONSABLE']); ?></td>
        </tr>
        <?php
    }
    ?>
</table>
