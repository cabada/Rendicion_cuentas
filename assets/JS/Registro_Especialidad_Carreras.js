
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