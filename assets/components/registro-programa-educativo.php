
<?php

require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de programa educativo</h2>
        <caption>
            <button class="btn btn-page-theme-2" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <br>
        <table class="table table-hover table-condensed table-bordered table-striped white-background">
            <br>
            <tr>
                <td class="centered-table-title">Carrera</td>
                <td class="centered-table-title">Modalidad</td>
                <td class="centered-table-title">Nuevo ingreso</td>
                <td class="centered-table-title">Reingreso</td>
                <td class="centered-table-title">Estatus</td>
                <td class="centered-table-title">Periodo</td>
                <td class="centered-table-title">Total</td>
                <td class="centered-table-title">Editar</td>
                <td class="centered-table-title">Eliminar</td>
            </tr>

            <?php

            $sql="select 
                        programa_educativo.id_programa_educativo,
                        carreras.nombre_carrera,
                        programa_educativo.modalidad,
                        programa_educativo.nuevo_ingreso,
                        programa_educativo.reingreso,
                        programa_educativo.estatus,
                        programa_educativo.periodo 
                        from carreras 
                        right join programa_educativo on carreras.id_carrera = programa_educativo.id_carrera";

            $resultado = mysqli_query($conexion,$sql);

            while($buscar=mysqli_fetch_row($resultado)) {

            $datos = $buscar[0]."||".
                $buscar[1]."||".
                $buscar[2]."||".
                $buscar[3]."||".
                $buscar[4]."||".
                $buscar[5]."||".
                $buscar[6];

            ?>

            <tr>
                <td><?php echo $buscar[1]?></td>
                <td><?php echo $buscar[2]?></td>
                <td><?php echo $buscar[3]?></td>
                <td><?php echo $buscar[4]?></td>
                <td><?php echo $buscar[5]?></td>
                <td><?php echo $buscar[6]?></td>
                <td><?php echo $buscar[3] + $buscar[4]?></td>
                <td class="centered-table-title"><button class="btn btn-warning"  data-toggle="modal" data-target="#modalEdicion" onclick="agregaForm('<?php echo $datos ?>')"><i class="far fa-edit"></i></button></td>
                <td class="centered-table-title"><button class="btn btn-danger"><i class="far fa-window-close"></i></button></td>
            </tr>

                <?php

            }
            ?>

        </table>
    </div>
</div>