
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