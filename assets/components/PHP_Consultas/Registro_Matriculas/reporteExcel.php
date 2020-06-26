<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Reporte de Registro de Cantidad de Matriculas.xls"); //nombre del documento

//variables de sesion
session_start();
require_once "../conexion.php";
$conexion = conexion();

?>
<table>
    <tr>
        <h4>Reporte de Registro de Cantidad de Matriculas</h4>
        <th class="text-center align-middle background-table">Nombre carrera</th>
        <th class="text-center align-middle background-table">Cantidad de alumnos</th>
    </tr>

    <?php
               /*Verifica si la variable global fue definida*/
               if(isset($_SESSION['consulta'])) {
                   /*Se le pasa el valor de la variable global a $q*/
                   $q = $_SESSION['consulta'];  //query para buscador
                   $sql = "select
                   matriculas.ID_MATRICULA,
                   carreras.nombre_carrera,
                   matriculas.CANTIDAD_ALUMNOS
                      from carreras
                      right join matriculas on carreras.ID_CARRERA = matriculas.ID_CARRERA 
                      where carreras.NOMBRE_CARRERA LIKE '%$q%'";


                   if (isset($_SESSION['consulta_anio'])) {
                       /*Se le pasa el valor de la variable global a $q*/
                       $p = $_SESSION['consulta_anio'];
                       $sql = "select
                       matriculas.ID_MATRICULA,
                       carreras.nombre_carrera,
                       matriculas.CANTIDAD_ALUMNOS
                       from carreras
                       right join matriculas on carreras.ID_CARRERA = matriculas.ID_CARRERA 
                       where carreras.NOMBRE_CARRERA LIKE '%$q%'
                       and matriculas.fecha_creado LIKE '%$p%'";

                   }
                   /*Se destruye/quita el valor dentro de la variable global*/
                   unset($_SESSION['consulta']);
                   unset($_SESSION['consulta_anio']);

               }
                   elseif (isset($_SESSION['consulta_anio'])){
                      /*Se le pasa el valor de la variable global a $q*/
                      $q = $_SESSION['consulta_anio'];
                      $sql="select
                       matriculas.ID_MATRICULA,
                       carreras.nombre_carrera,
                       matriculas.CANTIDAD_ALUMNOS
                      from carreras
                      right join matriculas on carreras.ID_CARRERA = matriculas.ID_CARRERA
                      where matriculas.fecha_creado LIKE '%$q%'";

                      /*Se destruye/quita el valor dentro de la variable global*/
                      unset($_SESSION['consulta_anio']);
                  }

                       else{
                       $sql="select
                       matriculas.ID_MATRICULA,
                       carreras.nombre_carrera,
                       matriculas.CANTIDAD_ALUMNOS
                       from carreras
                       right join matriculas on carreras.ID_CARRERA = matriculas.ID_CARRERA";

                           unset($_SESSION['consulta']);
                           unset($_SESSION['consulta_anio']);
               }

    $result = mysqli_query($conexion,$sql);
    while($ver = mysqli_fetch_row($result)){
        $datos = $ver[0]."||".
                 $ver[1]."||".
                 $ver[2];

             ?>
        <tr>
            <td><?php echo($ver[1])?></td>
            <td><?php echo($ver[2])?></td>
        </tr>
        <?php
    }
    ?>
</table>
