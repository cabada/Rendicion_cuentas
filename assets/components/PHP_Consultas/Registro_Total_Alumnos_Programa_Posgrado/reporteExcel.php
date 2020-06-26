<?php
//cabeceras y que permita descargar desde el navegador
     header("Content-Type:application/xls");
     header("Content-Disposition: attachment; filename=Registro_Total_Alumnos_Programa_Posgrado.xls"); //nombre del documento
     //variables de sesion
     session_start();
     require_once "../conexion.php";

     $conexion = conexion();

?>
          <table>
              <tr>
                  <h4>Reporte de Registro Total de Alumnos por Programa de Posgrado</h4>
                  <th class="text-center align-middle background-table">Nombre de programa</th>
                  <th class="text-center align-middle background-table">Cantidad</th>
                  <th class="text-center align-middle background-table">Porcentaje</th>
                  <th class="text-center align-middle background-table">Registrado en</th>
              </tr>

              <?php

              /*Verifica si la variable global fue definida*/
              if(isset($_SESSION['consulta'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $q = $_SESSION['consulta'];  //query para buscador
                  $sql="select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera 
                    where carreras.NOMBRE_CARRERA LIKE '%$q%'";


              if(isset($_SESSION['consulta_anio'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $p = $_SESSION['consulta_anio'];
                  $sql="select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera 
                    where carreras.NOMBRE_CARRERA LIKE '%$q%'
                    and total_alumnos_programa_posgrado.fecha_creado LIKE '%$p%'";

              }
                  /*Se destruye/quita el valor dentro de la variable global*/
                  unset($_SESSION['consulta']);
                  unset($_SESSION['consulta_anio']);

              }
              /*Sino se cumple el if de arriba, se pasa a este.
        Verifica si la variable global fue definida*/
        elseif (isset($_SESSION['consulta_anio'])) {
            /*Se le pasa el valor de la variable global a $q*/
            $q = $_SESSION['consulta_anio'];
            $sql = "select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera 
                    where total_alumnos_programa_posgrado.fecha_creado LIKE '%$q%'";

            /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta_anio']);
        }

              else{
                  $sql="select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera";

                  unset($_SESSION['consulta']);
                  unset($_SESSION['consulta_anio']);

              }

              $result=mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($result)){
                  $datos=$ver[0]."||".
                      $ver[1]."||".
                      $ver[2]."||".
                      $ver[3];

                  $sql1 ="select sum(cantidad) as cantidad from
                            total_alumnos_programa_posgrado";
                  $result1 = mysqli_query($conexion,$sql1);
                  $ver1 = mysqli_fetch_row($result1);
                  $porcentaje = ($ver[2]*100)/$ver1[0];
                  $porcentaje = round($porcentaje);

                  ?>

              <tr>
                  <td><?php echo($ver[1])?></td>
                  <td><?php echo($ver[2])?></td>
                  <td><?php echo $porcentaje ?></td>
                  <td><?php echo($ver[3])?></td>
              </tr>
         <?php
         }
         ?>
    </table>