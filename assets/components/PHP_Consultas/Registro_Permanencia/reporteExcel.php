<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Reporte de Registro Programa Permanencia.xls"); //nombre del documento

require_once "../conexion.php";
$conexion = conexion();

$sentencia = ("select 
                         permanencia.ID_PERMANENCIA,
                         carreras.nombre_CARRERA,
                         permanencia.PORCENTAJE 
                            from carreras
                            right join permanencia on carreras.ID_CARRERA = permanencia.ID_CARRERA");
$query = mysqli_query($conexion,$sentencia);
?>
<table>
    <tr>
        <h4>Reporte de Registro Programa Permanencia</h4>
        <th>ID</th>
        <th>Nombre programa</th>
        <th>Porcentaje</th>
    </tr>
    <?php

    while($registros = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?php echo utf8_decode($registros['ID_PERMANENCIA']); ?></td>
            <td><?php echo utf8_decode($registros['nombre_CARRERA']); ?></td>
            <td><?php echo utf8_decode($registros['PORCENTAJE']); ?></td>
        </tr>
        <?php
    }
    ?>
</table>
