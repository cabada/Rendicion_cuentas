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
                <button type="button" class="btn btn-main" data-dismiss="modal" id="btn_editar_curso_actual">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function () {
        $('#btn_agregar_curso_actual').click(function () {

            id_area_academica = $('#area_academica_agregar').val();
            nombre_cuerpo_academico=$('#nombre_cuerpo_academico_agregar').val();
            grado=$('#grado_agregar').val();
            estado=$('#nombre_estado_agregar').val();
            anio_registro=$('#anio_registro_agregar').val();
            vigencia=$('#vigencia_agregar').val();
            area=$('#area_agregar').val();

            // FUNCION PARA VALIDAR LONGITUD DE AÑO
            function validarLongitud(parametro) {
                if (parametro.length < 4){
                    return false;
                } else {
                    return true;
                }
            }
            // VALIDACIONES PARA AGREGAR NUEVO REGISTRO
            if(id_area_academica === ""){
                alertify.alert("Error","¡El campo de área académica esta vacío!");
                return false;
            } else if (nombre_cuerpo_academico === ""){
                alertify.alert("Error","¡El nombre de cuerpo académico esta vacío!");
                return false;
            } else if (grado === ""){
                alertify.alert("Error","¡El campo de grado esta vacío!");
                return false;
            } else if (estado === ""){
                alertify.alert("Error","¡El campo de estado esta vacío!");
                return false;
            } else if (isNaN(anio_registro)){
                alertify.alert("Error","¡El valor introducido en año de registro no es valido! Introduzca un valor numérico");
                return false;
            } else if (anio_registro === ""){
                alertify.alert("Error","¡El campo de año registro esta vacío!");
                return false;
                // SE MANDA LLAMAR LA FUNCION Y SE DA EL PARAMETRO QUE QUEREMOS VALIDAR
            } else if (validarLongitud(anio_registro) == false){
                alertify.alert("Error","Introduzca un año valido de 4 caracteres");
                return false;
            } else if (vigencia === ""){
                alertify.alert("Error","¡El campo de vigencia esta vacío!");
                return false;
            } else if (area === ""){
                alertify.alert("Error","¡El campo de área esta vacío!");
                return false;
            } else {
                agregarDatos(id_area_academica,nombre_cuerpo_academico,grado,estado,anio_registro,vigencia,area);
                $('#new-modal').modal('hide');
                $('#area-academica-agregar').val('');
                $('#nombre_cuerpo_academico_agregar').val('');
                $('#nombre_estado_agregar').val('');
                $('#anio_registro_agregar').val('');
                $('#anio_vigencia_agregar').val('');
                $('#area_agregar').val('');
            }
        });


        $('#btn_editar_curso_actual').click(function () {
            id_cuerpo_academico =$('#id_cuerpo_academico').val();
            id_area_academica = $('#area_academica_editar').val();
            nombre_cuerpo_academico=$('#nombre_cuerpo_academico_editar').val();
            grado=$('#grado_editar').val();
            estado=$('#nombre_estado_editar').val();
            anio_registro=$('#anio_registro_editar').val();
            vigencia=$('#anio_vigencia_editar').val();
            area=$('#area_editar').val();


            // FUNCION PARA VALIDAR LONGITUD DE AÑO
            function validarLongitud(parametro) {
                if (parametro.length < 4){
                    return false;
                } else {
                    return true;
                }
            }

            // VALIDACIONES PARA AGREGAR NUEVO REGISTRO
            if(id_area_academica === ""){
                alertify.alert("Error","¡El campo de área académica esta vacío!");
                return false;
            } else if (nombre_cuerpo_academico === ""){
                alertify.alert("Error","¡El nombre de cuerpo académico esta vacío!");
                return false;
            } else if (grado === ""){
                alertify.alert("Error","¡El campo de grado esta vacío!");
                return false;
            } else if (estado === ""){
                alertify.alert("Error","¡El campo de estado esta vacío!");
                return false;
            } else if (isNaN(anio_registro)){
                alertify.alert("Error","¡El valor introducido en año de registro no es valido! Introduzca un valor numérico");
                return false;
            } else if (anio_registro === ""){
                alertify.alert("Error","¡El campo de año registro esta vacío!");
                return false;
                // SE MANDA LLAMAR LA FUNCION Y SE DA EL PARAMETRO QUE QUEREMOS VALIDAR
            } else if (validarLongitud(anio_registro) == false){
                alertify.alert("Error","Introduzca un año valido de 4 caracteres");
                return false;
            } else if (vigencia ===""){
                alertify.alert("Error","¡El campo de vigencia esta vacío!");
                return false;
            } else if (area === ""){
                alertify.alert("Error","¡El campo de área esta vacío!");
                return false;
            } else {
                actualizarDatos();
            }
        });
    });

</script>
