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

                <label>Vigencia</label>
                <input type="number" min="0"id="vigencia_agregar" class="form-control-page input-group-sm">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-main" data-dismiss="modal" id="btn_agregar_profesor">Agregar Nuevo Registro</button>
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

                <label>Vigencia</label>
                <input type="number" id="vigencia_editar" class="form-control-page input-group-sm">
                 </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-main" id="btn_editar_profesor" data-dismiss="modal">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        var regex =  /[^A-Za-z]/g ;

        var regexNum = /[^0-9]/g ;

        $('#btn_agregar_profesor').click(function () {





            var area_sel = document.getElementById("area_academica_agregar");
            var area_valor = area_sel.options[area_sel.selectedIndex].value;



            nombre_completo = $('#nombre_agregar').val();
            console.log(nombre_completo);

            area_academica = parseInt( $('#area_academica_agregar').val());
            console.log(area_academica);
            vigencia = $('#vigencia_agregar').val();

            if (nombre_completo==="" || regex.test(nombre_completo)){
                alertify.alert("Error","¡El campo de nombre completo es invalido!")
                return false;
            } else if (vigencia==="" ||  regexNum.test(vigencia)){
                alertify.alert("Error","¡El campo de vigencia es invalido!")
                return false;
            } else {

                agregarDatos(nombre_completo,area_academica,
                    vigencia);
            }



        });

        $('#btn_editar_profesor').click(function () {

            nombre_completo = $('#nombre_editar').val();

            vigencia = $('#vigencia_editar').val();

            if (nombre_completo==="" || regex.test(nombre_completo)){
                alertify.alert("Error","¡El campo de nombre completo es invalido!")
                return false;
            } else if (vigencia==="" ||  regexNum.test(vigencia)){
                alertify.alert("Error","¡El campo de vigencia es invalido!")
                return false;
            } else {

                actualizaDatos();
            }


        });

    });

</script>