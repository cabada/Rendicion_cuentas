function  agregarDatos(periodo,numero_docentes) {

    cadena="periodo=" + periodo +
        "&numero_docentes=" + numero_docentes;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_MOOCS/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cantidad-docentes-moocs').load('assets/components/registro-cantidad-docentes-moocs.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_moocs_editar').val(d[0]);
    $('#periodo_editar').val(d[1]);
    $('#cantidad_docentes_editar').val(d[2]);

}

function actualizarDatos() {
    id_moocs=parseInt($('#id_moocs_editar').val());
    console.log(id_moocs);
    periodo= $('#periodo_editar').val();
    console.log(periodo);
    numero_docentes=parseInt($('#cantidad_docentes_editar').val());
    console.log(numero_docentes);


    cadena="id_moocs="+id_moocs+
        "&periodo=" + periodo+
        "&numero_docentes=" + numero_docentes;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_MOOCS/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cantidad-docentes-moocs').load('assets/components/registro-cantidad-docentes-moocs.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_moocs){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_moocs)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_moocs) {
    cadena= "id_moocs=" + id_moocs;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_MOOCS/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-cantidad-docentes-moocs').load('assets/components/registro-cantidad-docentes-moocs.php');
                alertify.success("Eliminado con exito!");
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
        url:'assets/components/registro-cantidad-docentes-moocs.php',
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
        url:'assets/components/registro-cantidad-docentes-moocs.php',
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
    }else{
        buscar_datos_anio();
        $('#caja_busqueda').val('');
        buscar_datos("");
    }
});
