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

                <label>Carrera</label>
                <select type="text" class="form-control-page input-group-sm" id="carrera_agregar">
                    <?php
                    $query = "select id_carrera,nombre_carrera from carreras where id_programa_universi=1";
                    $resultado = mysqli_query($conexion,$query);

                    while($fila = mysqli_fetch_array($resultado)){
                        $valor = $fila['nombre_carrera'];

                        echo "<option value=\"".$fila['id_carrera']."\">".$fila['nombre_carrera']."</option>\n";

                    }
                    ?>


                </select>

                <label>Modalidad</label>
                <select type="text" class="form-control-page input-group-sm" id="modalidad_agregar">
                    <option selected>Seleccione una modalidad...</option>
                    <option value="1">Escolarizada</option>
                    <option value="2">Mixta</option>


                </select>

                <label>Nuevo ingreso</label>
                <input type="number" value="0" id="ingreso_agregar" class="form-control-page input-group-sm">

                <label>Reingreso</label>
                <input type="number" value="0" id="reingreso_agregar" class="form-control-page input-group-sm">

                <label>Status</label>
                <select type="text" class="form-control-page input-group-sm" id="status_agregar">
                    <option selected>Seleccione un Status...</option>
                    <option value="1">Activo</option>
                    <option value="2">No Activo</option>

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
                <input type="number" value="0" id="ingreso_editar" class="form-control-page input-group-sm">

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


<script type="text/javascript">
    $(document).ready(function () {
        $('#btn_agregar_profesor').click(function () {



            var modal_sel = document.getElementById("modalidad_agregar");
            var modal_valor = modal_sel.options[modal_sel.selectedIndex].text;

            var status_sel = document.getElementById("status_agregar");
            var status_valor = status_sel.options[status_sel.selectedIndex].text;

            var period_sel = document.getElementById("periodo_agregar");
            var period_valor = period_sel.options[period_sel.selectedIndex].text;




           carrera =parseInt( $('#carrera_agregar').val());
            console.log(carrera);
            modalidad = modal_valor;
            console.log(modalidad);
            nuevo_ingreso = $('#ingreso_agregar');
            console.log(nuevo_ingreso);
            reingreso = $('#reingreso_agregar').val();
            console.log(reingreso);
            status = status_valor;
            console.log(status);
            periodo = parseInt(disc_valor);
            console.log(periodo);
            agregarDatos(nombre_completo,sexo,grado_estudios,horas_jornada,area_academica,
                disciplina,vigencia,area_experiencia,fecha_ingreso)
        });

        $('#btn_editar_profesor').click(function () {
            actualizaDatos();
        });

    });

</script>
