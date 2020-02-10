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
                    <option selected>Elija Grado de Estudios</option>
                    <option value="1">Bachillerato/Tecnico</option>
                    <option value="2">Licenciatura</option>
                    <option value="3">Ingeniería</option>
                    <option value="4">Maestría</option>
                    <option value="5">Doctorado</option>
                </select>

                <label>Horas de jornada</label>
                <input type="text" value="0" id="horas_jornada_agregar" class="form-control-page input-group-sm">

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
                <input class="form-control-page input-group-sm" type="text" value="aaaa-mm-dd" id="anio_vigencia_agregar">

                <label>Área de experiencia</label>
                <input type="text" value="0" id="area_experiencia_agregar" class="form-control-page input-group-sm">

                <label>Fecha de ingreso</label>
                <input class="form-control-page input-group-sm" type="text" value="aaaa-mm-dd" id="fecha_ingreso_agregar">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-page-theme-2" data-dismiss="modal" id="btn_agregar_profesor">Agregar Nuevo Registro</button>
            </div>
        </div>
    </div>
</div>
