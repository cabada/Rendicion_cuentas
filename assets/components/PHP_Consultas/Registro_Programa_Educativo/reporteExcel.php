<?php
    //CABEZERAS Y QUE PERMITA DESCARGAR DESDE EL NAVEGADOR
    header("Content-Type:application/xls");
    header("Content-Disposition: attachment; filename=Registro_programa_educativo.xls"); //nombre del documento

    // INICIACION DE LAS VARIABLES GLOBALES DE LA SESION
    session_start();
    require_once "../conexion.php";
    $conexion = conexion();
?>

<table>
    <tr>
        <h4 style="text-align: center;">Registro programa educativo</h4>
        <td>Carrera</td>
        <td>Modalidad</td>
        <td>Nuevo ingreso</td>
        <td>Reingreso</td>
        <td>Estatus</td>
        <td>Periodo</td>
        <td>Total</td>
    </tr>

    <?php
        // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
        if(isset($_SESSION['consulta'])){
            // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
            $q = $_SESSION['consulta'];
            $sql = "SELECT 
                programa_educativo.id_programa_educativo,
                carreras.nombre_carrera,
                programa_educativo.modalidad,
                programa_educativo.nuevo_ingreso,
                programa_educativo.reingreso,
                programa_educativo.estatus,
                programa_educativo.periodo, 
                programa_educativo.fecha_creado
                FROM carreras 
                RIGHT JOIN programa_educativo ON carreras.id_carrera = programa_educativo.id_carrera 
                WHERE carreras.nombre_carrera LIKE '%$q%' OR programa_educativo.modalidad LIKE '%$q%' 
                OR programa_educativo.estatus LIKE '%$q%' OR programa_educativo.periodo LIKE '%$q%'";

            if(isset($_SESSION['consulta_anio'])){
                $p = $_SESSION['consulta_anio'];
                $sql = "SELECT 
                    programa_educativo.id_programa_educativo,
                    carreras.nombre_carrera,
                    programa_educativo.modalidad,
                    programa_educativo.nuevo_ingreso,
                    programa_educativo.reingreso,
                    programa_educativo.estatus,
                    programa_educativo.periodo, 
                    programa_educativo.fecha_creado
                    FROM carreras 
                    RIGHT JOIN programa_educativo ON carreras.id_carrera = programa_educativo.id_carrera 
                    WHERE (carreras.nombre_carrera LIKE '%$q%' OR programa_educativo.modalidad LIKE '%$q%' 
                    OR programa_educativo.estatus LIKE '%$q%' OR programa_educativo.periodo LIKE '%$q%') 
                    AND programa_educativo.fecha_creado LIKE '%$p%'";
            }
            // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
            unset($_SESSION['consulta']);
            unset($_SESSION['consulta_anio']);
        
        // SI NO SE CUMPLE EL IF DE ARRIBA, SE PASA A ESTE.
        // VERIFICA SI LA VARIABLE GLOBAL FUE DEFINIDA
        } else if (isset($_SESSION['consulta_anio'])){
            // SE LE PASA EL VALOR DE LA VARIABLE GLOBAL A $q
            $q = $_SESSION['consulta_anio'];
            $sql="SELECT 
                programa_educativo.id_programa_educativo,
                carreras.nombre_carrera,
                programa_educativo.modalidad,
                programa_educativo.nuevo_ingreso,
                programa_educativo.reingreso,
                programa_educativo.estatus,
                programa_educativo.periodo, 
                programa_educativo.fecha_creado 
                FROM carreras 
                RIGHT JOIN programa_educativo ON carreras.id_carrera = programa_educativo.id_carrera 
                WHERE programa_educativo.fecha_creado LIKE '%$q%'";
            // SE DESTRUYE/QUITA EL VALOR DENTRO DE LA VARIABLE GLOBAL
            unset($_SESSION['consulta_anio']);
        
        // SI NO SE CIMPLIO NINGUNO DE ARRIBA, SE VA EJECUTAR ESTA INSTRUCCION QUE ES POR DEFECTO, 
        // ES UNA QUERY PARA VER TODOS LOS REGISTROS DE LA TABLA
        } else {
            unset($_SESSION['consulta_anio']);
            unset($_SESSION['consulta']);
            $sql="SELECT 
                programa_educativo.id_programa_educativo,
                carreras.nombre_carrera,
                programa_educativo.modalidad,
                programa_educativo.nuevo_ingreso,
                programa_educativo.reingreso,
                programa_educativo.estatus,
                programa_educativo.periodo, 
                programa_educativo.fecha_creado 
                FROM carreras 
                RIGHT JOIN programa_educativo ON carreras.id_carrera = programa_educativo.id_carrera";
        }

        $result=mysqli_query($conexion,$sql);
        while($buscar=mysqli_fetch_row($result)){
            $datos = $buscar[0]."||".
                $buscar[1]."||".
                $buscar[2]."||".
                $buscar[3]."||".
                $buscar[4]."||".
                $buscar[5]."||".
                $buscar[6]."||".
                $buscar[7];

                $suma = $buscar[3]+$buscar[4];
    ?>

    <tr>
        <td><?php echo utf8_decode($buscar[1])?></td>
        <td><?php echo utf8_decode($buscar[2])?></td>
        <td><?php echo utf8_decode($buscar[3])?></td>
        <td><?php echo utf8_decode($buscar[4])?></td>
        <td><?php echo utf8_decode($buscar[5])?></td>
        <td><?php echo utf8_decode($buscar[6])?></td>
        <td><?php echo utf8_decode($suma)?></td>
    </tr>

    <?php
        }
    ?>

    <tr style="font-weight: bold">
        <td>Total</td>

        <?php
            $sql = "SELECT SUM(nuevo_ingreso) AS nuevo_ingreso FROM programa_educativo";
            $resultado = $conexion->query($sql);
            $buscar = mysqli_fetch_row($resultado);
        ?>

        <td></td>
        <td><?php echo $buscar[0]; ?></td>

        <?php
            $sql = "SELECT SUM(reingreso) AS reingreso FROM programa_educativo";
            $resultado = $conexion->query($sql);
            $buscar = mysqli_fetch_row($resultado);
        ?>

        <td><?php echo $buscar[0]; ?></td>
        <td></td>
        <td></td>

        <?php
            $sql = "SELECT SUM(total) AS total FROM programa_educativo";
            $resultado = $conexion->query($sql);
            $buscar = mysqli_fetch_row($resultado);
        ?>

        <td><?php echo $buscar[0]; ?></td>
    </tr>
</table>