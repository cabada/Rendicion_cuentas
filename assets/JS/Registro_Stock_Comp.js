

function agregarDatos(area_academica,numeroSala,sumaString,totalComp){

    cadena="area_academica=" + area_academica +
        "&numeroSala=" + numeroSala +
        "&numeroComp=" + sumaString +
        "&total=" + totalComp;


    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Stock_Comp/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-stock-salas-comp').load('assets/components/registro-stock-salas-comp.php');
                alertify.success("agregado con exito");

            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {

    d = datos.split('||');
    $('option:selected', 'select[area_academica_editar="options"]').removeAttr('selected');
    $('#div2').find('label').remove();
    $('#div2').find('input').remove();
    $('#div2').find('br').remove();


    $('#id_registro').val(d[0]);
    $("#area_academica_editar option:contains('" + d[1] + "')").attr('selected', true);

    $('#numero_sala_editar').val(d[2]);
    numeroSala = parseInt(d[2]);


    numeroComputadoras = d[3];
    console.log(numeroSala);
    div1 = document.getElementById("div2");

    if (numeroSala <= 4) {
        numeroComputadoras = numeroComputadoras.split(",");


        for (i = 0; i < numeroSala; i++) {

            console.log(numeroComputadoras[i]);
            g = document.createElement("input");
            bk = document.createElement("br");
            g.setAttribute("id", i+"editar");
            g.setAttribute("type", "number");
            g.setAttribute("class", "form-control-page input-group-sm")
            g.value = numeroComputadoras[i];
            div1.appendChild(bk);
            div1.appendChild(g);


        }


    } else {
        g = document.createElement("input");
        bk = document.createElement("br");
        g.setAttribute("type", "number");
        g.setAttribute("class", "form-control-page input-group-sm");
        g.setAttribute("id","unaSala");
        g.value = numeroComputadoras;
        div1.appendChild(bk);
        div1.appendChild(g);


    }


    $(document).ready(function () {

        $("#numero_sala_editar").keyup(function () {

            console.log("hola");

            numeroSala =  $("#numero_sala_editar").val();

            if (numeroSala <= 4 && numeroSala!="") {
                $('#div2').find('label').remove();
                $('#div2').find('input').remove();
                $('#div2').find('br').remove();


                for (i = 0; i < numeroSala; i++) {

                    console.log(numeroComputadoras[i]);
                    g = document.createElement("input");
                    bk = document.createElement("br");
                    g.setAttribute("id", i+"editar");
                    g.setAttribute("type", "number");
                    g.setAttribute("class", "form-control-page input-group-sm")
                    g.value = numeroComputadoras[i];
                    div1.appendChild(bk);
                    div1.appendChild(g);


                }



            }
            else{
                $('#div2').find('label').remove();
                $('#div2').find('input').remove();
                $('#div2').find('br').remove();

                g = document.createElement("input");
                bk = document.createElement("br");
                g.setAttribute("type", "number");
                g.setAttribute("class", "form-control-page input-group-sm");
                g.value = numeroComputadoras;
                g.setAttribute("id","unaSala");
                div1.appendChild(bk);
                div1.appendChild(g);


            }

        });


    });
}

function actualizaDatos(){

    id_registro=$('#id_registro').val();

    var area_sel = document.getElementById("area_academica_editar");
    var area_valor = area_sel.options[area_sel.selectedIndex].value;

    area_academica = area_valor;

    numeroSala=$('#numero_sala_editar').val();


        suma = 0;
        sumaString = "";

        if(numeroSala<=4){
            numeroSalaEnt = 1;
            for(i=0;i<numeroSala;i++){
                sala = document.getElementById(i+"editar");
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
            sala = document.getElementById("unaSala");
            sumaString =sala.value;
            suma = parseInt(sumaString);


        }

        totalComp = suma * numeroSalaEnt;


    cadena="id_registro=" + id_registro +
        "&area_academica=" + area_academica +
        "&numeroSala=" + numeroSala +
        "&numeroComp=" + sumaString +
        "&total=" + totalComp;
    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Stock_Comp/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-stock-salas-comp').load('assets/components/registro-stock-salas-comp.php');
                alertify.success("Actualizado con exito");

            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_registro) {
    alertify.confirm('Eliminar Registro', '¿Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_registro) }
        , function(){ alertify.error('Se cancelo.')});

}

function eliminarDatos(id_registro) {
    cadena="id_registro=" + id_registro;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Stock_Comp/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-stock-salas-comp').load('assets/components/registro-stock-salas-comp.php');
                alertify.success("Eliminado con exito");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }

    });


}

// FUNCION PARA BUSCAR DATOS DE TABLA LISTADO DE MAESTROS CON CERTIFICACIONES
//BUSCAR CON BUSCADOR DE TEXTO
$(buscar_datos());
function buscar_datos(consulta){
    $.ajax({
        url:'assets/components/registro-stock-salas-comp.php',
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta},
    })
        .done(function(respuesta){
            $("#tabla-php").html($(respuesta).find('#tabla-php'));
        })
        .fail(function(){
            console.log("error");
        });
}

$(document).on('keyup','#caja_busqueda', function(){
    var valor = $(this).val();
    if (valor != "") {
        buscar_datos(valor);
    }else{
        buscar_datos();
    }
});

//BUSCADOR CON FECHA
$(buscar_datos());
function buscar_datos_anio(consulta_anio){
    $.ajax({
        url:'assets/components/registro-stock-salas-comp.php',
        type: 'POST' ,
        dataType: 'html',
        data: {consulta_anio: consulta_anio},
    })
        .done(function(respuesta){
            $("#tabla-php").html($(respuesta).find('#tabla-php'));
        })
        .fail(function(){
            console.log("error");
        });
}

$(document).on('change','.anio', function(){


    var valor = $(this).val();
    if (valor != "") {
        buscar_datos_anio(valor);
    }else{
        buscar_datos_anio();
    }
});


