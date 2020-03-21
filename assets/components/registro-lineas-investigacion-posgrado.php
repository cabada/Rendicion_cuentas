<?php

require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de líneas de investigación (Posgrado)</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Programa</td>
                    <td class="text-center align-middle background-table">Línea de investigación</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php
                $sql="select lineas_investigacion_posgrado.ID_LINEA,
                                 carreras.ID_CARRERA, 
                                 lineas_investigacion_posgrado.NOMBRE_ESPECIALIDAD
                                 from carreras
                                 right join lineas_investigacion_posgrado on carreras.ID_CARRERA = lineas_investigacion_posgrado.ID_CARRERA";

                $result=mysqli_query($conexion,$sql);
                while ($ver=mysqli_fetch_row($result)){

                $datos=$ver[0]."||".
                    $ver[1]."||".
                    $ver[2];

                ?>

                <tr>
                    <td><?php echo $ver[1]?></td>
                    <td><?php echo $ver[2]?></td>
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
</div>