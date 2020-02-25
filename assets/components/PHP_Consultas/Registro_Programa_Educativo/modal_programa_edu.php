<?php




?>

<!-- MODAL FOR NEW FORM -->

<div class="modal fade" id="new-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-modalLabel">Agregar nuevo registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Modalidad</label>
                <input type="text" id="modalidad_agregar" class="form-control-page input-group-sm">

                <label>Nuevo ingreso</label>
                <input type="number" value="0" id="inreso_agregar" class="form-control-page input-group-sm">

                <label>Reingreso</label>
                <input type="number" value="0" id="reingreso_agregar" class="form-control-page input-group-sm">

                <label>Estatus</label>
                <select type="text" class="form-control-page input-group-sm" id="estatus_agregar">
                    <option selected>-</option>
                    <option>Activo</option>
                </select>

                <label>Periodo</label>
                <select type="text" class="form-control-page input-group-sm" id="periodo_agregar">
                    <option selected>-</option>
                    <option>Agosto - Diciembre</option>
                    <option>Enero - Junio</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-page-theme-2" data-dismiss="modal" id="btn_agregar_curso_actual">Agregar Nuevo Registro</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FOR EDITION -->


<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>Modalidad</label>
                <input type="text" id="modalidad_editar" class="form-control-page input-group-sm">

                <label>Nuevo ingreso</label>
                <input type="number" value="0" id="inreso_editar" class="form-control-page input-group-sm">

                <label>Reingreso</label>
                <input type="number" value="0" id="reingreso_editar" class="form-control-page input-group-sm">

                <label>Estatus</label>
                <select type="text" class="form-control-page input-group-sm" id="estatus_editar">
                    <option selected>-</option>
                    <option>Activo</option>
                </select>

                <label>Periodo</label>
                <select type="text" class="form-control-page input-group-sm" id="periodo_editar">
                    <option selected>-</option>
                    <option>Agosto - Diciembre</option>
                    <option>Enero - Junio</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-page-theme-2" id="btn_editar_curso_actual">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
