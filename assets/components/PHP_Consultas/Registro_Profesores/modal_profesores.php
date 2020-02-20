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

                <label>Nombre completo</label>
                <input type="text" id="nombre_agregar" class="form-control-page input-group-sm">

                <label>Sexo</label>
                <select type="text" class="form-control-page input-group-sm" id="sexo_agregar">
                    <option selected>Elija Sexo</option>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                </select>

                <label>Grado de estudios</label>
                <select type="text" class="form-control-page input-group-sm" id="grado_estudios_agregar">
                    <option value="0">Elija Grado de Estudios</option>
                    <option value="1">Bachillerato/Tecnico</option>
                    <option value="2">Licenciatura</option>
                    <option value="3">Ingeniería</option>
                    <option value="4">Maestría</option>
                    <option value="5">Doctorado</option>
                </select>

                <label>Horas de jornada</label>
                <input type="text" id="horas_jornada_agregar" class="form-control-page input-group-sm">

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

                <label>Disciplina</label>
                <select type="text" class="form-control-page input-group-sm" id="disciplina_agregar">
                <?php
                    $query = "select id_disciplina,nombre_disciplina from disciplina";
                    $resultado = mysqli_query($conexion,$query);

                    while($fila = mysqli_fetch_array($resultado)){
                    $valor = $fila['nombre_disciplina'];

                    echo "<option value=\"".$fila['id_disciplina']."\">".$fila['nombre_disciplina']."</option>\n";

                    }
                    ?>
                </select>

                <label>Vigencia</label>
                <input class="form-control-page input-group-sm" type="text" id="anio_vigencia_agregar">

                <label>Área de experiencia</label>
                <input type="text" id="area_experiencia_agregar" class="form-control-page input-group-sm">

                <label>Fecha de ingreso</label>
                <input class="form-control-page input-group-sm" type="text" id="fecha_ingreso_agregar">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-page-theme-2" data-dismiss="modal" id="btn_agregar_profesor">Agregar Nuevo Registro</button>
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

                <label>ID_Profesor</label>
                <input type="id" id="id_profesor" class="form-control-page input-group-sm" readonly="readonly">

                <label>Nombre completo</label>
                <input type="text" id="nombre_editar" class="form-control-page input-group-sm">

                <label>Sexo</label>
                <select type="text" class="form-control-page input-group-sm" id="sexo_editar">
                    <option selected>Elija Sexo</option>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                </select>

                <label>Grado de estudios</label>
                <select type="text" class="form-control-page input-group-sm" id="grado_estudios_editar">
                    <option value="0">Elija Grado de Estudios</option>
                    <option value="1">Bachillerato/Tecnico</option>
                    <option value="2">Licenciatura</option>
                    <option value="3">Ingeniería</option>
                    <option value="4">Maestría</option>
                    <option value="5">Doctorado</option>
                </select>

                <label>Horas de jornada</label>
                <input type="text" id="horas_jornada_editar" class="form-control-page input-group-sm">

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

                <label>Disciplina</label>
                <select type="text" class="form-control-page input-group-sm" id="disciplina_editar">
                    <?php
                    $query = "select id_disciplina,nombre_disciplina from disciplina";
                    $resultado = mysqli_query($conexion,$query);

                    while($fila = mysqli_fetch_array($resultado)){
                        $valor = $fila['nombre_disciplina'];

                        echo "<option value=\"".$fila['id_disciplina']."\">".$fila['nombre_disciplina']."</option>\n";

                    }
                    ?>
                </select>

                <label>Vigencia</label>
                <input class="form-control-page input-group-sm" type="text" id="anio_vigencia_editar">

                <label>Área de experiencia</label>
                <input type="text" id="area_experiencia_editar" class="form-control-page input-group-sm">

                <label>Fecha de ingreso</label>
                <input class="form-control-page input-group-sm" type="text" id="fecha_ingreso_editar">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-page-theme-2" id="btn_editar_profesor">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#btn_agregar_profesor').click(function () {

            var sexo_sel = document.getElementById("sexo_agregar");
            var sexo_valor = sexo_sel.options[sexo_sel.selectedIndex].text;

            var grado_sel = document.getElementById("grado_estudios_agregar");
            var grado_valor = grado_sel.options[grado_sel.selectedIndex].text;

            var area_sel = document.getElementById("area_academica_agregar");
            var area_valor = grado_sel.options[area_sel.selectedIndex].value;

            var disc_sel = document.getElementById("disciplina_agregar");
            var disc_valor = disc_sel.options[disc_sel.selectedIndex].value;



            nombre_completo = $('#nombre_agregar').val();
            console.log(nombre_completo);
            sexo = sexo_valor;
            console.log(sexo);
            grado_estudios = grado_valor;
            console.log(grado_estudios);
            horas_jornada = $('#horas_jornada_agregar').val();
            console.log(horas_jornada);
            area_academica = parseInt( $('#area_academica_agregar').val());
            console.log(area_academica);
            disciplina = parseInt(disc_valor);
            console.log(disciplina);
            vigencia = $('#anio_vigencia_agregar').val();
            console.log(vigencia);
            area_experiencia = $('#area_experiencia_agregar').val();
            console.log(area_experiencia);
            fecha_ingreso = $('#fecha_ingreso_agregar').val();
            console.log(fecha_ingreso);
            agregarDatos(nombre_completo,sexo,grado_estudios,horas_jornada,area_academica,
                disciplina,vigencia,area_experiencia,fecha_ingreso)
        });

        $('#btn_editar_curso_actual').click(function () {
            actualizaDatos();
        });

    });

</script>
