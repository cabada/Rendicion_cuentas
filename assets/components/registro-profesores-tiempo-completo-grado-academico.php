<?php

require_once "../PHP_Consultas/Conexion.php";
$conexion = conexion();

?>


<div class="row">
    <div class="col-sm-12">
        <h2>Registro de profesores de tiempo completo por grado académico</h2>
        <caption>
            <button class="btn btn-page-theme-2" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <br>
        <table class="table table-hover table-condensed table-bordered table-striped white-background">
            <br>
            <tr>
                <td class="centered-table-title">Grado</td>
                <td class="centered-table-title">Mujer</td>
                <td class="centered-table-title">Hombre</td>
                <td class="centered-table-title">Total</td>
                <td class="centered-table-title">Porcentaje</td>
                <td class="centered-table-title">Editar</td>
                <td class="centered-table-title">Eliminar</td>
            </tr>



            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="centered-table-title"><button class="btn btn-warning"  data-toggle="modal" data-target="#modalEdicion"><i class="far fa-edit"></i></button></td>
                <td class="centered-table-title"><button class="btn btn-danger"><i class="far fa-window-close"></i></button></td>
            </tr>
        </table>
    </div>
</div>