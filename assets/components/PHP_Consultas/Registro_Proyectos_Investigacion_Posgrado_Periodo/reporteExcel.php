<?php
//cabeceras y que permita descargar desde el navegador
       header("Content-Type:application/xls");
       header("Content-Disposition: attachment; filename=Registro_Proyectos_Investigacion_Posgrado_Periodo.xls"); //nombre del documento

       //variables de sesion
       session_start();
       require_once "../conexion.php";
       $conexion = conexion();

?>

<table>
    <tr>
        <h4>Reporte de Registro de Proyectos de Investigacion Pertenecientes a Posgrado</h4>
        <th>Clave</th>
        <th>Nombre del proyecto</th>
        <th>Responsable</th>
    </tr>

    <?php
    /*Verifica si la variable global fue definida*/
    if(isset($_SESSION['consulta'])) {
        /*Se le pasa el valor de la variable global a $q*/
        $q = $_SESSION['consulta'];  //query para buscador
        $sql = "select ID_PROYECTO_INV_POSGRADO_PERIODO,CLAVE,NOMBRE_PROYECTO,RESPONSABLE
                      from proyectos_investigacion_posgrado_periodo 
                      where proyectos_investigacion_posgrado_periodo.CLAVE LIKE '%$q%' or 
                      proyectos_investigacion_posgrado_periodo.NOMBRE_PROYECTO LIKE '%$q%' or 
                      proyectos_investigacion_posgrado_periodo.RESPONSABLE LIKE '%$q%'";

        /*Se destruye/quita el valor dentro de la variable global*/
        unset($_SESSION['consulta']);
    }
    /*Sino se cumple el if de arriba, se pasa a este.
   Verifica si la variable global fue definida*/
    elseif (isset($_SESSION['consulta_anio'])) {
        /*Se le pasa el valor de la variable global a $q*/
        $q = $_SESSION['consulta_anio'];
        $sql = "select ID_PROYECTO_INV_POSGRADO_PERIODO,CLAVE,NOMBRE_PROYECTO,RESPONSABLE
                      from proyectos_investigacion_posgrado_periodo
                      where fecha_creado LIKE '%$q%'";

        /*Se destruye/quita el valor dentro de la variable global*/
        unset($_SESSION['consulta_anio']);
    }
    /*Sino se cumplio ninguno de arriba, se va a ejecutar esta instruccion que es la de por defecto. Es una query para ver todos los registros
        de la tabla.*/
    else{
        $sql="select ID_PROYECTO_INV_POSGRADO_PERIODO,CLAVE,NOMBRE_PROYECTO,RESPONSABLE
                      from proyectos_investigacion_posgrado_periodo";

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
