<?php

    require_once "PHP_Consultas/Conexion.php";
    $conexion = conexion();

?>


<div class="row">

    <div class="col-sm-12">
        <h2>Registro de profesores</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre completo</td>
                    <td class="text-center align-middle background-table">Sexo</td>
                    <td class="text-center align-middle background-table">Grado de estudios</td>
                    <td class="text-center align-middle background-table">Horas de jornada</td>
                    <td class="text-center align-middle background-table">Área académica</td>
                    <td class="text-center align-middle background-table">Disciplina</td>
                    <td class="text-center align-middle background-table">Vigencia</td>
                    <td class="text-center align-middle background-table">Área de experiencia</td>
                    <td class="text-center align-middle background-table">Fecha de ingreso</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php

                $sql="select id_profesor,nombre_completo,sexo,grado_estudios,hora_jornada,id_area_academica,
                    id_disciplina,vigencia,area_experiencia,fecha_ingreso from profesores";

                $resultado = mysqli_query($conexion,$sql);

                while($buscar=mysqli_fetch_row($resultado)) {

                $datos = $buscar[0]."||".
                    $buscar[1]."||".
                    $buscar[2]."||".
                    $buscar[3]."||".
                    $buscar[4]."||".
                    $buscar[5]."||".
                    $buscar[6]."||".
                    $buscar[7]."||".
                    $buscar[8]."||".
                    $buscar[9];

                ?>


                <tr>
                    <td><?php echo $buscar[1]?></td>
                    <td><?php echo $buscar[2]?></td>
                    <td><?php echo $buscar[3]?></td>
                    <td><?php echo $buscar[4]?></td>
                    <td><?php echo $buscar[5]?></td>
                    <td><?php echo $buscar[6]?></td>
                    <td><?php echo $buscar[7]?></td>
                    <td><?php echo $buscar[8]?></td>
                    <td><?php echo $buscar[9]?></td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" onclick="agregaform('<?php echo $datos?>')" data-toggle="modal" data-target="#modalEdicion"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $buscar[0]?>')"><i class="fas fa-trash"></i>  Eliminar</button>
                    </td>
                </tr>

                    <?php

                }
                ?>

            </table>
        </div>
    </div>
</div>