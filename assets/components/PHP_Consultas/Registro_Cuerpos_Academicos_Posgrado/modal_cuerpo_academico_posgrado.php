<?php

require_once "../Conexion.php";
$conexion = conexion();

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
                        <label>Área académica</label>
                        <input type="text" id="area-academica-agregar" class="form-control-page input-group-sm">

						<label>Nombre de cuerpo académico</label>
						<input type="text" id="nombre_cuerpo_academico_agregar" class="form-control-page input-group-sm">

						<label>Grado</label>
                        <input type="text" class="form-control-page input-group-sm" id="grado_agregar">

						<label>Estado</label>
                        <input type="text" id="nombre_estado_agregar" class="form-control-page input-group-sm">

						<label>Año de registro</label>
                        <input class="form-control-page input-group-sm" type="text" maxlength="4" id="anio_registro_agregar">

						<label>Vigencia</label>
                        <input class="form-control-page input-group-sm" type="text" id="vigencia_agregar">

                        <label>Área</label>
                        <input type="text" id="area_agregar" class="form-control-page input-group-sm">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-main" data-dismiss="modal" id="btn_agregar_curso_actual">Agregar Nuevo Registro</button>
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
                <label>Área académica</label>
                <input type="text" id="area-academica-editar" class="form-control-page input-group-sm">

                <label>Nombre de cuerpo académico</label>
                <input type="text" id="nombre_cuerpo_academico_editar" class="form-control-page input-group-sm">

                <label>Grado</label>
                <input type="text" class="form-control-page input-group-sm" id="grado_editar">

                <label>Estado</label>
                <input type="text" id="nombre_estado_editar" class="form-control-page input-group-sm">

                <label>Año de registro</label>
                <input class="form-control-page input-group-sm" type="text" maxlength="4" id="anio_registro_editar">

                <label>Vigencia</label>
                <input class="form-control-page input-group-sm" type="text" id="vigencia_editar">

                <label>Área</label>
                <input type="text" id="area_editar" class="form-control-page input-group-sm">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-main" id="btn_editar_curso_actual">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT CODE -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#navbar').load('navbar.html');
        $('#registro-cuerpos-academicos-posgrado').load('assets/components/registro-cuerpos-academicos-posgrado.php');
    });
</script>