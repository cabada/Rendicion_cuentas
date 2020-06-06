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
                  <h4>Reporte de Registro de Cuerpos Academicos Pertenecientes a Posgrado</h4>
                  <td class="text-center align-middle background-table">Nombre de cuerpo académico</td>
                  <td class="text-center align-middle background-table">Grado</td>
                  <td class="text-center align-middle background-table">Estado</td>
                  <td class="text-center align-middle background-table">Año de registro</td>
                  <td class="text-center align-middle background-table">Vigencia</td>
                  <td class="text-center align-middle background-table">Área</td>
              </tr>

              <?php

              /*Verifica si la variable global fue definida*/
              if(isset($_SESSION['consulta'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $q = $_SESSION['consulta'];  //query para buscador
                  $sql="select   id_cuerpos_academicos_posgrado, nombre_cuerpo, 
                      grado, estado, anio_registro, vigencia, area 
                      from cuerpos_academicos_posgrado
                      where nombre_cuerpo like '%$q%'
                      or grado like '%$q%'
                      or estado like '%$q%'
                      or anio_registro like '%$q%'
                      or vigencia like '%$q%'
                      or area like '%$q%'
                      ";

                  /*Se destruye/quita el valor dentro de la variable global*/
                  unset($_SESSION['consulta']);
              }

              /*Sino se cumple el if de arriba, se pasa a este.
        Verifica si la variable global fue definida*/
              elseif (isset($_SESSION['consulta_anio'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $q = $_SESSION['consulta_anio'];
                  $sql="select   id_cuerpos_academicos_posgrado, nombre_cuerpo, 
                      grado, estado, anio_registro, vigencia, area 
                      from cuerpos_academicos_posgrado 
                      where fecha_creado like '%$q%'";

           /*Se destruye/quita el valor dentro de la variable global*/
                  unset($_SESSION['consulta_anio']);
              }
              /*Sino se cumplio ninguno de arriba, se va a ejecutar esta instruccion que es la de por defecto. Es una query para ver todos los registros
        de la tabla.*/
              else{
                  $sql="select   id_cuerpos_academicos_posgrado, nombre_cuerpo, 
                      grado, estado, anio_registro, vigencia, area 
                      from cuerpos_academicos_posgrado ";
              }

              $result=mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($result)){
                  $datos=$ver[0]."||".
                      $ver[1]."||".
                      $ver[2]."||".
                      $ver[3]."||".
                      $ver[4]."||".
                      $ver[5]."||".
                      $ver[6];

                  ?>

              <tr>
                  <td><?php echo utf8_decode($ver[1])?></td>
                  <td><?php echo utf8_decode($ver[2])?></td>
                  <td><?php echo utf8_decode($ver[3])?></td>
                  <td><?php echo utf8_decode($ver[4])?></td>
                  <td><?php echo utf8_decode($ver[5])?></td>
                  <td><?php echo utf8_decode($ver[6])?></td>
              </tr>
         <?php
         }
         ?>
    </table>