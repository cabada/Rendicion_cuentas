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
                        <label>Programa educativo</label>
                        <select type="text" id="programa_educativo_agregar" class="form-control-page input-group-sm">
                                <?php

                                $query = "select id_carrera,nombre_carrera from carreras where id_programa_universi=1";
                                $resultado = mysqli_query($conexion,$query);

                                while($fila = mysqli_fetch_array($resultado)){
                                    $valor = $fila['nombre_carrera'];

                                    echo "<option value=\"".$fila['id_carrera']."\">".$fila['nombre_carrera']."</option>\n";
                                }
                                ?>
                        </select>

                        </select>

						<label>Cantidad de alumnos</label>
                        <input type="number" value="0" id="cantidad_alumnos_agregar" class="form-control-page input-group-sm">
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
                        <label>Numero de registro</label>
                        <input type="id" id="id_matricula" class="form-control-page input-group-sm" readonly="readonly">

                        <label>Programa educativo</label>
                        <select type="text" id="programa_educativo_editar" class="form-control-page input-group-sm">
                                <?php

                                $query = "select id_carrera,nombre_carrera from carreras where id_programa_universi=1";
                                $resultado = mysqli_query($conexion,$query);

                                while($fila = mysqli_fetch_array($resultado)){
                                    $valor = $fila['nombre_carrera'];

                                    echo "<option value=\"".$fila['id_carrera']."\">".$fila['nombre_carrera']."</option>\n";
                                }
                                ?>
                        </select>

						<label>Cantidad de alumnos</label>
                        <input type="number" value="0" id="cantidad_alumnos_editar" class="form-control-page input-group-sm">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-main" data-dismiss="modal" id="btn_editar_curso_actual">Guardar cambios</button>
					</div>
				</div>
			</div>
		</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#btn_agregar_curso_actual').click(function () {

            programa_educativo=$('#programa_educativo_agregar').val();
            console.log(programa_educativo);
            cantidad_alumnos=$('#cantidad_alumnos_agregar').val();
            console.log(cantidad_alumnos);

            agregardatos(programa_educativo,cantidad_alumnos);
        });
        $('#btn_editar_curso_actual').click(function () {
            actualizaDatos();
        });
    });
</script>