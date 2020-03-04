
<?php

require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de programa educativo</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Carrera</td>
                    <td class="text-center align-middle background-table">Modalidad</td>
                    <td class="text-center align-middle background-table">Nuevo ingreso</td>
                    <td class="text-center align-middle background-table">Reingreso</td>
                    <td class="text-center align-middle background-table">Estatus</td>
                    <td class="text-center align-middle background-table">Periodo</td>
                    <td class="text-center align-middle background-table">Total</td>
                    <td class="text-center align-middle background-table">Acciones</td>
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
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>  Eliminar</button>
                    </td>
                </tr>

                <?php
                }
                ?>

            </table>
        </div>
    </div>
</div>