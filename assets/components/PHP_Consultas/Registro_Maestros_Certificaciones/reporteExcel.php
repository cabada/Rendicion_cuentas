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
              <h4>Reporte de Registro de Maestros con Certificaciones</h4>
             <th class="text-center align-middle background-table">Nombre</th>
             <th class="text-center align-middle background-table">Área académica</th>
             <th class="text-center align-middle background-table">Disciplina</th>

         </tr>
        <?php
        $sql="select profesores.id_profesor,
                            profesores.nombre_completo,
                            area_academica.nombre_area_academica,
                            profesores.disciplina
                            from profesores
                            join area_academica
                            on area_academica.id_area_academica = profesores.id_area_academica
                            where profesores.id_categoria_profesores = 1";

        $result=mysqli_query($conexion,$sql);
        while($ver=mysqli_fetch_row($result)){

            $datos=$ver[0]."||".
                $ver[1]."||".
                $ver[2]."||".
                $ver[3];
            ?>
         <tr>
             <td><?php echo utf8_decode($ver[1])?></td>
             <td><?php echo utf8_decode($ver[2])?></td>
             <td><?php echo utf8_decode($ver[3])?></td>
         </tr>
         <?php
         }
         ?>
    </table>