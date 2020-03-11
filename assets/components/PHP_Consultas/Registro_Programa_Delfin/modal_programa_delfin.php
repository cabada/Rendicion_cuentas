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
                <label>Nombre de proyecto</label>
                <input type="text" id="nombre_proyecto_agregar" class="form-control-page input-group-sm">

                <label>Cantidad de alumnos</label>
                <input type="number" value="0" id="cantidad_alumnos_agregar" class="form-control-page input-group-sm">


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


                <label>Año</label>
                <input type="text" id="anio_agregar" maxlength="4" class="form-control-page input-group-sm">

                <label>Fecha de inicio</label>
                <input class="form-control-page input-group-sm" type="date" value="dd-mm-aaaa" id="fecha_inicio_agregar">

                <label>Fecha de terminación</label>
                <input class="form-control-page input-group-sm" type="date" value="dd-mm-aaaa" id="fecha_termino_agregar">
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

                <label>Id_programa</label>
                <input type="id" id="id_programa" class="form-control-page input-group-sm" readonly="readonly">

                <label>Nombre de proyecto</label>
                <input type="text" id="nombre_proyecto_editar" class="form-control-page input-group-sm">

                <label>Cantidad de alumnos</label>
                <input type="number" value="0" id="cantidad_alumnos_editar" class="form-control-page input-group-sm">

                <label>Carrera</label>
                <select type="text" class="form-control-page input-group-sm" id="carrera_editar">
                    <?php
                    $query = "select id_carrera,nombre_carrera from carreras where id_programa_universi=1";
                    $resultado = mysqli_query($conexion,$query);

                    while($fila = mysqli_fetch_array($resultado)){
                        $valor = $fila['nombre_carrera'];

                        echo "<option value=\"".$fila['id_carrera']."\">".$fila['nombre_carrera']."</option>\n";

                    }
                    ?>
                </select>

                <label>Año</label>
                <input type="text" id="anio_editar" maxlength="4" class="form-control-page input-group-sm">

                <label>Fecha de inicio</label>
                <input class="form-control-page input-group-sm" type="date" value="dd-mm-aaaa" id="fecha_inicio_editar">

                <label>Fecha de terminación</label>
                <input class="form-control-page input-group-sm" type="date" value="dd-mm-aaaa" id="fecha_inicio_editar">
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
    $(document).ready(function () {
        $('#btn_agregar_curso_actual').click(function () {

            nombre_proyecto=$('#nombre_proyecto_agregar').val();
            console.log(nombre_proyecto);
            cantidad_alumnos= parseInt($('#cantidad_alumnos_agregar').val());
            console.log(cantidad_alumnos);
            id_carrera =parseInt( $('#carrera_agregar').val());
            console.log(id_carrera);


            anio=$('#anio_agregar').val();
            console.log(anio);
            fecha_inicio=$('#fecha_inicio_agregar').val();
            console.log(fecha_inicio);
            fecha_termino=$('#fecha_termino_agregar').val();
            console.log(fecha_termino);

            agregarDatos(nombre_proyecto,cantidad_alumnos,id_carrera,anio,fecha_inicio,fecha_termino);
        });

        $('#btn_editar_curso_actual').click(function () {
            actualizarDatos();
        });
    });
</script>