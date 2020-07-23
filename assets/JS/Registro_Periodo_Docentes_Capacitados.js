

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
                alertify.error("No tiene los privilegios suficientes...");
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
    porcentaje = Math.round(porcentaje);
    porcentaje = porcentaje.toString() + "%";


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
                alertify.error("No tiene los privilegios suficientes...");
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
        url:'assets/components/registro-periodo-docentes-capacitados.php',
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
        url:'assets/components/registro-periodo-docentes-capacitados.php',
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

    }
    else{
        buscar_datos_anio('Todos los registros');
        $('#caja_busqueda').val('');
        buscar_datos("");
    }
});
