
function agregardatos(nombre_especialidad,id_carrera){

    cadena="nombre_especialidad=" + nombre_especialidad +
           "&id_carrera=" + id_carrera;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Especialidad_Carreras/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                //cuando se agrega un registro se recarga la tabla
                $('#registro-especialidad-carreras').load('assets/components/registro-especialidad-carreras.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("Fallo el servidor");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');
    //llenar valores de la caja de texto
    $('#id_especialidad_carrera').val(d[0]);
    $('#nombre_especialidad_editar').val(d[1]);
    $('#programa_educativo_editar').val(d[2]);

}

function actualizaDatos() {

    id_especialidad_carrera=$('#id_especialidad_carrera').val();
    nombre_especialidad=$('#nombre_especialidad_editar').val();
    id_carrera=$('#programa_educativo_editar').val();

    cadena="id_especialidad_carrera=" + id_especialidad_carrera +
        "&nombre_especialidad=" + nombre_especialidad +
        "&id_carrera=" + id_carrera;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Especialidad_Carreras/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                //cuando se agrega un registro se recarga la tabla
                $('#registro-especialidad-carreras').load('assets/components/registro-especialidad-carreras.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("Fallo el servidor");
            }
        }
    });
}




