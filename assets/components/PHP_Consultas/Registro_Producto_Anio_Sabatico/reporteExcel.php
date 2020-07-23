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
                  <h4>Reporte de Registro de Año Sabático</h4>
                  <th class="text-center align-middle background-table">Nombre de profesor(a)</th>
                  <th class="text-center align-middle background-table">Proyecto realizado</th>
              </tr>

              <?php

              /*Verifica si la variable global fue definida*/
              if(isset($_SESSION['consulta'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $q = $_SESSION['consulta'];  //query para buscador
                  $sql = "select id_sabatico,profesor,proyecto_realizado
                            from producto_anio_sabatico
                            where profesor like '%$q%'
                            or proyecto_realizado like '%$q%'";


              if(isset($_SESSION['consulta_anio'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $p = $_SESSION['consulta_anio'];
                  $sql = "select id_sabatico,profesor,proyecto_realizado
                                        from producto_anio_sabatico
                                        where profesor like '%$q%'
                                        or proyecto_realizado like '%$q%'
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
            $sql = "select id_sabatico,profesor,proyecto_realizado
                            from producto_anio_sabatico
                            where fecha_creado like '%$q%'";

            /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta_anio']);
        }

              else{
                  $sql = "select id_sabatico,profesor,proyecto_realizado
                                        from producto_anio_sabatico";

                  unset($_SESSION['consulta']);
                  unset($_SESSION['consulta_anio']);

              }

              $result=mysqli_query($conexion,$sql);
              while($buscar=mysqli_fetch_row($result)){
                  $datos = $buscar[0] . "||" .
                      $buscar[1] . "||" .
                      $buscar[2];

                  ?>

              <tr>
                  <td><?php echo($buscar[1])?></td>
                  <td><?php echo($buscar[2])?></td>
              </tr>
         <?php
         }
         ?>
    </table>