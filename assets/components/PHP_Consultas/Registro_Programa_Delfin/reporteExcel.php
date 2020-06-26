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
                             <h4>Registro Programa Delfin</h4>
                             <th class="text-center align-middle background-table">Nombre de proyecto</th>
                             <th class="text-center align-middle background-table">Cantidad de alumnos</th>
                             <th class="text-center align-middle background-table">Carrera</th>
                             <th class="text-center align-middle background-table">Año</th>
                             <th class="text-center align-middle background-table">Fecha de inicio</th>
                             <th class="text-center align-middle background-table">Fecha de terminación</th>
                         </tr>
                <?php

                /*Verifica si la variable global fue definida*/
                if(isset($_SESSION['consulta'])) {
                    /*Se le pasa el valor de la variable global a $q*/
                    $q = $_SESSION['consulta'];  //query para buscador
                    $sql="select
                            programa_delfin.id_programa,
                            programa_delfin.nombre_proyecto,
                            programa_delfin.cantidad_alumnos,
                            carreras.nombre_carrera,
                            programa_delfin.anio,
                            programa_delfin.fecha_inicio,
                            programa_delfin.fecha_termino
                            from carreras
                            right join programa_delfin on carreras.ID_CARRERA = programa_delfin.ID_CARRERA
                            where (
                            programa_delfin.nombre_proyecto like '%$q%'
                            or programa_delfin.cantidad_alumnos like '%$q%'
                            or carreras.nombre_carrera like '%$q%'
                            or programa_delfin.anio like '%$q%'
                            or programa_delfin.fecha_inicio like '%$q%'
                            or programa_delfin.fecha_termino like '%$q%')";
                    

                if (isset($_SESSION['consulta_anio'])) {
                    /*Se le pasa el valor de la variable global a $q*/
                    $p = $_SESSION['consulta_anio'];
                    $sql="select
                            programa_delfin.id_programa,
                            programa_delfin.nombre_proyecto,
                            programa_delfin.cantidad_alumnos,
                            carreras.nombre_carrera,
                            programa_delfin.anio,
                            programa_delfin.fecha_inicio,
                            programa_delfin.fecha_termino
                            from carreras
                            right join programa_delfin on carreras.ID_CARRERA = programa_delfin.ID_CARRERA
                            where (
                            programa_delfin.nombre_proyecto like '%$q%'
                            or programa_delfin.cantidad_alumnos like '%$q%'
                            or carreras.nombre_carrera like '%$q%'
                            or programa_delfin.anio like '%$q%'
                            or programa_delfin.fecha_inicio like '%$q%'
                            or programa_delfin.fecha_termino like '%$q%')
                            and programa_delfin.fecha_creado like '%$p%'";
                    
                }
                unset($_SESSION['consulta']);
                unset($_SESSION['consulta_anio']);
            }
           
                elseif (isset($_SESSION['consulta_anio'])) {
                /*Se le pasa el valor de la variable global a $q*/
                $q = $_SESSION['consulta_anio'];
                $sql="select
                programa_delfin.id_programa,
                programa_delfin.nombre_proyecto,
                programa_delfin.cantidad_alumnos,
                carreras.nombre_carrera,
                programa_delfin.anio,
                programa_delfin.fecha_inicio,
                programa_delfin.fecha_termino
                from carreras
                right join programa_delfin on carreras.ID_CARRERA = programa_delfin.ID_CARRERA
                where programa_delfin.fecha_creado like '%$q%'";
                /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta_anio']);
                }

                else {
                    $sql="select
                        programa_delfin.id_programa,
                        programa_delfin.nombre_proyecto,
                        programa_delfin.cantidad_alumnos,
                        carreras.nombre_carrera,
                        programa_delfin.anio,
                        programa_delfin.fecha_inicio,
                        programa_delfin.fecha_termino
                        from carreras
                        right join programa_delfin on carreras.ID_CARRERA = programa_delfin.ID_CARRERA";
                      unset($_SESSION['consulta']);
                      unset($_SESSION['consulta_anio']);  
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

