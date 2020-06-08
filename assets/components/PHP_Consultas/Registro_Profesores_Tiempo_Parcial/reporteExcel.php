<?php
    //CABEZERAS Y QUE PERMITA DESCARGAR DESDE EL NAVEGADOR
    header("Content-Type:application/xls");
    header("Content-Disposition: attachment; filename=Registro_tiempo_parcial_profesores.xls"); //nombre del documento

    // INICIACION DE LAS VARIABLES GLOBALES DE LA SESION
    session_start();
    require_once "../conexion.php";
    $conexion = conexion();
?>

<table>
    <tr>
        <h4 style="text-align: center;">Registro tiempo parcial profesores</h4>
        <th>Cantidad de Profesores en Tiempo Parcial</th>
        <th>Grado</th>
        <th>Total</th>
    </tr>

    <?php
        // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
        if(isset($_SESSION['consulta'])){
            // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
            $q = $_SESSION['consulta'];
            $sql = "SELECT id_prof_tmp_parc, cantidad_tiempo_parcial, grado, fecha_creado FROM profesores_tiempo_parcial 
                WHERE cantidad_tiempo_parcial LIKE '%$q%' OR grado LIKE '%$q%'";

            if(isset($_SESSION['consulta_anio'])){
                $p = $_SESSION['consulta_anio'];
                $sql = "SELECT id_prof_tmp_parc, cantidad_tiempo_parcial, grado, fecha_creado 
                    FROM profesores_tiempo_parcial WHERE (cantidad_tiempo_parcial LIKE '%$q%' 
                    OR grado LIKE '%$q%') AND fecha_creado LIKE '%$p%'";
            }
            // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
            unset($_SESSION['consulta']);
            unset($_SESSION['consulta_anio']);
        
        // SI NO SE CUMPLE EL IF DE ARRIBA, SE PASA A ESTE.
        // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
        } else if (isset($_SESSION['consulta_anio'])){
            // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
            $q = $_SESSION['consulta_anio'];
            $sql="SELECT id_prof_tmp_parc, cantidad_tiempo_parcial, grado, fecha_creado 
                FROM profesores_tiempo_parcial WHERE fecha_creado LIKE '%$q%'";
            // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
            unset($_SESSION['consulta_anio']);
        
        // SI NO SE CIMPLIO NINGUNO DE ARRIBA, SE VA EJECUTAR ESTA INSTRUCCION QUE ES POR DEFECTO, 
        // ES UNA QUERY PARA VER TODOS LOS REGISTROS DE LA TABLA
        } else {
            unset($_SESSION['consulta_anio']);
            unset($_SESSION['consulta']);
            $sql="SELECT id_prof_tmp_parc, cantidad_tiempo_parcial, grado, fecha_creado FROM profesores_tiempo_parcial";
        }

        $result=mysqli_query($conexion,$sql);
        while($buscar=mysqli_fetch_row($result)){
            $datos = $buscar[0]."||".
                $buscar[1]."||".
                $buscar[2]."||".
                $buscar[3];
    ?>

    <tr>
        <td><?php echo utf8_decode($buscar[1])?></td>
        <td><?php echo utf8_decode($buscar[2])?></td>
        <td></td>
    </tr>

    <?php
        }
    ?>

</table>