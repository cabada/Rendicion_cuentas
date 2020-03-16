<?php

require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();

?>



<div class="row">
    <div class="col-sm-12">
        <h2>Registro equipo de maestros ITCJ</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de docente</td>
                    <td class="text-center align-middle background-table">Categoría</td>
                    <td class="text-center align-middle background-table">Grado de estudios</td>
                    <td class="text-center align-middle background-table">SNI</td>
                    <td class="text-center align-middle background-table">Área de especialización</td>
                    <td class="text-center align-middle background-table">Experiencia profesional</td>
                    <td class="text-center align-middle background-table">Experiencia docente</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php

                $sql="select id_equipo_maestros_itcj,nombre_docente,categoria_hora,grado_estudios,sni,area_especializacion,
                experiencia_profesional,experiencia_docente from equipo_maestros_itcj";

                $resultado = mysqli_query($conexion,$sql);

                while($buscar=mysqli_fetch_row($resultado)) {

                $datos = $buscar[0]."||".
                    $buscar[1]."||".
                    $buscar[2]."||".
                    $buscar[3]."||".
                    $buscar[4]."||".
                    $buscar[5]."||".
                    $buscar[6]."||".
                    $buscar[7];

                ?>

                <tr>
                    <td><?php echo $buscar[1]?></td>
                    <td><?php echo $buscar[2]?></td>
                    <td><?php echo $buscar[3]?></td>
                    <td><?php echo $buscar[4]?></td>
                    <td><?php echo $buscar[5]?></td>
                    <td><?php echo $buscar[6]?></td>
                    <td><?php echo $buscar[7]?></td>
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