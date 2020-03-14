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
                        <select type="text" class="form-control-page input-group-sm" id="area_academica_agregar">
                            <?php
                            $query = "select id_area_academica,nombre_area_academica from area_academica";
                            $resultado = mysqli_query($conexion,$query);

                            while($fila = mysqli_fetch_array($resultado)){
                                $valor = $fila['nombre_area_academica'];

                                echo "<option value=\"".$fila['id_area_academica']."\">".$fila['nombre_area_academica']."</option>\n";

                            }
                            ?>
                        </select>

						<label>Nombre de cuerpo académico</label>
						<input type="text" id="nombre_cuerpo_academico_agregar" class="form-control-page input-group-sm">

						<label>Grado</label>
                        <select type="text" class="form-control-page input-group-sm" id="grado_agregar">
                            <option selected>-</option>
                            <option>Bachillerato/Tecnico</option>
                            <option>Licenciatura</option>
                            <option>Ingeniería</option>
                            <option>Maestría</option>
                            <option>Doctorado</option>
                        </select>

						<label>Estado</label>
                        <input type="text" id="nombre_estado_agregar" class="form-control-page input-group-sm">

						<label>Año de registro</label>
                        <input class="form-control-page input-group-sm" type="date" value="aaaa-mm-dd" id="anio_registro_agregar">

						<label>Vigencia</label>
                        <input class="form-control-page input-group-sm" type="date" value="aaaa-mm-dd" id="anio_vigencia_agregar">
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
                        <select type="text" class="form-control-page input-group-sm" id="area_academica_editar">
                            <?php
                            $query = "select id_area_academica,nombre_area_academica from area_academica";
                            $resultado = mysqli_query($conexion,$query);

                            while($fila = mysqli_fetch_array($resultado)){
                                $valor = $fila['nombre_area_academica'];

                                echo "<option value=\"".$fila['id_area_academica']."\">".$fila['nombre_area_academica']."</option>\n";

                            }
                            ?>
                        </select>

						<label>Nombre de cuerpo académico</label>
						<input type="text" id="nombre_cuerpo_academico_editar" class="form-control-page input-group-sm">

						<label>Grado</label>
                        <select type="text" class="form-control-page input-group-sm" id="grado_editar">
                            <option selected>-</option>
                            <option>Bachillerato/Tecnico</option>
                            <option>Licenciatura</option>
                            <option>Ingeniería</option>
                            <option>Maestría</option>
                            <option>Doctorado</option>
                        </select>

						<label>Estado</label>
                        <input type="text" id="nombre_estado_editar" class="form-control-page input-group-sm">

						<label>Año de registro</label>
                        <input class="form-control-page input-group-sm" type="date" value="aaaa-mm-dd" id="anio_registro_editar">

						<label>Vigencia</label>
                        <input class="form-control-page input-group-sm" type="date" value="aaaa-mm-dd" id="anio_vigencia_editar">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-main" id="btn_editar_curso_actual">Guardar cambios</button>
					</div>
				</div>
			</div>
		</div>

<!-- JAVASCRIPT CODE -->
