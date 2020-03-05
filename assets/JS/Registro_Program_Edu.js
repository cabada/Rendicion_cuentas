function agregarDatos(carrera,modalidad,nuevo_ingreso, reingreso,status,
                      periodo) {
    cadena = "carrera=" + carrera +
        "&modalidad=" + modalidad +
        "&nuevo_ingreso=" + nuevo_ingreso +
        "&reingreso=" + reingreso +
        "&status=" + status +
        "&periodo=" + periodo;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Programa_Educativo/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-programa-educativo').load('assets/components/registro-programa-educativo.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}

function agregaForm(datos) {

    d = datos.split('||');

    $('#id_programa_educativo').val(d[0]);
    $('#carrera_editar').val(d[1]);
    $('#modalidad_editar').val(d[2]);
    $('#ingreso_editar').val(d[3]);
    $('#reingreso_editar').val(d[4]);
    $('#estatus_editar').val(d[5]);
    $('#periodo_editar').val(d[6]);

}

