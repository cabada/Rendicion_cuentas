function  agregarDatos(cantidad_tiempo_parcial,grado) {

    cadena="cantidad_tiempo_parcial=" + cantidad_tiempo_parcial +
        "&grado=" + grado;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Profesores_Tiempo_Parcial/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-tiempo-parcial-profesores').load('assets/components/registro-tiempo-parcial-profesores.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("Fallo el servidor");
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
                alertify.error("Fallo el servidor");
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
                alertify.error("Fallo el servidor!");
            }
        }
    });
}
