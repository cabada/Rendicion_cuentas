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
                  <h4>Reporte de Registro de Aulas Equipadas con Equipo Informatico Por Carreras</h4>
                  <th class="text-center align-middle background-table">Area Academica</th>
                  <th class="text-center align-middle background-table">Numero de Salas con Computadoras</th>
                  <th class="text-center align-middle background-table">Numero de Computadoras por Sala</th>
                  <th class="text-center align-middle background-table">Total de Computadoras</th>
              </tr>

              <?php

              /*Verifica si la variable global fue definida*/
              if(isset($_SESSION['consulta'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $q = $_SESSION['consulta'];  //query para buscador
                  $sql="select stock_salas_comp.id_stock_comp,
                                area_academica.nombre_area_academica,
                                stock_salas_comp.sala,
                                stock_salas_comp.numero_comp,
                                stock_salas_comp.total_comp
                                from stock_salas_comp
                                join area_academica
                                on area_academica.id_area_academica = stock_salas_comp.id_area_academica
                                where area_academica.nombre_area_academica like '%$q%'";
                  /*Se destruye/quita el valor dentro de la variable global*/
                  unset($_SESSION['consulta']);
              }

              /*Sino se cumple el if de arriba, se pasa a este.
        Verifica si la variable global fue definida*/
              elseif (isset($_SESSION['consulta_anio'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $q = $_SESSION['consulta_anio'];
                  $sql="select stock_salas_comp.id_stock_comp,
                                area_academica.nombre_area_academica,
                                stock_salas_comp.sala,
                                stock_salas_comp.numero_comp,
                                stock_salas_comp.total_comp
                                from stock_salas_comp
                                join area_academica
                                on area_academica.id_area_academica = stock_salas_comp.id_area_academica
                                where stock_salas_comp.fecha_creado  like '%$q%'";
                  /*Se destruye/quita el valor dentro de la variable global*/
                  unset($_SESSION['consulta_anio']);
              }
              /*Sino se cumplio ninguno de arriba, se va a ejecutar esta instruccion que es la de por defecto. Es una query para ver todos los registros
        de la tabla.*/
              else{
                  $sql="select stock_salas_comp.id_stock_comp,
                                area_academica.nombre_area_academica,
                                stock_salas_comp.sala,
                                stock_salas_comp.numero_comp,
                                stock_salas_comp.total_comp
                                from stock_salas_comp
                                join area_academica
                                on area_academica.id_area_academica = stock_salas_comp.id_area_academica";
              }

              $result=mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($result)){
                  $datos=$ver[0]."||".
                      $ver[1]."||".
                      $ver[2]."||".
                      $ver[3]."||".
                      $ver[4];

                  ?>

              <tr>
                  <td><?php echo utf8_decode($ver[1])?></td>
                  <td><?php echo utf8_decode($ver[2])?></td>
                  <td><?php echo utf8_decode($ver[3])?></td>
                  <td><?php echo utf8_decode($ver[4])?></td>

              </tr>
         <?php
         }
         ?>
    </table>