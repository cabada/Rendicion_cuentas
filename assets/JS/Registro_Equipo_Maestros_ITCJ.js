function  agregarDatos(nombre_docente,categoria,grado_estudios,sni,area_especializacion,
                       experiencia_profesional,experiencia_docente) {

    cadena="nombre_docente=" + nombre_docente +
        "&categoria=" + categoria +
        "&grado_estudios=" + grado_estudios +
        "&sni=" + sni +
        "&area_especializacion=" + area_especializacion +
        "&experiencia_profesional=" + experiencia_profesional +
        "&experiencia_docente=" + experiencia_docente;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Equipo_Maestros_ITCJ/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-equipo-maestros-itcj').load('assets/components/registro-equipo-maestros-itcj.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_editar').val(d[0]);
    $('#nombre_editar').val(d[1]);
    $('#categoria_editar').val(d[2]);
    $('#grado_estudios_editar').val(d[3]);
    $('#sni_editar').val(d[4]);
    $('#area_especializacion_editar').val(d[5]);
    $('#experiencia_profesional_editar').val(d[6]);
    $('#experiencia_docente_editar').val(d[7]);

}

function actualizarDatos() {
    id_equipo_ms=$('#id_editar').val();
    nombre_docente=$('#nombre_editar').val();
    categoria=$('#categoria_editar').val();
    grado_estudios=$('#grado_estudios_editar').val();
    sni=$('#sni_editar').val();
    area_especializacion=$('#area_especializacion_editar').val();
    experiencia_profesional=$('#experiencia_profesional_editar').val();
    experiencia_docente=$('#experiencia_docente_editar').val();

    cadena="id_equipo_ms=" + id_equipo_ms +
        "&nombre_docente=" + nombre_docente +
        "&categoria=" + categoria +
        "&grado_estudios=" + grado_estudios +
        "&sni=" + sni +
        "&area_especializacion=" + area_especializacion +
        "&experiencia_profesional=" + experiencia_profesional +
        "&experiencia_docente=" + experiencia_docente;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Equipo_Maestros_ITCJ/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-equipo-maestros-itcj').load('assets/components/registro-equipo-maestros-itcj.php');
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
function eliminarDatos(id_equipo_ms) {
    cadena= "id_equipo_ms=" + id_equipo_ms;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Equipo_Maestros_ITCJ/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-equipo-maestros-itcj').load('assets/components/registro-equipo-maestros-itcj.php');
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
        url:'assets/components/registro-equipo-maestros-itcj.php',
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
        url:'assets/components/registro-equipo-maestros-itcj.php',
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
    if (valor != "") {
        buscar_datos_anio(valor);
    }else{
        buscar_datos_anio();
    }
});
