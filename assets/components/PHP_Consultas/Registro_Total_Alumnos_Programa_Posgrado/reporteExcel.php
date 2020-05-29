<?php
//cabeceras y que permita descargar desde el navegador
     header("Content-Type:application/xls");
     header("Content-Disposition: attachment; filename=Registro_Total_Alumnos_Programa_Posgrado.xls"); //nombre del documento

     require_once "../conexion.php";
     $conexion = conexion();

     $sentencia = ("select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera");
     $query = mysqli_query($conexion,$sentencia);

?>
    <table>
         <tr>
              <h4>Reporte de Registro Total de Alumnos por Programa de Posgrado</h4>
              <th>ID</th>
              <th>Nombre de programa</th>
              <th>Cantidad</th>
              <th>Registrado en</th>
         </tr>
         <?php

         while($registros = mysqli_fetch_assoc($query)){
         ?>
         <tr>
              <td><?php echo utf8_decode($registros['ID_TOTAL_PROG_POSGRADO']); ?></td>
              <td><?php echo utf8_decode($registros['nombre_carrera']); ?></td>
              <td><?php echo utf8_decode($registros['CANTIDAD']); ?></td>
              <td><?php echo utf8_decode($registros['REGISTRADO_EN']); ?></td>
         </tr>
         <?php
         }
         ?>
    </table>