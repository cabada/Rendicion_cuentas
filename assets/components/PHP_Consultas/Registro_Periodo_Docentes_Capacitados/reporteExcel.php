<?php
//cabeceras y que permita descargar desde el navegador
     header("Content-Type:application/xls");
     header("Content-Disposition: attachment; filename=Registro_Periodo_Docentes_Capacitados.xls"); //nombre del documento
     //variables de sesion
     session_start();
     require_once "../conexion.php";

     $conexion = conexion();

?>
          <table>
              <tr>
                  <h4>Reporte de Periodo de Docentes Capacitados</h4>
                  <th class="text-center align-middle background-table">Tipo de Nombramiento</th>
                  <th class="text-center align-middle background-table">Total de docentes</th>
                  <th class="text-center align-middle background-table">No. de docentes capacitados</th>
                  <th class="text-center align-middle background-table">Porcentaje de docentes capacitados</th>
                  <th class="text-center align-middle background-table">Periodo</th>
              </tr>

              <?php

              /*Verifica si la variable global fue definida*/
              if(isset($_SESSION['consulta'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $q = $_SESSION['consulta'];  //query para buscador
                  $sql="select id_periodo_docentes_capacitados,
                            tipo_nombramiento,
                            total_docentes,
                            no_docentes_capacitados,
                            porcentaje_docentes_capacitados,
                            periodo
                            from periodo_docentes_capacitados
                            where tipo_nombramiento like '%$q%' 
                            or periodo like '%$q%'";


              if(isset($_SESSION['consulta_anio'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $p = $_SESSION['consulta_anio'];
                  $sql = "select id_periodo_docentes_capacitados,
                            tipo_nombramiento,
                            total_docentes,
                            no_docentes_capacitados,
                            porcentaje_docentes_capacitados,
                            periodo
                            from periodo_docentes_capacitados
                            where tipo_nombramiento like '%$q%' 
                            or periodo like '%$q%'
                            and fecha_creado like '%$p%'";

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
            $sql = "select id_periodo_docentes_capacitados,
                            tipo_nombramiento,
                            total_docentes,
                            no_docentes_capacitados,
                            porcentaje_docentes_capacitados,
                            periodo
                            from periodo_docentes_capacitados
                            where fecha_creado like '%$q%'";

            /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta_anio']);
        }

              else{
                  $sql = "select id_periodo_docentes_capacitados,
                            tipo_nombramiento,
                            total_docentes,
                            no_docentes_capacitados,
                            porcentaje_docentes_capacitados,
                            periodo
                            from periodo_docentes_capacitados";

                  unset($_SESSION['consulta']);
                  unset($_SESSION['consulta_anio']);

              }

              $result=mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($result)){
                  $datos=$ver[0]."||".
                      $ver[1]."||".
                      $ver[2]."||".
                      $ver[3]."||".
                      $ver[4]."||".
                      $ver[5];

                  ?>

              <tr>
                  <td><?php echo($ver[1])?></td>
                  <td><?php echo($ver[2])?></td>
                  <td><?php echo($ver[3])?></td>
                  <td><?php echo($ver[4])?></td>
                  <td><?php echo($ver[5])?></td>
              </tr>
         <?php
         }
         ?>
    </table>