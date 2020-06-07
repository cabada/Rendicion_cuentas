<?php
    //CABEZERAS Y QUE PERMITA DESCARGAR DESDE EL NAVEGADOR
    header("Content-Type:application/xls");
    header("Content-Disposition: attachment; filename=Registro_de_profesores_de_tiempo_completo_por_grado_academico.xls"); //nombre del documento

    // INICIACION DE LAS VARIABLES GLOBALES DE LA SESION
    session_start();
    require_once "../conexion.php";
    $conexion = conexion();
?>

<table>
    <tr>
        <h4 style="text-align: center;">Registro de profesores de tiempo completo por grado académico</h4>
        <td>Grado</td>
        <td>Mujer</td>
        <td>Hombre</td>
        <td>Total</td>
        <td>Porcentaje</td>
    </tr>

    <?php
        // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
        if(isset($_SESSION['consulta'])){
            // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
            $q = $_SESSION['consulta'];
            $sql = "SELECT id_prof_tiemp_comp, grado, mujer, hombre, total, fecha_creado FROM profesores_tiempo_completo 
                WHERE grado LIKE '%$q%' OR mujer LIKE '%$q%' 
                OR hombre LIKE '%$q%' OR total LIKE '%$q%'";

            if(isset($_SESSION['consulta_anio'])){
                $p = $_SESSION['consulta_anio'];
                $sql = "SELECT id_prof_tiemp_comp, grado, mujer, hombre, total, fecha_creado FROM profesores_tiempo_completo 
                    WHERE (grado LIKE '%$q%' OR mujer LIKE '%$q%' 
                    OR hombre LIKE '%$q%' OR total LIKE '%$q%') AND fecha_creado LIKE '%$p%'";
            }
            // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
            unset($_SESSION['consulta']);
            unset($_SESSION['consulta_anio']);
        
        // SI NO SE CUMPLE EL IF DE ARRIBA, SE PASA A ESTE.
        // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
        } else if (isset($_SESSION['consulta_anio'])){
            // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
            $q = $_SESSION['consulta_anio'];
            $sql="SELECT id_prof_tiemp_comp, grado, mujer, hombre, total, fecha_creado FROM profesores_tiempo_completo WHERE fecha_creado LIKE '%$q%'";
            // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
            unset($_SESSION['consulta_anio']);
        
        // SI NO SE CIMPLIO NINGUNO DE ARRIBA, SE VA EJECUTAR ESTA INSTRUCCION QUE ES POR DEFECTO, 
        // ES UNA QUERY PARA VER TODOS LOS REGISTROS DE LA TABLA
        } else {
            unset($_SESSION['consulta_anio']);
            unset($_SESSION['consulta']);
            $sql="SELECT id_prof_tiemp_comp, grado, mujer, hombre, total, fecha_creado FROM profesores_tiempo_completo";
        }

        $result=mysqli_query($conexion,$sql);
        while($buscar=mysqli_fetch_row($result)){
            $datos = $buscar[0]."||".
                $buscar[1]."||".
                $buscar[2]."||".
                $buscar[3]."||".
                $buscar[4]."||".
                $buscar[5];

        $sql1="SELECT SUM(total) AS total FROM profesores_tiempo_completo";
        $resultado1 = mysqli_query($conexion,$sql1);
        $buscar1=mysqli_fetch_row($resultado1);
        $total = $buscar1[0];
        $porcentaje = ($buscar[4] * 100)/$total;
        $porcentaje = round($porcentaje);
    ?>

    <tr>
        <td><?php echo utf8_decode($buscar[1])?></td>
        <td><?php echo utf8_decode($buscar[2])?></td>
        <td><?php echo utf8_decode($buscar[3])?></td>
        <td><?php echo utf8_decode($buscar[4])?></td>
        <td><?php echo utf8_decode($porcentaje)?>%</td>
    </tr>

    <?php
        }
    ?>
    <tr style="font-weight: bold">
        <td>Total</td>

        <?php
            $sql="SELECT SUM(mujer) AS mujer FROM profesores_tiempo_completo";
            $resultado = mysqli_query($conexion,$sql);
            $buscar=mysqli_fetch_row($resultado);
        ?>

        <td><?php echo $buscar[0]; ?></td>

        <?php
            $sql="SELECT SUM(hombre) AS hombre FROM profesores_tiempo_completo";
            $resultado = mysqli_query($conexion,$sql);
            $buscar=mysqli_fetch_row($resultado);
        ?>

        <td><?php echo $buscar[0]; ?></td>

        <?php
            $sql="SELECT SUM(total) AS total FROM profesores_tiempo_completo";
            $resultado = mysqli_query($conexion,$sql);
            $buscar=mysqli_fetch_row($resultado);
        ?>

        <td><?php echo $buscar[0]; ?></td>
        <td>100%</td>
    </tr>
</table>