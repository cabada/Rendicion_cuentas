<?php

require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de programa delfín</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
                <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de proyecto</td>
                    <td class="text-center align-middle background-table">Cantidad de alumnos</td>
                    <td class="text-center align-middle background-table">Carrera</td>
                    <td class="text-center align-middle background-table">Año</td>
                    <td class="text-center align-middle background-table">Fecha de inicio</td>
                    <td class="text-center align-middle background-table">Fecha de terminación</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                    <?php

                        $sql="select
                            programa_delfin.id_programa,
                            programa_delfin.nombre_proyecto,
                            programa_delfin.cantidad_alumnos,
                            carreras.nombre_carrera,
                            programa_delfin.anio,
                            programa_delfin.fecha_inicio,
                            programa_delfin.fecha_termino
                             from carreras
                             right join programa_delfin on carreras.ID_CARRERA = programa_delfin.ID_CARRERA";
                    $result=mysqli_query($conexion,$sql);
                    while($ver=mysqli_fetch_row($result)){

                        $datos=$ver[0]."||".
                            $ver[1]."||".
                            $ver[2]."||".
                            $ver[3]."||".
                            $ver[4]."||".
                            $ver[5]."||".
                            $ver[6];

                    ?>

                <tr>
                    <td><?php echo $ver[1]?></td>
                    <td><?php echo $ver[2]?></td>
                    <td><?php echo $ver[3]?></td>
                    <td><?php echo $ver[4]?></td>
                    <td><?php echo $ver[5]?></td>
                    <td><?php echo $ver[6]?></td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos?>')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $ver[0] ?>')"><i class="fas fa-trash"></i>  Eliminar</button>
                    </td>
                </tr>
                    <?php
                    }
                    ?>
            </table>
        </div>
</div>