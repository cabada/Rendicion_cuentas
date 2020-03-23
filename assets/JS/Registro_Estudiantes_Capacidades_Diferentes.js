
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
                alertify.error("fallo el servidor");
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