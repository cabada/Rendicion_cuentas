<?php

    require_once "PHP_Consultas/Conexion.php";
    $conexion = conexion();

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de año sabático</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de profesor(a)</td>
                    <td class="text-center align-middle background-table">Proyecto realizado</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Eliminar</button>
                    </td>
                </tr>
            </table>
        </div>
        
    </div>
</div>