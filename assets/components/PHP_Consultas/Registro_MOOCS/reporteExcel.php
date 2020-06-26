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
                             <h4>Registro de cantidad de docentes moocs</h4>
                             <th class="text-center align-middle background-table">Periodo</th>
                             <th class="text-center align-middle background-table">Cantidad de docentes</th>
                         </tr>
                <?php

                /*Verifica si la variable global fue definida*/
                if(isset($_SESSION['consulta'])) {
                    /*Se le pasa el valor de la variable global a $q*/
                    $q = $_SESSION['consulta'];  //query para buscador
                    $sql="select moocs.id_moocs,
                               moocs.periodo,
                               moocs.numero_docentes
                               from moocs
                               where (moocs.periodo like '%$q%'
                               or moocs.numero_docentes like '%$q%')";

                if (isset($_SESSION['consulta_anio'])) {
                    /*Se le pasa el valor de la variable global a $q*/
                    $p = $_SESSION['consulta_anio'];
                    $sql="select moocs.id_moocs,
                               moocs.periodo,
                               moocs.numero_docentes
                               from moocs
                               where (moocs.periodo like '%$q%'
                               or moocs.numero_docentes like '%$q%')
                               and moocs.fecha_creado like '%$p%'"; 
                    
                }
                unset($_SESSION['consulta']);
                unset($_SESSION['consulta_anio']);
            }
           
                elseif (isset($_SESSION['consulta_anio'])) {
                /*Se le pasa el valor de la variable global a $q*/
                $q = $_SESSION['consulta_anio'];
                $sql="select moocs.id_moocs,
                               moocs.periodo,
                               moocs.numero_docentes
                               from moocs
                               where moocs.fecha_creado like '%$q%'";
                /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta_anio']);
                }

                else {
                    $sql="select moocs.id_moocs,
                      moocs.periodo,
                      moocs.numero_docentes
                      from moocs";
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
            <td><?php echo utf8_decode($ver[2])?></td>
            
        </tr>
        <?php
    }
    ?>
</table>

