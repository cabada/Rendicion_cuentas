<?php
//cabeceras y que permita descargar desde el navegador
     header("Content-Type:application/xls");
     header("Content-Disposition: attachment; filename=Registro_Equipo_Apoyo_Asesores.xls"); //nombre del documento
     //variables de sesion
     session_start();
     require_once "../conexion.php";

     $conexion = conexion();

?>
          <table>
              <tr>
                  <h4>Reporte de Registro de equipo de apoyo de asesores PDA</h4>
                  <th class="text-center align-middle background-table">Nombre</th>
                  <th class="text-center align-middle background-table">Puesto</th>
                  <th class="text-center align-middle background-table">Grado de estudios</th>
                  <th class="text-center align-middle background-table">Funciones TECNM</th>

              </tr>

              <?php

              /*Verifica si la variable global fue definida*/
              if(isset($_SESSION['consulta'])) {
                  /*Se le pasa el valor de la variable global a $q*/
                  $q = $_SESSION['consulta'];  //query para buscador

                  $sql = "select id_equipo_apoyo,nombre,puesto,grado_estudios,funciones_med_tecnm from equipo_apoyo_asesores_pda
            where nombre like '%$q%'
            or puesto like '%$q%'
            or grado_estudios like '%$q%'
            or funciones_med_tecnm like '%$q%'";


                  /*Sino se cumple el if de arriba, se pasa a este.
            Verifica si la variable global fue definida*/
                  if (isset($_SESSION['consulta_anio'])) {
                      /*Se le pasa el valor de la variable global a $q*/
                      $p = $_SESSION['consulta_anio'];

                      $sql = "select id_equipo_apoyo,nombre,puesto,grado_estudios,funciones_med_tecnm 
            from equipo_apoyo_asesores_pda
            where nombre like '%$q%'
            or puesto like '%$q%'
            or grado_estudios like '%$q%'
            or funciones_med_tecnm like '%$q%'
            and fecha_creado like '%$p%'";

                  }
                  /*Se destruye/quita el valor dentro de la variable global*/

                  unset($_SESSION['consulta']);
                  unset($_SESSION['consulta_anio']);
              }
              /*Sino se cumplio ninguno de arriba, se va a ejecutar esta instruccion que es la de por defecto. Es una query para ver todos los registros
        de la tabla.*/
              elseif(isset($_SESSION['consulta_anio'])){
                  $q=$_SESSION['consulta_anio'];

                  $sql="select id_equipo_apoyo,nombre,puesto,grado_estudios,funciones_med_tecnm 
                        from equipo_apoyo_asesores_pda,
                        where fecha_creado like '%$q%'";

                  unset($_SESSION[consulta_anio]);


              }
              else{

                  $sql="select id_equipo_apoyom, nombre, puesto, grado_estudios, funciones_med_tecnm from equipo_apoyo_asesores_pda";
                  unset($_SESSION['consulta']);
                  unset($_SESSION['consulta_anio']);
              }

              $result=mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($result)){
                  $datos = $ver[0] . "||" .
                      $ver[1] . "||" .
                      $ver[2] . "||" .
                      $ver[3] . "||" .
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