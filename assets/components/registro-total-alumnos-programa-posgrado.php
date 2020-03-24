<?php

require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();

?>
<div class="row">
    <div class="col-sm-12">
        <h2>Registro total de alumnos de programa posgrado</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de programa</td>
                    <td class="text-center align-middle background-table">Cantidad</td>
                    <td class="text-center align-middle background-table">Porcentaje</td>
                    <td class="text-center align-middle background-table">Registrado en</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php
                $sql="select ID_TOTAL_PROG_POSGRADO,PROGRAMA,CANTIDAD,PORCENTAJE,REGISTRADO_EN
                    from total_alumnos_programa_posgrado";
                $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)) {

                    $datos=$ver[0]."||".
                           $ver[1]."||".
                           $ver[2]."||".
                           $ver[3]."||".
                           $ver[4];

                    ?>

                    <tr>
                        <td><?php echo $ver[1] ?></td>
                        <td><?php echo $ver[2] ?></td>
                        <td><?php echo $ver[3] ?></td>
                        <td><?php echo $ver[4] ?></td>
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"><i
                                        class="far fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Eliminar</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>