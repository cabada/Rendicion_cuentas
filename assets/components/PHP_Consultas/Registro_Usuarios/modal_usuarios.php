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
                <input type="text" required id="nombre_usuario_agregar" class="form-control-page input-group-sm usuario" >

                <label>Apellido</label>
                <input type="text" required id="apellido_usuario_agregar" class="form-control-page input-group-sm usuario" >


                <label>Email</label>
                <input type="email" required placeholder="Ejemplo@Ejemplo.com" id="email_agregar" class="form-control-page input-group-sm usuario" >

                <label>Contrasena</label>
                <input type="password" required placeholder="" id="contrasena_agregar" class="form-control-page input-group-sm usuario" >

                <label>Verificar Contrasena</label>
                <input type="password" required placeholder="" id="v_contrasena_agregar" class="form-control-page input-group-sm usuario" >

                <label>Rol</label>
                <select type="text"  required class="form-control-page input-group-sm usuario" id="rol_agregar">
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
                <button type="button" class="btn btn-main" data-dismiss="modal" id="btn_agregar_usuario" >Agregar Nuevo Registro</button>
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
                <label>ID Usuario</label>
                <input type="text" readonly="readonly" id="id_usuario_editar" class="form-control-page input-group-sm usuario">


                <label>Nombre</label>
                <input type="text" id="nombre_usuario_editar" class="form-control-page input-group-sm usuario">

                <label>Apellido</label>
                <input type="text" id="apellido_usuario_editar" class="form-control-page input-group-sm usuario">


                <label>Email</label>
                <input type="email" placeholder="Ejemplo@Ejemplo.com" id="email_editar" class="form-control-page input-group-sm usuario">

                <label>Contrasena</label>
                <input type="password" placeholder="********" id="contrasena_editar" class="form-control-page input-group-sm usuario">

                <label>Verificar Contrasena</label>
                <input type="password" placeholder="********" id="v_contrasena_editar" class="form-control-page input-group-sm usuario">

                <label>Rol</label>
                <select type="text" class="form-control-page input-group-sm usuario" id="rol_editar">
                    <?php
                    $query = "select id_Rol,nombre_Rol from roles";
                    $resultado = mysqli_query($conexion,$query);

                    while($fila = mysqli_fetch_array($resultado)){
                        $valor = $fila['nombre_rol'];

                        echo "<option value=\"".$fila['id_Rol']."\">".$fila['nombre_Rol']."</option>\n";
                    }
                    ?>
                </select></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-main" id="btn_editar_usuario">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {


                $("#v_contrasena_agregar").focusout(function () {


                    v_contra= $('#v_contrasena_agregar').val();
                    console.log(v_contra);
                    contra = $('#contrasena_agregar').val();
                    console.log(contra);

                    //Verifica que las contrasenas sean iguales

                    if(v_contra==contra){
                        document.getElementById('v_contrasena_agregar').style.borderColor = 'green';
                        document.getElementById('contrasena_agregar').style.borderColor = 'green';

                        //Si son iguales se cambiara el contorno a verde de los inputs, y ademas dejara hacerle click a la funcion
                        //que lleva los datos al archivo JS para luego llevarlos al archivo PHP y guardarlos en la BD.


                    }

                    else{
                        document.getElementById('v_contrasena_agregar').style.borderColor = 'red';
                        document.getElementById('contrasena_agregar').style.borderColor = 'red';
                        document.getElementById("btn_agregar_usuario").disabled = true;


                    }

                });

        $('#btn_agregar_usuario').click(function () {



            var rol_sel = document.getElementById("rol_agregar");
            var rol_valor = rol_sel.options[rol_sel.selectedIndex].value;


            nombre_usuario =  $('#nombre_usuario_agregar').val();
            console.log(nombre_usuario);
            apellido= $('#apellido_usuario_agregar').val();
            console.log(apellido);
            email= $('#email_agregar').val();
            console.log(email);
            contra = $('#contrasena_agregar').val();
            v_contrasena= parseInt($('#v_contrasena_agregar').val());
            console.log(v_contrasena);
            rol = rol_valor;

            agregarDatos(nombre_usuario,apellido,email,v_contrasena,rol);


        });




        $('#btn_editar_usuario').click(function () {
            actualizaDatos();
        });



        });




</script>
