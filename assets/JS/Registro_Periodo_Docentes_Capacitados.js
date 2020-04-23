

function agregardatos(tipo_nombramiento,total_docentes,no_docentes_capacitados,porcentaje,periodo){

    cadena="tipo_nombramiento=" + tipo_nombramiento +
        "&total_docentes=" + total_docentes +
        "&no_docentes_capacitados=" + no_docentes_capacitados +
        "&porcentaje=" + porcentaje +
        "&periodo=" + periodo;


    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Periodo_Docentes_Capacitados/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-periodo-docentes-capacitados').load('assets/components/registro-periodo-docentes-capacitados.php');
                alertify.success("agregado con exito");

            }else{
                alertify.error("fallo el servidor");
            }
        }
    });
}

function agregaform(datos) {

    d=datos.split('||');

    $('#id_periodo').val(d[0]);
    $('#nombramiento_editar').val(d[1]);
    $('#cantidad_docentes_editar').val(d[2]);
    $('#cantidad_docentes_no_capacitados_editar').val(d[3]);
    $('#periodo_editar').val(d[5]);

}

function actualizaDatos(){

    id_periodo=$('#id_periodo').val();

    tipo_nombramiento=$('#nombramiento_editar').val();

    console.log(tipo_nombramiento);

    total_docentes=parseInt($('#cantidad_docentes_editar').val());
    console.log(total_docentes);

    no_docentes_capacitados=parseInt($('#cantidad_docentes_no_capacitados_editar').val());

    console.log(no_docentes_capacitados);


    porcentaje= (no_docentes_capacitados*100)/total_docentes;
    porcentaje = porcentaje.toString() + "%"


    console.log(porcentaje);
    periodo=$('#periodo_editar').val();
    console.log(periodo);

    cadena="id_periodo=" + id_periodo +
        "&tipo_nombramiento=" + tipo_nombramiento +
        "&total_docentes=" + total_docentes +
        "&no_docentes_capacitados=" + no_docentes_capacitados +
        "&porcentaje=" + porcentaje +
        "&periodo=" + periodo;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Periodo_Docentes_Capacitados/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-periodo-docentes-capacitados').load('assets/components/registro-periodo-docentes-capacitados.php');
                alertify.success("Actualizado con exito");

            }else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}

function preguntarSiNo(id_periodo) {
    alertify.confirm('Eliminar Registro', '¿Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_periodo) }
        , function(){ alertify.error('Se cancelo.')});

}

function eliminarDatos(id_periodo) {
    cadena="id_periodo=" + id_periodo;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Periodo_Docentes_Capacitados/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-periodo-docentes-capacitados').load('assets/components/registro-periodo-docentes-capacitados.php');
                alertify.success("Eliminado con exito");
            }else{
                alertify.error("Fallo el servidor");
            }
        }

    });


}

