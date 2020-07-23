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
                <select type="text" class="form-control-page input-group-sm"  id="carrera_agregar">
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
                    <option selected>--</option>
                    <option value="1">Escolarizada</option>
                    <option value="2">Mixta</option>
                </select>

                <label>Nuevo ingreso</label>
                <input type="number" min="0" id="ingreso_agregar" class="form-control-page input-group-sm">


                <label>Reingreso</label>
                <input type="number" min="0" id="reingreso_agregar" class="form-control-page input-group-sm">

                <label>Status</label>
                <select type="text" class="form-control-page input-group-sm" id="status_agregar">
                    <option selected>--</option>
                    <option value="1">Activo</option>
                    <option value="2">Acreditada</option>
                </select>

                <label>Periodo</label>
                <select type="text" class="form-control-page input-group-sm" id="periodo_agregar">
                    <option selected>--</option>
                    <option>Agosto - Diciembre</option>
                    <option>Enero - Junio</option>
                </select>
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
                <label>Id_programa_educativo</label>
                <input type="number" id="id_programa_educativo" class="form-control-page input-group-sm" readonly="readonly">

                <label>Carrera</label>
                <select type="text" class="form-control-page input-group-sm" name="carreras" id="carrera_editar">
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
                <select type="text" id="modalidad_editar" class="form-control-page input-group-sm">
                    <option selected>--</option>
                    <option value="1">Escolarizada</option>
                    <option value="2">Mixta</option>
                </select>

                <label>Nuevo ingreso</label>
                <input type="number" min="0" id="ingreso_editar" class="form-control-page input-group-sm">

                <label>Reingreso</label>
                <input type="number" min="0" id="reingreso_editar" class="form-control-page input-group-sm">

                <label>Estatus</label>
                <select type="text" class="form-control-page input-group-sm" id="estatus_editar">
                    <option selected>--</option>
                    <option value="1">Activo</option>
                    <option value="2">Acreditada</option>
                </select>

                <label>Periodo</label>
                <select type="text" class="form-control-page input-group-sm" id="periodo_editar">
                    <option selected>--</option>
                    <option>Agosto - Diciembre</option>
                    <option>Enero - Junio</option>
                </select>
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

        var regex = /[^A-Za-z]/g;
        var regexNum = /[^0-9]/g;

        $('#btn_agregar_curso_actual').click(function () {

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
            nuevo_ingreso = parseInt($('#ingreso_agregar').val());
            console.log(nuevo_ingreso);
            reingreso = parseInt($('#reingreso_agregar').val());
            console.log(reingreso);
            status = status_valor;
            console.log(status);
            periodo = $('#periodo_agregar').val();
            console.log(periodo);
            total = nuevo_ingreso + reingreso;

            // VALIDACIONES PARA AGREGAR NUEVO REGISTRO
            if (carrera===""){
                alertify.alert("Error","¡Seleccione una carrera!");
                return false;
            } else if (modalidad===""){
                alertify.alert("Error","¡Seleccione una modalidad!");
                return false;
            } else if (nuevo_ingreso==="" ||  regexNum.test(nuevo_ingreso)){
                alertify.alert("Error","¡El valor ingresado en nuevo ingreso no es valido!");
                return false;
            } else if (reingreso==="" ||  regexNum.test(reingreso)){
                alertify.alert("Error","¡El valor ingresado en reingreso no es valido!");
                return false;
            } else if (status===""){
                alertify.alert("Error","¡Seleccione un estatus!");
                return false;
            } else if (periodo===""){
                alertify.alert("Error","¡Seleccione un periodo!");
                return false;
            } else {
                agregarDatos(carrera, modalidad, nuevo_ingreso, reingreso, status, periodo, total);

            }
        });

        $('#btn_editar_curso_actual').click(function () {
            //AGREGANDO CAMPOS DE EDITAR PARA PODER ASIGNAR VALIDACIONES
            carrera=$('#carrera_editar').val();
            modalidad=$('#modalidad_editar').val();
            nuevo_ingreso=$('#ingreso_editar').val();
            reingreso=$('#reingreso_editar').val();
            status=$('#estatus_editar').val();
            periodo=$('#periodo_editar').val();


            // VALIDACIONES PARA ACTUALIZAR NUEVO REGISTRO

            if (carrera===""){
                alertify.alert("Error","¡Seleccione una carrera!");
                return false;
            } else if (modalidad===""){
                alertify.alert("Error","¡Seleccione una modalidad!");
                return false;
            } else if (nuevo_ingreso==="" ||  regexNum.test(nuevo_ingreso)){
                alertify.alert("Error","¡El valor ingresado en nuevo ingreso no es valido!");
                return false;
            } else if (reingreso==="" ||  regexNum.test(reingreso)){
                alertify.alert("Error","¡El valor ingresado en reingreso no es valido!");
                return false;
            } else if (status===""){
                alertify.alert("Error","¡Seleccione un estatus!");
                return false;
            } else if (periodo===""){
                alertify.alert("Error","¡Seleccione un periodo!");
                return false;
            } else {
                actualizarDatos();
            }
        });
    });
</script>

