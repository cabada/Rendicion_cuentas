<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Reporte de Registro de Coordinacion Educativa.xls"); //nombre del documento

//variables de sesion
session_start();
require_once "../conexion.php";
$conexion = conexion();

$sentencia = ("select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias");
$query = mysqli_query($conexion,$sentencia);
?>

                     <table>
                         <tr>
                             <h4>Registro OrientaTec</h4>
                             <th class="text-center align-middle background-table">Nombre de preparatoria</th>
                             <th class="text-center align-middle background-table">Fecha</th>
                             <th class="text-center align-middle background-table">Cantidad de estudiantes atendidos</th>

                <?php

                /*Verifica si la variable global fue definida*/
                if(isset($_SESSION['consulta'])) {
                    /*Se le pasa el valor de la variable global a $q*/
                    $q = $_SESSION['consulta'];  //query para buscador
                    $sql="select orientatec.ID_ORIENTATEC,
                    orientatec.nombre_preparatoria,
                    orientatec.fecha,
                    orientatec.estudiantes_atendidos 
                  from orientatec
                  where (orientatec.nombre_preparatoria like '%$q%'
                  or orientatec.fecha like '%$q%'
                  or orientatec.estudiantes_atendidos like '%$q%')";

                if (isset($_SESSION['consulta_anio'])) {
                    /*Se le pasa el valor de la variable global a $q*/
                    $p = $_SESSION['consulta_anio'];
                    $sql="select orientatec.ID_ORIENTATEC,
                    orientatec.nombre_preparatoria,
                    orientatec.fecha,
                    orientatec.estudiantes_atendidos 
                    orientatec.from orientatec
                  where (orientatec.nombre_preparatoria like '%$q%'
                  or orientatec.fecha like '%$q%'
                  or orientatec.estudiantes_atendidos like '%$q%')
                  and orientatec.fecha_creado like '%$p%'";  
                }
                unset($_SESSION['consulta']);
                unset($_SESSION['consulta_anio']);
            }
           
                elseif (isset($_SESSION['consulta_anio'])) {
                /*Se le pasa el valor de la variable global a $q*/
                $q = $_SESSION['consulta_anio'];
                $sql="select orientatec.ID_ORIENTATEC,
                orientatec.nombre_preparatoria,
                orientatec.fecha,
                orientatec.estudiantes_atendidos 
                  from orientatec
                  where orientatec.fecha_creado like '%$q%'";
                   /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta_anio']);
                }

                else {
                    $sql="select orientatec.ID_ORIENTATEC,
                    orientatec.nombre_preparatoria,
                    orientatec.fecha,
                    orientatec.estudiantes_atendidos 
                  from orientatec";

                  unset($_SESSION['consulta']);
                  unset($_SESSION['consulta_anio']);  
                    }

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

