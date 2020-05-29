<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Reporte de Registro de Cantidad de Matriculas.xls"); //nombre del documento

require_once "../conexion.php";
$conexion = conexion();

$sentencia = ("select
                matriculas.ID_MATRICULA,
                carreras.nombre_carrera,
                matriculas.CANTIDAD_ALUMNOS
                      from carreras
                      right join matriculas on carreras.ID_CARRERA = matriculas.ID_CARRERA");
$query = mysqli_query($conexion,$sentencia);
?>
<table>
    <tr>
        <h4>Reporte de Registro de Cantidad de Matriculas</h4>
        <th>ID</th>
        <th>Nombre carrera</th>
        <th>Cantidad de alumnos</th>
    </tr>
    <?php

    while($registros = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?php echo utf8_decode($registros['ID_MATRICULA']); ?></td>
            <td><?php echo utf8_decode($registros['nombre_carrera']); ?></td>
            <td><?php echo utf8_decode($registros['CANTIDAD_ALUMNOS']); ?></td>
        </tr>
        <?php
    }
    ?>
</table>
