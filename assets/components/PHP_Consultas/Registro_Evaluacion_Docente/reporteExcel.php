<?php
    //CABEZERAS Y QUE PERMITA DESCARGAR DESDE EL NAVEGADOR
    header("Content-Type:application/xls");
    header("Content-Disposition: attachment; filename=Registro_de_evaluacion_docente.xls"); //nombre del documento

    // INICIACION DE LAS VARIABLES GLOBALES DE LA SESION
    session_start();
    require_once "../conexion.php";
    $conexion = conexion();
?>

<table>
    <tr>
        <h4>Reporte de Registro de Evaluacion Docente</h4>
        <th class="text-center align-middle background-table">Periodo</th>
        <th class="text-center align-middle background-table">Docentes activos evaluados</th>
        <th class="text-center align-middle background-table">Porcentaje</th>
    </tr>

    <?php
        // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
        if(isset($_SESSION['consulta'])){
            // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
            $q = $_SESSION['consulta'];
            $sql = "SELECT id_eva_docente, periodo, docentes_activos_evaluados, porcentaje, fecha_creado
                FROM evaluacion_docente WHERE periodo LIKE '%$q%' OR docentes_activos_evaluados LIKE '%$q%' 
                OR porcentaje LIKE '%$q%'";

            if(isset($_SESSION['consulta_anio'])){
                $p = $_SESSION['consulta_anio'];
                $sql = "SELECT id_eva_docente, periodo, docentes_activos_evaluados, porcentaje, fecha_creado
                    FROM evaluacion_docente WHERE (periodo LIKE '%$q%' OR docentes_activos_evaluados LIKE '%$q%' 
                    OR porcentaje LIKE '%$q%') AND fecha_creado LIKE '%$p%'";
            }
            // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
            unset($_SESSION['consulta']);
            unset($_SESSION['consulta_anio']);
        
        // SI NO SE CUMPLE EL IF DE ARRIBA, SE PASA A ESTE.
        // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
        } else if (isset($_SESSION['consulta_anio'])){
            // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
            $q = $_SESSION['consulta_anio'];
            $sql="SELECT id_eva_docente, periodo, docentes_activos_evaluados, porcentaje, fecha_creado
                FROM evaluacion_docente WHERE fecha_creado LIKE '%$q%'";
            // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
            unset($_SESSION['consulta_anio']);
        
        // SI NO SE CIMPLIO NINGUNO DE ARRIBA, SE VA EJECUTAR ESTA INSTRUCCION QUE ES POR DEFECTO, 
        // ES UNA QUERY PARA VER TODOS LOS REGISTROS DE LA TABLA
        } else {
            unset($_SESSION['consulta_anio']);
            unset($_SESSION['consulta']);
            $sql="SELECT id_eva_docente, periodo, docentes_activos_evaluados, porcentaje, fecha_creado FROM evaluacion_docente";
        }

        $result=mysqli_query($conexion,$sql);
        while($buscar=mysqli_fetch_row($result)){
            $datos = $buscar[0]."||".
                $buscar[1]."||".
                $buscar[2]."||".
                $buscar[3]."||".
                $buscar[4];
    ?>

    <tr>
        <td><?php echo utf8_decode($buscar[1])?></td>
        <td><?php echo utf8_decode($buscar[2])?></td>
        <td><?php echo utf8_decode($buscar[3])?></td>
    </tr>

    <?php
        }
    ?>

</table>