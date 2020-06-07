<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Registro_lineas_investigacion_licenciaturas.xls"); //nombre del documento
//variables de sesion
session_start();
require_once "../conexion.php";

$conexion = conexion();

?>
<table>
    <tr>
        <h4>Reporte de Registro de Lineas de Investigacion (Licenciaturas)</h4>
        <th class="text-center align-middle background-table">Programa</th>
        <th class="text-center align-middle background-table">Linea de Investigacion</th>
    </tr>

    <?php

    /*Verifica si la variable global fue definida*/
    if(isset($_SESSION['consulta'])){
        /*Se le pasa el valor de la variable global a $q*/
        $q = $_SESSION['consulta'];  //query para buscador
        $sql="select lineas_investigacion_licenciatura.ID_LINEA,
                                 carreras.NOMBRE_CARRERA, 
                                 lineas_investigacion_licenciatura.NOMBRE_ESPECIALIDAD
                                 from carreras
                                 right join lineas_investigacion_licenciatura on carreras.ID_CARRERA = lineas_investigacion_licenciatura.ID_CARRERA
                                 where carreras.NOMBRE_CARRERA LIKE '%$q%' or 
                                 lineas_investigacion_licenciatura.NOMBRE_ESPECIALIDAD LIKE '%$q%'";

        /*Se destruye/quita el valor dentro de la variable global*/
        unset($_SESSION['consulta']);
    }

    /*Sino se cumple el if de arriba, se pasa a este.
Verifica si la variable global fue definida*/
    elseif (isset($_SESSION['consulta_anio'])){
        /*Se le pasa el valor de la variable global a $q*/
        $q = $_SESSION['consulta_anio'];
        $sql = "select lineas_investigacion_licenciatura.ID_LINEA,
                                 carreras.NOMBRE_CARRERA, 
                                 lineas_investigacion_licenciatura.NOMBRE_ESPECIALIDAD
                                 from carreras
                                 right join lineas_investigacion_licenciatura on carreras.ID_CARRERA = lineas_investigacion_licenciatura.ID_CARRERA
                                 where lineas_investigacion_licenciatura.fecha_creado LIKE '%$q%'";
        /*Se destruye/quita el valor dentro de la variable global*/
        unset($_SESSION['consulta_anio']);
    }
    /*Sino se cumplio ninguno de arriba, se va a ejecutar esta instruccion que es la de por defecto. Es una query para ver todos los registros
de la tabla.*/
    else{
        $sql = "select lineas_investigacion_licenciatura.ID_LINEA,
                                 carreras.NOMBRE_CARRERA, 
                                 lineas_investigacion_licenciatura.NOMBRE_ESPECIALIDAD
                                 from carreras
                                 right join lineas_investigacion_licenciatura on carreras.ID_CARRERA = lineas_investigacion_licenciatura.ID_CARRERA";
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