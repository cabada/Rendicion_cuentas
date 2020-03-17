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
                <input type="text" class="form-control-page input-group-sm" id="grado_agregar"></input>

                <label>Estado</label>
                <input type="text" id="nombre_estado_agregar" class="form-control-page input-group-sm">

                <label>Año de registro</label>
                <input class="form-control-page input-group-sm" type="text" maxlength="4"  id="anio_registro_agregar">

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
                <label>Numero de registro del cuerpo académico</label>
                <input type="id" id="id_cuerpo_academico" class="form-control-page input-group-sm" readonly="readonly">

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
                <input type="text" class="form-control-page input-group-sm" id="grado_editar"></input>

                <label>Estado</label>
                <input type="text" id="nombre_estado_editar" class="form-control-page input-group-sm">

                <label>Año de registro</label>
                <input class="form-control-page input-group-sm" type="text" maxlength="4" id="anio_registro_editar">

                <label>Vigencia</label>
                <input class="form-control-page input-group-sm" type="text"  id="anio_vigencia_editar">

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
        $('#registro-cuerpos-academicos').load('assets/components/registro-cuerpos-academicos.php');
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#btn_agregar_curso_actual').click(function () {

            var area_sel = document.getElementById("area_academica_agregar");
            var area_valor = area_sel.options[area_sel.selectedIndex].value;

            id_area_academica = $('#area_academica_agregar').val();
            console.log(id_area_academica);

            nombre_cuerpo_academico=$('#nombre_cuerpo_academico_agregar').val();
            console.log(nombre_cuerpo_academico);
            grado=$('#grado_agregar').val();
            console.log(grado);
            estado=$('#nombre_estado_agregar').val();
            console.log(estado);
            anio_registro=$('#anio_registro_agregar').val();
            console.log(anio_registro);
            vigencia=$('#vigencia_agregar').val();
            console.log(vigencia);
            area=$('#area_agregar').val();
            console.log(area);

            agregarDatos(id_area_academica,nombre_cuerpo_academico,grado,estado,anio_registro,vigencia,area)
        });

        $('#btn_editar_curso_actual').click(function () {
            actualizarDatos();
        });
    });

</script>
