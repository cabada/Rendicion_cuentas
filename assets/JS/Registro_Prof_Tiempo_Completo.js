function agregarDatos(grado,mujer,hombre,total) {
    cadena = "grado=" + grado +
        "&mujer=" + mujer +
        "&hombre=" + hombre +
        "&total=" + total ;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Profesores_Tiempo_Completo_Grado_Academico/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-profesores-tiempo-completo-grado-academico').load('assets/components/registro-profesores-tiempo-completo-grado-academico.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function agregaform(datos) {

    d=datos.split('||');

    $('#id_registro').val(d[0]);
    $('#grado_editar').val(d[1]);
    $('#mujer_editar').val(d[2]);
    $('#hombre_editar').val(d[3]);
    $('#total_editar').val(d[4]);

}

function actualizaDatos() {


    id_registro =parseInt($('#id_registro').val());

    grado = $('#grado_editar').val();
    console.log(grado);
    mujer = parseInt($('#mujer_editar').val());
    console.log(mujer);
    hombre = parseInt($('#hombre_editar').val());
    console.log(hombre);
    total = mujer + hombre;

    cadena = "id_registro="+ id_registro +
        "&grado=" + grado +
        "&mujer=" + mujer +
        "&hombre=" + hombre +
        "&total=" + total;



    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Profesores_Tiempo_Completo_Grado_Academico/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-profesores-tiempo-completo-grado-academico').load('assets/components/registro-profesores-tiempo-completo-grado-academico.php');
                alertify.success("Actualizado con exito: ");
            }
            else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}


function preguntarSiNo(id_registro) {

    alertify.confirm('Eliminar Registro', 'Esta seguro de eliminar este registro??',
        function(){ eliminarDatos(id_registro) }
        , function(){ alertify.error('Se cancelo.')});


}

function eliminarDatos(id_registro) {

    cadena = "id_registro="+ id_registro;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Profesores_Tiempo_Completo_Grado_Academico/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-profesores-tiempo-completo-grado-academico').load('assets/components/registro-profesores-tiempo-completo-grado-academico.php');
                alertify.success("Eliminado con exito!")
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
        url:'assets/components/registro-profesores-tiempo-completo-grado-academico.php',
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
        url:'assets/components/registro-profesores-tiempo-completo-grado-academico.php',
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
        
    } else {
        buscar_datos_anio('Todos los registros');
        $('#caja_busqueda').val('');
        buscar_datos("");
    }
});