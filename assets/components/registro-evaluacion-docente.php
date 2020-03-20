<div class="row">
    <div class="col-sm-12">
        <h2>Registro de evaluación docente</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Periodo</td>
                    <td class="text-center align-middle background-table">Docentes activos evaluados</td>
                    <td class="text-center align-middle background-table">Porcentaje</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php

                $sql="select id_eva_docente,periodo,docentes_activos_evaluados,porcentaje from evaluacion_docente";

                $resultado = mysqli_query($conexion,$sql);

                while($buscar=mysqli_fetch_row($resultado)) {

                $datos = $buscar[0]."||".
                    $buscar[1]."||".
                    $buscar[2]."||".
                    $buscar[3];

                ?>

                <tr>
                    <td><?php echo $buscar[1]?></td>
                    <td><?php echo $buscar[2]?></td>
                    <td><?php echo $buscar[3]?></td>
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