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
                <label>Nombre de programa</label>
                <select type="text" id="nombre_curso_agregar" class="form-control-page input-group-sm">
                    <?php

                    $query = "select id_carrera,nombre_carrera from carreras where id_programa_universi=2";
                    $resultado = mysqli_query($conexion,$query);

                    while($fila = mysqli_fetch_array($resultado)){
                        $valor = $fila['nombre_carrera'];

                        echo "<option value=\"".$fila['id_carrera']."\">".utf8_encode($fila['nombre_carrera'])."</option>\n";
                    }
                    ?>
                </select>

                <label>Cantidad</label>
                <input type="number" value="0" id="cantidad_agregar" class="form-control-page input-group-sm">

              <label>Registrado en</label>
                <input class="form-control-page input-group-sm" type="text" id="registro_agregar">
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
                <input type="id" id="id_total_prog_posgrado" class="form-control-page input-group-sm" readonly="readonly">

                <label>Nombre de programa</label>
                <select type="text" id="nombre_curso_editar" class="form-control-page input-group-sm">
                    <?php

                    $query = "select id_carrera,nombre_carrera from carreras where id_programa_universi=2";
                    $resultado = mysqli_query($conexion,$query);

                    while($fila = mysqli_fetch_array($resultado)){
                        $valor = $fila['nombre_carrera'];

                        echo "<option value=\"".$fila['id_carrera']."\">".utf8_encode($fila['nombre_carrera'])."</option>\n";
                    }
                    ?>
                </select>

                <label>Cantidad</label>
                <input type="number" value="0" id="cantidad_editar" class="form-control-page input-group-sm">

                <label>Registrado en</label>
                <input class="form-control-page input-group-sm" type="text" id="registro_editar">
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

            var carrera_sel = document.getElementById("nombre_curso_agregar");
            var carrera_valor = carrera_sel.options[carrera_sel.selectedIndex].value;

            id_carrera=carrera_valor;
            console.log(id_carrera);
            cantidad=$('#cantidad_agregar').val();
            console.log(cantidad);
            registrado_en=$('#registro_agregar').val();
            console.log(registrado_en);

            agregardatos(id_carrera,cantidad,registrado_en)
        });
        $('#btn_editar_curso_actual').click(function () {
            actualizaDatos();
        });
    });
</script>
