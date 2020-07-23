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
                  <h4>Reporte de Registro de Cursos de Formación Docente y Actualización Profesional</h4>
                  <th class="text-center align-middle background-table">Nombre del curso</th>
                  <th class="text-center align-middle background-table">Periodo</th>
                  <th class="text-center align-middle background-table">No. de participantes</th>
                  <th class="text-center align-middle background-table">No. de capacitaión</th>
              </tr>

              <?php

              /*Verifica si la variable global fue definida*/
              if(isset($_SESSION['consulta'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $q = $_SESSION['consulta'];  //query para buscador
                  $sql="select id_curso,nombre_curso,periodo,num_participantes,horas_capacitacion
                            from cursos_formacion_docente_actualizacion_profesional
                            where nombre_curso like '%$q%'
                            or periodo like '%$q%'";


              if(isset($_SESSION['consulta_anio'])){
                  /*Se le pasa el valor de la variable global a $q*/
                  $p = $_SESSION['consulta_anio'];
                  $sql="select id_curso,nombre_curso,periodo,num_participantes,horas_capacitacion
                            from cursos_formacion_docente_actualizacion_profesional
                            where nombre_curso like '%$q%'
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
            $sql="select id_curso,nombre_curso,periodo,num_participantes,horas_capacitacion
                            from cursos_formacion_docente_actualizacion_profesional
                            where fecha_creado like '%$q%'";

            /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta_anio']);
        }

              else{
                  $sql="select id_curso,nombre_curso,periodo,num_participantes,horas_capacitacion
                            from cursos_formacion_docente_actualizacion_profesional";

                  unset($_SESSION['consulta']);
                  unset($_SESSION['consulta_anio']);

              }

              $result=mysqli_query($conexion,$sql);
              while($buscar=mysqli_fetch_row($result)){
                  $datos=$buscar[0]."||".
                      $buscar[1]."||".
                      $buscar[2]."||".
                      $buscar[3]."||".
                      $buscar[4];

                  ?>

              <tr>
                  <td><?php echo($buscar[1])?></td>
                  <td><?php echo($buscar[2])?></td>
                  <td><?php echo($buscar[3])?></td>
                  <td><?php echo($buscar[4])?></td>
              </tr>
         <?php
         }
         ?>
    </table>