<?php
    //cabeceras y que permita descargar desde el navegador 
    header("Content-Type:application/xls");
    header("Content-Disposition: attachment; filename=registro_evaluacion_docente_2020.xls"); //nombre del documento

    require_once "../conexion.php";
    $conexion = conexion();

    $sentencia = ("SELECT id_eva_docente, periodo, docentes_activos_evaluados, porcentaje FROM evaluacion_docente");
    $query = mysqli_query($conexion,$sentencia);
?>
    <table>
            <tr>
                <h4>Reporte de Registro Evaliacion Docente</h4>

                <th>ID</th>
                <th>Periodo</th>
                <th>Docentes Activos Evaluados</th>
                <th>Porcentaje</th>
            </tr>
        <?php

        while($registros = mysqli_fetch_assoc($query)){
        ?>
            <tr>
                <td><?php echo utf8_decode($registros['id_eva_docente']); ?></td>
                <td><?php echo utf8_decode($registros['periodo']); ?></td>
                <td><?php echo utf8_decode($registros['docentes_activos_evaluados']); ?></td>
                <td><?php echo utf8_decode($registros['porcentaje']); ?></td>
            </tr>
        <?php
        }
        ?>
  </table>
