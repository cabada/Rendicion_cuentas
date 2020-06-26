<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Reporte de Registro Tutorias.xls"); //nombre del documento

require_once "../conexion.php";
$conexion = conexion();

$sentencia = ("select id_tutorias,tutores_registrados, alumnos_tuto_grupal,encuentro_padres,conferencias_alumnos,
                alumnos_asistieron_conferencias from tutorias");
$query = mysqli_query($conexion,$sentencia);

?>
<table>
    <tr>
        <h4 style="text-align: center">Reporte de Registro Tutorias</h4>
        <th>ID</th>
        <th>Tutores registrados  </th>
        <th>Cantidad de alumnos grupal</th>
        <th>Cantidad de encuentro con padres</th>
        <th>Cantidad de conferencias a alumnos</th>
        <th>Cantidad de alumnos en conferencia</th>
    </tr>
    <?php

    while($registros = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?php echo utf8_decode($registros['id_tutorias']); ?></td>
            <td><?php echo utf8_decode($registros['tutores_registrados']); ?></td>
            <td><?php echo utf8_decode($registros['alumnos_tuto_grupal']); ?></td>
            <td><?php echo utf8_decode($registros['encuentro_padres']); ?></td>
            <td><?php echo utf8_decode($registros['conferencias_alumnos']); ?></td>
            <td><?php echo utf8_decode($registros['alumnos_asistieron_conferencias']); ?></td>
        </tr>
        <?php
    }
    ?>
</table>
