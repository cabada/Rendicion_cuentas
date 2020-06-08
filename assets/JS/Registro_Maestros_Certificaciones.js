function agregarDatos(nombre_completo,area_academica,
                      disciplina) {
    cadena = "nombre_completo=" + nombre_completo +
        "&area_academica=" + area_academica +
        "&disciplina=" + disciplina;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Maestros_Certificaciones/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-listado-maestros-certificaciones').load('assets/components/registro-listado-maestros-certificaciones.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

//==============================================================================================

function agregaform(datos) {

    d=datos.split('||');

    console.log(d);

    $('option:selected', 'select[area_academica_editar="options"]').removeAttr('selected');

    $('#id_profesor').val(d[0]);
    $('#nombre_editar').val(d[1]);
    $("#area_academica_editar option:contains('"+d[2]+"')").attr('selected', true);
    $('#disciplina_editar').val(d[3]);




}

function actualizaDatos() {


    id_profesor=$('#id_profesor').val();

    var area_sel = document.getElementById("area_academica_editar");
    var area_valor = area_sel.options[area_sel.selectedIndex].value;


    nombre_completo = $('#nombre_editar').val();
    area_academica = parseInt( $('#area_academica_editar').val());
    console.log(area_academica);
    disciplina = $('#disciplina_editar').val();
    console.log(disciplina);


    cadena = "id_profesor="+ id_profesor +
        "&nombre_completo=" + nombre_completo +
        "&area_academica=" + area_academica +
        "&disciplina=" + disciplina;



    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Maestros_Certificaciones/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-listado-maestros-certificaciones').load('assets/components/registro-listado-maestros-certificaciones.php');
                alertify.success("Actualizado con exito: ");
            }
            else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}


function preguntarSiNo(id_profesor) {

    alertify.confirm('Eliminar Registro', 'Esta seguro de eliminar este registro??',
        function(){ eliminarDatos(id_profesor) }
        , function(){ alertify.error('Se cancelo.')});

}

function eliminarDatos(id_profesor) {
    cadena = "id_profesor="+id_profesor ;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Maestros_Certificaciones/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-listado-maestros-certificaciones').load('assets/components/registro-listado-maestros-certificaciones.php');
                alertify.success("Eliminado con exito!");
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
        url:'assets/components/registro-listado-maestros-certificaciones.php',
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta},
    })
        .done(function(respuesta){

            //Se pone el ID de la tabla en los dos argumentos por ejemplo
            // $("#ID_TABLA").html($(respuesta).find("#ID_TABLA"));
            $("#tabla-php").html($(respuesta).find("#tabla-php"));
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
        url:'assets/components/registro-listado-maestros-certificaciones.php',
        type: 'POST' ,
        dataType: 'html',
        data: {consulta_anio: consulta_anio},
    })
        .done(function(respuesta){
            //Se pone el ID de la tabla en los dos argumentos por ejemplo
            // $("#ID_TABLA").html($(respuesta).find("#ID_TABLA"));
           $("#tabla-php").html($(respuesta).find("#tabla-php"));
        })
        .fail(function(){
            console.log("error");
        });
}

$(document).on('change','.anio', function(){


    var valor = $(this).val();
    if (valor != "Todos los registros") {
        buscar_datos_anio(valor);

        console.log(valor);

    }
    else{
        buscar_datos_anio('Todos los registros');
        $('#caja_busqueda').val('');
        buscar_datos("");
    }
});