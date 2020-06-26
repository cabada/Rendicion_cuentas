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
                             <h4>Reporte de Registro de Coordinacion Educativa</h4>
                             <th class="text-center align-middle background-table">Nombre actividad</th>
                             <th class="text-center align-middle background-table">Periodo ENE-JUN</th>
                             <th class="text-center align-middle background-table">Periodo AGO-DIC</th>
                         </tr>
                <?php

                /*Verifica si la variable global fue definida*/
                if(isset($_SESSION['consulta'])) {
                    /*Se le pasa el valor de la variable global a $q*/
                    $q = $_SESSION['consulta'];  //query para buscador
                    $sql = "select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias 
                            where coordinacion_educativa_y_tutorias.NOMBRE_ACTIVIDAD LIKE '%$q%'";

                    if (isset($_SESSION['consulta_anio'])) {
                        /*Se le pasa el valor de la variable global a $q*/
                        $p = $_SESSION['consulta_anio'];
                        $sql = "select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias
                            where coordinacion_educativa_y_tutorias.NOMBRE_ACTIVIDAD LIKE '%$q%'
                            and fecha_creado LIKE '%$p%'";


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
                $sql = "select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias
                            where fecha_creado LIKE '%$q%'";

            /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta_anio']);
            }

                else {
                    $sql="select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias";

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
            <td><?php echo $ver[1]?></td>
            <td><?php echo $ver[2]?></td>
            <td><?php echo $ver[3]?></td>
        </tr>
        <?php
    }
    ?>
</table>

