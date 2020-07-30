<!-- MODAL FOR NEW FORM -->
<?php

require_once "../Conexion.php";
$conexion = conexion();

?>

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

                <label>Número de salas con computadora</label>
                <input type="number" value="0" id="numero_sala_agregar" class="form-control-page input-group-sm">
                <br>

                <label>Ingrese la cantidad de computadoras por sala</label>

                <div id="div1">

                </div>

               </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-main" data-dismiss="modal" id="btn_agregar_stock">Agregar Nuevo Registro</button>
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
                <input type="number" readonly id="id_registro" class="form-control-page input-group-sm">

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

                <label>Número de sala</label>
                <input type="number" value="0" id="numero_sala_editar" class="form-control-page input-group-sm">

                <label>Ingrese la cantidad de computadoras por sala</label>

                <div id="div2">

                </div>

              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-main" data-dismiss="modal" id="btn_editar_stock">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var regexNum = /[^0-9]/g;
        div = document.getElementById("div1");


        $("#numero_sala_agregar").keyup(function () {

            valorSalas = parseInt($('#numero_sala_agregar').val());
            console.log(valorSalas);


            if(valorSalas <= 10){


                $('#div1').find('label').remove();
                $('#div1').find('input').remove();
                $('#div1').find('br').remove();



                for(i=0;i<valorSalas;i++){
                    g = document.createElement("input");
                    bk = document.createElement("br");
                    g.setAttribute("id",i);
                    g.setAttribute("type","number");
                    g.setAttribute("class","form-control-page input-group-sm")
                    div.appendChild(bk);
                    div.appendChild(g);

                }

            }
            else{

                $('#div1').find('label').remove();
                $('#div1').find('input').remove();
                $('#div1').find('br').remove();


                for(i=0;i<valorSalas;i++){


                    console.log(g);

                    if( g !== null){
                        $('#div1').find('input').remove();
                        $('#div1').find('br').remove();
                        $('#div1').find('label').remove();

                    }


                }

                g = document.createElement("input");
                bk = document.createElement("br");
                g.setAttribute("id","salaPromedio")
                g.setAttribute("type","number");
                g.setAttribute("class","form-control-page input-group-sm")
                div.appendChild(bk);
                div.appendChild(g);



            }



        });



        $('#btn_agregar_stock').click(function () {

            numeroSala=$('#numero_sala_agregar').val();



            suma = 0;
            sumaString = "";

            if(numeroSala<=4){
                numeroSalaEnt = 1;
                for(i=0;i<numeroSala;i++){
                    sala = document.getElementById(i);
                    suma = suma + parseInt(sala.value);
                    if(i!==0){
                        sumaString = sumaString + "," + sala.value;
                    }
                    else{
                        sumaString = sumaString + sala.value;
                    }

                }
            }
            else{
                numeroSalaEnt = parseInt(numeroSala);
                sala = document.getElementById("salaPromedio");
                sumaString =sala.value;
                suma = parseInt(sumaString);


            }
            console.log(sumaString);

            totalComp = suma * numeroSalaEnt;

            var area_sel = document.getElementById("area_academica_agregar");
            var area_valor = area_sel.options[area_sel.selectedIndex].value;

            area_academica = area_valor;

            if (numeroSala === "" || regexNum.test(numeroSala)){
                alertify.alert("Error","¡El campo Nombre de cuerpo académico esta vacío o usa caracteres no permitidos!");
                return false;
            } else {
                agregarDatos(area_academica, numeroSala, sumaString, totalComp);
            }
        });



        $('#btn_editar_stock').click(function () {
            actualizaDatos();
        });

    });

</script>