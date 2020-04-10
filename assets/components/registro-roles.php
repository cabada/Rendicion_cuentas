<?php

require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de Roles</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de Rol</td>
                    <td class="text-center align-middle background-table">Permisos</td>
                    <td class="text-center align-middle background-table">Tablas de Acceso</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>
                <?php

                    ?>

                    <tr>
                        <td><?php ?></td>
                        <td><?php ?></td>
                        <td><?php /*echo*/ /*$buscar[4]*/?></td>
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" <!--onclick="agregaform('<?php /*echo $datos */?>')"-->><i class="far fa-edit"></i>  Editar</button>
                            <button class="btn btn-sm btn-danger" <!--onclick="preguntarSiNo('<?php /*echo $buscar[0]*/?>')"-->><i class="fas fa-trash" ></i>  Eliminar</button>
                        </td>
                    </tr>
                   <!-- --><?php
/*                }
                */?>
            </table>
        </div>

    </div>
</div>
