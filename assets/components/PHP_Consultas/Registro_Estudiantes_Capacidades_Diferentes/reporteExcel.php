<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Reporte de Registro de Estudiantes con Capacidades Diferentes.xls"); //nombre del documento

//variables de sesion
session_start();
require_once "../conexion.php";
$conexion = conexion();

?>

<table>
    <tr>
        <h4>Reporte de Registro de Estudiantes con Capacidades Diferentes</h4>
        <th class="text-center align-middle background-table">Periodo</th>
        <th class="text-center align-middle background-table">Año</th>
        <th class="text-center align-middle background-table">Cantidad de estudiantes</th>
    </tr>

    <?php
                              /*Verifica si la variable global fue definida*/
                              if(isset($_SESSION['consulta'])) {
                                  /*Se le pasa el valor de la variable global a $q*/
                                  $q = $_SESSION['consulta'];  //query para buscador
                                  $sql = "select id_estudiantes_capacidades_diferentes,PERIODO,ANIO,CANTIDAD_ALUMNOS 
                              from estudiantes_capacidades_diferentes 
                              where estudiantes_capacidades_diferentes.PERIODO LIKE '%$q%'
                              or estudiantes_capacidades_diferentes.ANIO LIKE '%$q%'";
                                  /*Se destruye/quita el valor dentro de la variable global*/
                                  unset($_SESSION['consulta']);
                              }
                      /*Sino se cumple el if de arriba, se pasa a este.
                      Verifica si la variable global fue definida*/
                      elseif (isset($_SESSION['consulta_anio'])) {
                     /*Se le pasa el valor de la variable global a $q*/
                     $q = $_SESSION['consulta_anio'];
                     $sql = "select id_estudiantes_capacidades_diferentes,PERIODO,ANIO,CANTIDAD_ALUMNOS 
                              from estudiantes_capacidades_diferentes
                              where fecha_creado LIKE '%$q%'";
                          /*Se destruye/quita el valor dentro de la variable global*/
                          unset($_SESSION['consulta_anio']);
                     }
                     /*Sino se cumplio ninguno de arriba, se va a ejecutar esta instruccion que es la de por defecto. Es una query para ver todos los registros
                     de la tabla.*/
                     else{
                         $sql="select id_estudiantes_capacidades_diferentes,PERIODO,ANIO,CANTIDAD_ALUMNOS 
                              from estudiantes_capacidades_diferentes";
                     }
    $result=mysqli_query($conexion,$sql);
    while($ver=mysqli_fetch_row($result)){
        $datos = $ver[0] . "||" .
            $ver[1] . "||" .
            $ver[2] . "||" .
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
