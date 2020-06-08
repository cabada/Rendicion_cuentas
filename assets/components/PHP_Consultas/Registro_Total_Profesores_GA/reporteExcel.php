<?php
    //CABEZERAS Y QUE PERMITA DESCARGAR DESDE EL NAVEGADOR
    header("Content-Type:application/xls");
    header("Content-Disposition: attachment; filename=Registro_total_de_profesores_por_grado_academico.xls"); //nombre del documento

    // INICIACION DE LAS VARIABLES GLOBALES DE LA SESION
    session_start();
    require_once "../conexion.php";
    $conexion = conexion();
?>

<table>
    <tr>
        <h4 style="text-align: center;">Registro total de profesores por grado académico</h4>
        <th>Grado</th>
        <th>Cantidad</th>
        <th>Porcentaje</th>
    </tr>

    <?php
        // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
        if(isset($_SESSION['consulta'])){
            // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
            $q = $_SESSION['consulta'];
            $sql = "SELECT id_prof_grado_acad, grado, cantidad, fecha_creado FROM total_profesores_grado_academico 
                WHERE grado LIKE '%$q%' OR cantidad LIKE '%$q%'";

            if(isset($_SESSION['consulta_anio'])){
                $p = $_SESSION['consulta_anio'];
                $sql = "SELECT id_prof_grado_acad, grado, cantidad, fecha_creado FROM total_profesores_grado_academico 
                    WHERE (grado LIKE '%$q%' OR cantidad LIKE '%$q%') AND fecha_creado LIKE '%$p%'";
            }
            // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
            unset($_SESSION['consulta']);
            unset($_SESSION['consulta_anio']);
        
        // SI NO SE CUMPLE EL IF DE ARRIBA, SE PASA A ESTE.
        // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
        } else if (isset($_SESSION['consulta_anio'])){
            // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
            $q = $_SESSION['consulta_anio'];
            $sql="SELECT id_prof_grado_acad, grado, cantidad, fecha_creado 
                FROM total_profesores_grado_academico WHERE fecha_creado LIKE '%$q%'";
            // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
            unset($_SESSION['consulta_anio']);
        
        // SI NO SE CIMPLIO NINGUNO DE ARRIBA, SE VA EJECUTAR ESTA INSTRUCCION QUE ES POR DEFECTO, 
        // ES UNA QUERY PARA VER TODOS LOS REGISTROS DE LA TABLA
        } else {
            unset($_SESSION['consulta_anio']);
            unset($_SESSION['consulta']);
            $sql="SELECT id_prof_grado_acad, grado, cantidad, fecha_creado FROM total_profesores_grado_academico";
        }

        $result=mysqli_query($conexion,$sql);
        while($buscar=mysqli_fetch_row($result)){
            $datos = $buscar[0]."||".
                $buscar[1]."||".
                $buscar[2]."||".
                $buscar[3];

                $sql1="SELECT SUM(cantidad) AS cantidad FROM total_profesores_grado_academico";
                $resultado1 = mysqli_query($conexion,$sql1);
                $buscar1=mysqli_fetch_row($resultado1);
                $total = $buscar1[0];
                $porcentaje = ($buscar[2] * 100)/$total;
                $porcentaje = round($porcentaje);
    ?>

    <tr>
        <td><?php echo utf8_decode($buscar[1])?></td>
        <td><?php echo utf8_decode($buscar[2])?></td>
        <td><?php echo utf8_decode($porcentaje)?>%</td>
    </tr>

    <?php
        }
    ?>

    <tr style="font-weight: bold">
        <td>Total profesores</td>

        <?php
            $sql="SELECT SUM(cantidad) AS cantidad FROM total_profesores_grado_academico";
            $resultado = mysqli_query($conexion,$sql);
            $buscar=mysqli_fetch_row($resultado);
        ?>

        <td><?php echo $buscar[0]; ?></td>
        <td>100%</td>
    </tr>
</table>