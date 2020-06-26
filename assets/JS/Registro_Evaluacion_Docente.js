function  agregarDatos(periodo,docentes_evaluados,porcentaje) {

    cadena="periodo=" + periodo +
        "&docentes_evaluados=" + docentes_evaluados +
        "&porcentaje=" + porcentaje;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Evaluacion_Docente/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-evaluacion-docente').load('assets/components/registro-evaluacion-docente.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_evaluacion_doc').val(d[0]);
    $('#periodo_editar').val(d[1]);
    $('#docentes_activos_evaluados_editar').val(d[2]);
    $('#porcentaje_editar').val(d[3]);

}

function actualizarDatos() {
    id_evaluacion_doc=$('#id_evaluacion_doc').val();
    console.log(id_evaluacion_doc);
    periodo=$('#periodo_editar').val();
    console.log(periodo);
    docentes_evaluados= parseInt($('#docentes_activos_evaluados_editar').val());
    console.log(docentes_evaluados);
    porcentaje=$('#porcentaje_editar').val();
    console.log(porcentaje);



    cadena="id_evaluacion_doc="+id_evaluacion_doc+
        "&periodo=" + periodo +
        "&docentes_evaluados=" + docentes_evaluados +
        "&porcentaje=" + porcentaje;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Evaluacion_Docente/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-evaluacion-docente').load('assets/components/registro-evaluacion-docente.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_evaluacion_doc){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_evaluacion_doc)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_evaluacion_doc) {
    cadena= "id_evaluacion_doc=" + id_evaluacion_doc;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Evaluacion_Docente/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-evaluacion-docente').load('assets/components/registro-evaluacion-docente.php');
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
        url:'assets/components/registro-evaluacion-docente.php',
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
        url:'assets/components/registro-evaluacion-docente.php',
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
    if (valor != "Todos los registros") {
        buscar_datos_anio(valor);
        
    } else {
        buscar_datos_anio('Todos los registros');
        $('#caja_busqueda').val('');
        buscar_datos("");
    }
});