
function agregardatos(periodo,anio,cantidad_alumnos) {

    cadena="periodo=" + periodo +
           "&anio=" + anio +
           "&cantidad_alumnos=" + cantidad_alumnos;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Estudiantes_Capacidades_Diferentes/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-estudiantes-capacidades-diferentes').load('assets/components/registro-estudiantes-capacidades-diferentes.php');
                alertify.success("agregado con exito");

            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function agregaform(datos) {

    d=datos.split('||');

    $('#id_estudiantes_capacidades_diferentes').val(d[0]);
    $('#periodo_editar').val(d[1]);
    $('#anio_editar').val(d[2]);
    $('#cantidad_estudiantes_editar').val(d[3]);

}

function actualizaDatos() {
    id_estudiantes_capacidades_diferentes=$('#id_estudiantes_capacidades_diferentes').val();
    periodo=$('#periodo_editar').val();
    anio=$('#anio_editar').val();
    cantidad_alumnos=$('#cantidad_estudiantes_editar').val();

    cadena="id_estudiantes_capacidades_diferentes=" + id_estudiantes_capacidades_diferentes +
        "&periodo=" + periodo +
        "&anio=" + anio +
        "&cantidad_alumnos=" + cantidad_alumnos;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Estudiantes_Capacidades_Diferentes/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-estudiantes-capacidades-diferentes').load('assets/components/registro-estudiantes-capacidades-diferentes.php');
                alertify.success("Actualizado con exito");

            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_estudiantes_capacidades_diferentes) {
    alertify.confirm('Eliminar Registro','Esta seguro de eliminar este registro?',
        function (){ eliminarDatos(id_estudiantes_capacidades_diferentes)}
        , function () { alertify.error('Se cancelo')});
}

function eliminarDatos(id_estudiantes_capacidades_diferentes) {

    cadena="id_estudiantes_capacidades_diferentes=" + id_estudiantes_capacidades_diferentes;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Estudiantes_Capacidades_Diferentes/Eliminar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-estudiantes-capacidades-diferentes').load('assets/components/registro-estudiantes-capacidades-diferentes.php');
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
        url:'assets/components/registro-estudiantes-capacidades-diferentes.php',
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
        url:'assets/components/registro-estudiantes-capacidades-diferentes.php',
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

        console.log(valor);

    }
    else{
        buscar_datos_anio('Todos los registros');
        $('#caja_busqueda').val('');
        buscar_datos("");
    }
});
