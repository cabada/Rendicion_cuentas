
function agregardatos(id_carrera,nombre_especialidad){

    cadena="id_carrera=" + id_carrera +
        "&nombre_especialidad=" + nombre_especialidad;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Lineas_Investigacion_Licenciaturas/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                //cuando se agrega un registro se recarga la tabla
                $('#registro-lineas-investigacion-licenciaturas').load('assets/components/registro-lineas-investigacion-licenciaturas.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');
    $('option:selected', 'select[programa_educativo_editar="options"]').removeAttr('selected');
    //llenar valores de la caja de texto
    $('#id_linea').val(d[0]);
    $("#programa_educativo_editar option:contains('"+d[1]+"')").attr('selected', true);
    $('#investigacion_editar').val(d[2]);

}

function actualizaDatos() {

    id_linea=$('#id_linea').val();
    id_carrera=$('#programa_educativo_editar').val();
    nombre_especialidad=$('#investigacion_editar').val();

    cadena="id_linea=" + id_linea +
        "&id_carrera=" + id_carrera +
        "&nombre_especialidad=" + nombre_especialidad;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Lineas_Investigacion_Licenciaturas/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                //cuando se agrega un registro se recarga la tabla
                $('#registro-lineas-investigacion-licenciaturas').load('assets/components/registro-lineas-investigacion-licenciaturas.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function preguntarSiNo(id_linea) {
    alertify.confirm('Eliminar Registro','Esta seguro de eliminar este registro?',
        function (){ eliminarDatos(id_linea)}
        , function () { alertify.error('Se cancelo')});

}

function eliminarDatos(id_linea) {
    cadena="id_linea=" + id_linea;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Lineas_Investigacion_Licenciaturas/Eliminar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                //cuando se agrega un registro se recarga la tabla
                $('#registro-lineas-investigacion-licenciaturas').load('assets/components/registro-lineas-investigacion-licenciaturas.php');
                alertify.success("Eliminado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}
