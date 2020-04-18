<?php

require_once "../Conexion.php";
$conexion = conexion();

?>

<!-- MODAL FOR NEW FORM -->
<div class="modal fade" id="new-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-modalLabel">Agregar Nuevo Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <label>Nombre de Rol</label>
                <input type="text" id="nombre_rol_agregar" class="form-control-page input-group-sm">
                <br>

                <label>Categoria de Tablas REDECU:</label>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="button-group">
                            <button type="button" class="btn btn-light btn-default dropdown-toggle" data-toggle="dropdown">Programa Educativo</button>
                            <ul class="dropdown-menu">
                                <?php
                                $query = "select id_modulo,
                                                    nombre_modulo
                                                    from modulo where id_categoria=1";
                                $resultado = mysqli_query($conexion,$query);

                                while($fila = mysqli_fetch_array($resultado)){
                                    $valor = $fila['nombre_modulo'];

                                    echo "<li><input name=\"modulos\" type=\"checkbox\" value=\"".$fila['id_modulo']."\">".$fila['nombre_modulo']."</li>\n";


                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="button-group">
                            <button type="button" class="btn btn-light btn-default dropdown-toggle" data-toggle="dropdown">Docentes</button>
                            <ul class="dropdown-menu">
                                <?php
                                $query = "select id_modulo,
                                                    nombre_modulo
                                                    from modulo where id_categoria=2";
                                $resultado = mysqli_query($conexion,$query);

                                while($fila = mysqli_fetch_array($resultado)){
                                    $valor = $fila['nombre_modulo'];

                                    echo "<li><input name=\"modulos\" type=\"checkbox\" value=\"".$fila['id_modulo']."\">".$fila['nombre_modulo']."</li>\n";


                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="button-group">
                            <button type="button" class="btn btn-light btn-default dropdown-toggle" data-toggle="dropdown">Cursos</button>
                            <ul class="dropdown-menu">
                                <?php
                                $query = "select id_modulo,
                                                    nombre_modulo
                                                    from modulo where id_categoria=3";
                                $resultado = mysqli_query($conexion,$query);

                                while($fila = mysqli_fetch_array($resultado)){
                                    $valor = $fila['nombre_modulo'];

                                    echo "<li><input name=\"modulos\" type=\"checkbox\" value=\"".$fila['id_modulo']."\">".$fila['nombre_modulo']."</li>\n";


                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <label>Permisos sobre las Tablas:</label>

                <div class="form-check">
                    <input name="permisos" class="form-check-input" type="checkbox"  value="Select">
                    <label class="form-check-label" for="inlineCheckbox1">Ver Registros</label>
                </div>
                <div class="form-check ">
                    <input name="permisos" class="form-check-input" type="checkbox"  value="Insert">
                    <label class="form-check-label" for="inlineCheckbox2">Agregar Registros</label>
                </div>
                <div class="form-check ">
                    <input  name="permisos" class="form-check-input" type="checkbox"  value="Update">
                    <label class="form-check-label" for="inlineCheckbox1">Actualizar Registros</label>
                </div>
                <div class="form-check">
                    <input name="permisos" class="form-check-input" type="checkbox"  value="Delete">
                    <label class="form-check-label" for="inlineCheckbox2">Eliminar Registros</label>
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-main" data-dismiss="modal" id="btn_agregar_rol">Agregar Nuevo Registro</button>
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
                <label>ID de Rol</label>
                <input type="text" id="id_rol_editar" class="form-control-page input-group-sm" readonly="readonly">


                <label>Nombre de Rol</label>
                <input type="text" id="nombre_rol_editar" class="form-control-page input-group-sm">
                <br>

                <label>Categoria de Tablas REDECU:</label>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="button-group">
                            <button type="button" class="btn btn-light btn-default dropdown-toggle" data-toggle="dropdown">Programa Educativo</button>
                            <ul class="dropdown-menu">
                                <?php
                                $query = "select id_modulo,
                                                    nombre_modulo
                                                    from modulo where id_categoria=1";
                                $resultado = mysqli_query($conexion,$query);

                                while($fila = mysqli_fetch_array($resultado)){
                                    $valor = $fila['nombre_modulo'];

                                    echo "<li><input name=\"modulosEdit\" type=\"checkbox\" value=\"".$fila['id_modulo']."\">".$fila['nombre_modulo']."</li>\n";


                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="button-group">
                            <button type="button" class="btn btn-light btn-default dropdown-toggle" data-toggle="dropdown">Docentes</button>
                            <ul class="dropdown-menu">
                                <?php
                                $query = "select id_modulo,
                                                    nombre_modulo
                                                    from modulo where id_categoria=2";
                                $resultado = mysqli_query($conexion,$query);

                                while($fila = mysqli_fetch_array($resultado)){
                                    $valor = $fila['nombre_modulo'];

                                    echo "<li><input name=\"modulosEdit\" type=\"checkbox\" value=\"".$fila['id_modulo']."\">".$fila['nombre_modulo']."</li>\n";


                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="button-group">
                            <button type="button" class="btn btn-light btn-default dropdown-toggle" data-toggle="dropdown">Cursos</button>
                            <ul class="dropdown-menu">
                                <?php
                                $query = "select id_modulo,
                                                    nombre_modulo
                                                    from modulo where id_categoria=3";
                                $resultado = mysqli_query($conexion,$query);

                                while($fila = mysqli_fetch_array($resultado)){
                                    $valor = $fila['nombre_modulo'];

                                    echo "<li><input name=\"modulosEdit\" type=\"checkbox\" value=\"".$fila['id_modulo']."\">".$fila['nombre_modulo']."</li>\n";


                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <label>Permisos sobre las Tablas:</label>

                <div class="form-check">
                    <input name="permisosEdit" class="form-check-input" type="checkbox"  value="Select">
                    <label class="form-check-label" for="inlineCheckbox1">Ver Registros</label>
                </div>
                <div class="form-check ">
                    <input name="permisosEdit" class="form-check-input" type="checkbox"  value="Insert">
                    <label class="form-check-label" for="inlineCheckbox2">Agregar Registros</label>
                </div>
                <div class="form-check ">
                    <input  name="permisosEdit" class="form-check-input" type="checkbox"  value="Update">
                    <label class="form-check-label" for="inlineCheckbox1">Actualizar Registros</label>
                </div>
                <div class="form-check">
                    <input name="permisosEdit" class="form-check-input" type="checkbox"  value="Delete">
                    <label class="form-check-label" for="inlineCheckbox2">Eliminar Registros</label>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-main" id="btn_editar_rol" data-dismiss="modal">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#btn_agregar_rol').click(function () {


            nombre_rol = $('#nombre_rol_agregar').val();
            console.log(nombre_rol);

            modulo = [];
            $('input[name=modulos]:checked').each(function () {

                modulo.push(parseInt(this.value));

            });

            console.log(modulo);

            permiso = [];
            $('input[name=permisos]:checked').each(function () {

                permiso.push(this.value);

            });

            console.log(permiso);

            agregarDatos(nombre_rol,modulo,permiso);
        });

        $('#btn_editar_rol').click(function () {
            actualizaDatos();
        });

    });

</script>
