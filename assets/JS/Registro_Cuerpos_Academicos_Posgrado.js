
function agregarDatos(nombre_cuerpo,grado,estado,anio_registro,vigencia,area) {

    cadena= "nombre_cuerpo=" + nombre_cuerpo +
        "&grado=" + grado +
        "&estado=" + estado +
        "&anio_registro=" + anio_registro +
        "&vigencia=" + vigencia +
        "&area=" + area;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Cuerpos_Academicos_Posgrado/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cuerpos-academicos-posgrado').load('assets/components/registro-cuerpos-academicos-posgrado.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_cuerpos_academicos_posgrado').val(d[0]);
    $('#nombre_cuerpo_academico_editar').val(d[1]);
    $('#grado_editar').val(d[2]);
    $('#nombre_estado_editar').val(d[3]);
    $('#anio_registro_editar').val(d[4]);
    $('#vigencia_editar').val(d[5]);
    $('#area_editar').val(d[6]);

}

function actualizarDatos() {
    id_cuerpos_academicos_posgrado=$('#id_cuerpos_academicos_posgrado').val();
    nombre_cuerpo=$('#nombre_cuerpo_academico_editar').val();
    grado=$('#grado_editar').val();
    estado=$('#nombre_estado_editar').val();
    anio_registro=$('#anio_registro_editar').val();
    vigencia=$('#vigencia_editar').val();
    area=$('#area_editar').val();

    cadena="id_cuerpos_academicos_posgrado=" + id_cuerpos_academicos_posgrado +
        "&nombre_cuerpo=" + nombre_cuerpo +
        "&grado=" + grado +
        "&estado=" + estado +
        "&anio_registro=" + anio_registro +
        "&vigencia=" + vigencia +
        "&area=" + area;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Cuerpos_Academicos_Posgrado/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cuerpos-academicos-posgrado').load('assets/components/registro-cuerpos-academicos-posgrado.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_cuerpos_academicos_posgrado){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_cuerpos_academicos_posgrado)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_cuerpos_academicos_posgrado) {
    cadena= "id_cuerpos_academicos_posgrado=" + id_cuerpos_academicos_posgrado;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Cuerpos_Academicos_Posgrado/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-cuerpos-academicos-posgrado').load('assets/components/registro-cuerpos-academicos-posgrado.php');
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
        url:'assets/components/registro-cuerpos-academicos-posgrado.php',
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta},
    })
        .done(function(respuesta){

            //Se pone el ID de la tabla en los dos argumentos por ejemplo
            // $("#ID_TABLA").html($(respuesta).find("#ID_TABLA"));
            $("#tabla-php").html($(respuesta).find("#tabla-php"));
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
        url:'assets/components/registro-cuerpos-academicos-posgrado.php',
        type: 'POST' ,
        dataType: 'html',
        data: {consulta_anio: consulta_anio},
    })
        .done(function(respuesta){
            //Se pone el ID de la tabla en los dos argumentos por ejemplo
            // $("#ID_TABLA").html($(respuesta).find("#ID_TABLA"));
            $("#tabla-php").html($(respuesta).find("#tabla-php"));
        })
        .fail(function(){
            console.log("error");
        });
}

$(document).on('change','.anio', function(){


    var valor = $(this).val();
    if (valor != "") {
        buscar_datos_anio(valor);
    }else{
        buscar_datos_anio();
    }
});
