<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Reporte de Registro Programa Permanencia.xls"); //nombre del documento

//variables de sesion
session_start();
require_once "../conexion.php";
$conexion = conexion();

?>

                <table>
                   <tr>
                       <h4>Reporte de Registro Programa Permanencia</h4>
                       <th class="text-center align-middle background-table">Nombre programa</th>
                       <th class="text-center align-middle background-table">Porcentaje</th>
                   </tr>

                    <?php

                    /*Verifica si la variable global fue definida*/
                    if(isset($_SESSION['consulta'])) {
                        /*Se le pasa el valor de la variable global a $q*/
                        $q = $_SESSION['consulta'];  //query para buscador
                        $sql = "select 
                            permanencia.ID_PERMANENCIA,
                            carreras.nombre_CARRERA,
                            permanencia.PORCENTAJE 
                            from carreras
                            right join permanencia on carreras.ID_CARRERA = permanencia.ID_CARRERA 
                            where carreras.NOMBRE_CARRERA LIKE '%$q%'";


                        if (isset($_SESSION['consulta_anio'])) {
                            /*Se le pasa el valor de la variable global a $q*/
                            $p = $_SESSION['consulta_anio'];
                            $sql = "select 
                            permanencia.ID_PERMANENCIA,
                            carreras.nombre_CARRERA,
                            permanencia.PORCENTAJE 
                            from carreras
                            right join permanencia on carreras.ID_CARRERA = permanencia.ID_CARRERA
                            where permanencia.fecha_creado LIKE '%$q%'
                            and permanencia.fecha_creado LIKE '%$p%'";

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
                        $sql = "select 
                            permanencia.ID_PERMANENCIA,
                            carreras.nombre_CARRERA,
                            permanencia.PORCENTAJE 
                            from carreras
                            right join permanencia on carreras.ID_CARRERA = permanencia.ID_CARRERA
                            where permanencia.fecha_creado LIKE '%$q%'";

                        /*Se destruye/quita el valor dentro de la variable global*/
                        unset($_SESSION['consulta_anio']);
                    }

                    else {
                        $sql="select 
                            permanencia.ID_PERMANENCIA,
                            carreras.nombre_CARRERA,
                            permanencia.PORCENTAJE 
                            from carreras
                            right join permanencia on carreras.ID_CARRERA = permanencia.ID_CARRERA";

                        unset($_SESSION['consulta']);
                        unset($_SESSION['consulta_anio']);
                    }

                    $result=mysqli_query($conexion,$sql);
                    while($ver=mysqli_fetch_row($result)){
                        $datos=$ver[0]."||".
                            $ver[1]."||".
                            $ver[2];

                        ?>


        <tr>
            <td><?php echo utf8_decode($ver[1])?></td>
            <td><?php echo utf8_decode($ver[1])?></td>
        </tr>
        <?php
    }
    ?>
</table>
