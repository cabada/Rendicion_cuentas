<?php
require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();
?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de cuerpos académicos posgrado</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Área académica</td>
                    <td class="text-center align-middle background-table">Nombre de cuerpo académico</td>
                    <td class="text-center align-middle background-table">Grado</td>
                    <td class="text-center align-middle background-table">Estado</td>
                    <td class="text-center align-middle background-table">Año de registro</td>
                    <td class="text-center align-middle background-table">Vigencia</td>
                    <td class="text-center align-middle background-table">Área</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php
                $sql="select id_cuerpos_academicos_posgrado,area_academica,nombre_cuerpo,grado,estado,anio_registro,
                      vigencia,area from cuerpos_academicos_posgrado";

                $result=mysqli_query($conexion,$sql);
                while ($ver=mysqli_fetch_row($result)){

                ?>

                <tr>
                    <td><?php echo $ver[1]?></td>
                    <td><?php echo $ver[2]?></td>
                    <td><?php echo $ver[3]?></td>
                    <td><?php echo $ver[4]?></td>
                    <td><?php echo $ver[5]?></td>
                    <td><?php echo $ver[6]?></td>
                    <td><?php echo $ver[7]?></td>
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