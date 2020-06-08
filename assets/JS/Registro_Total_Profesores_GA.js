function  agregarDatos(grado,cantidad) {

    cadena="grado=" + grado +
        "&cantidad=" + cantidad;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Total_Profesores_GA/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-total-profesores').load('assets/components/registro-total-profesores.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_total_editar').val(d[0]);
    $('#grado_editar').val(d[1]);
    $('#cantidad_editar').val(d[2]);

}

function actualizarDatos() {
    id_prof_grad_acad_=parseInt($('#id_total_editar').val());
    console.log(id_prof_grad_acad_);
    grado= $('#grado_editar').val();
    console.log(grado);
    cantidad=parseInt($('#cantidad_editar').val());
    console.log(cantidad);


    cadena="id_prof_grado_acad="+id_prof_grad_acad_+
        "&grado=" + grado+
        "&cantidad=" + cantidad;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Total_Profesores_GA/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-total-profesores').load('assets/components/registro-total-profesores.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_prof_grad_acad){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_prof_grad_acad)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_prof_grad_acad) {
    cadena= "id_prof_grado_acad=" + id_prof_grad_acad;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Total_Profesores_GA/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-total-profesores').load('assets/components/registro-total-profesores.php');
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
        url:'assets/components/registro-total-profesores.php',
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
        url:'assets/components/registro-total-profesores.php',
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
        buscar_datos_anio();
        $('#caja_busqueda').val('');
        buscar_datos("");
    }
});