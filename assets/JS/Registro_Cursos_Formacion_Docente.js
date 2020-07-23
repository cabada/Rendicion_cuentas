function  agregarDatos(nombre_curso,periodo,no_participantes,horas_capacitacion) {

    cadena="nombre_curso=" + nombre_curso +
        "&periodo=" + periodo+
        "&num_participantes=" + no_participantes+
        "&horas_capacitacion=" + horas_capacitacion;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Cursos_Formacion_Docente/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cursos-formacion-docente').load('assets/components/registro-cursos-formacion-docente.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_curso_editar').val(d[0]);
    $('#nombre_curso_editar').val(d[1]);
    $('#periodo_editar').val(d[2]);
    $('#no_participantes_editar').val(d[3]);
    $('#no_capacitacion_editar').val(d[4]);

}

function actualizarDatos() {
    id_curso=parseInt($('#id_curso_editar').val());
    console.log(id_curso);
    nombre_curso= $('#nombre_curso_editar').val();
    periodo=$('#periodo_editar').val();
    no_participantes=parseInt($('#no_participantes_editar').val());
    no_capacitacion=parseInt($('#no_capacitacion_editar').val());
    console.log(nombre_curso);
    console.log(periodo);
    console.log(no_participantes);
    console.log(no_capacitacion);


    cadena="id_curso=" + id_curso+
        "&nombre_curso=" + nombre_curso +
        "&periodo=" + periodo+
        "&num_participantes=" + no_participantes+
        "&horas_capacitacion=" + no_capacitacion;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Cursos_Formacion_Docente/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cursos-formacion-docente').load('assets/components/registro-cursos-formacion-docente.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_curso){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_curso)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_curso) {
    cadena= "id_curso=" + id_curso;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Cursos_Formacion_Docente/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-cursos-formacion-docente').load('assets/components/registro-cursos-formacion-docente.php');
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
        url:'assets/components/registro-cursos-formacion-docente.php',
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
        url:'assets/components/registro-cursos-formacion-docente.php',
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
