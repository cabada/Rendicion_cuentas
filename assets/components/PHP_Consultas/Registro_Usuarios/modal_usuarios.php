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
                <label>Nombre</label>
                <input type="text" id="nombre_usuario_agregar" class="form-control-page input-group-sm">

                <label>Apellido</label>
                <input type="text" id="apellido_usuario_agregar" class="form-control-page input-group-sm">


                <label>Email</label>
                <input type="email" placeholder="Ejemplo@Ejemplo.com" id="email_agregar" class="form-control-page input-group-sm">

                <label>Contrasena</label>
                <input type="text" placeholder="" id="" class="form-control-page input-group-sm">

                <label>Verificar Contrasena</label>
                <input type="text" placeholder="" id="contrasena_agregar" class="form-control-page input-group-sm">

                <label>Rol</label>
                <select type="text" class="form-control-page input-group-sm" id="rol_agregar">
                    <?php
                    $query = "select id_Rol,nombre_Rol from roles";
                    $resultado = mysqli_query($conexion,$query);

                    while($fila = mysqli_fetch_array($resultado)){
                        $valor = $fila['nombre_rol'];

                        echo "<option value=\"".$fila['id_Rol']."\">".$fila['nombre_Rol']."</option>\n";

                    }
                    ?>
                </select>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-main" data-dismiss="modal" id="btn_agregar_usuario">Agregar Nuevo Registro</button>
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
                <label>ID Registro</label>
                <input type="text" readonly="readonly" id="id_curso_editar" class="form-control-page input-group-sm">


                <label>Nombre del curso</label>
                <input type="text" id="nombre_curso_editar" class="form-control-page input-group-sm">

                <label>Periodo</label>
                <select type="text" class="form-control-page input-group-sm" id="periodo_editar">
                    <option selected>-</option>
                    <option value="Ene-Jun">Ene-Jun</option>
                    <option value="Ago-Dic">Ago-Dic</option>s
                </select>

                <label>No. de participantes</label>
                <input type="number" placeholder="" id="no_participantes_editar" class="form-control-page input-group-sm">

                <label>No. de capacitación</label>
                <input type="number" placeholder="" id="no_capacitacion_editar" class="form-control-page input-group-sm">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-main" id="btn_editar_curso_actual">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

