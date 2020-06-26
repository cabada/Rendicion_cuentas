function  agregarDatos(nombre,puesto,grado_estudios,funciones) {

    cadena="nombre=" + nombre +
        "&puesto=" + puesto +
        "&grado_estudios=" + grado_estudios +
        "&funciones=" + funciones ;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Equipo_Apoyo_Asesores/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-equipo-apoyo-asesores').load('assets/components/registro-equipo-apoyo-asesores.php');
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
    $('#puesto_editar').val(d[2]);
    $('#grado_estudios_editar').val(d[3]);
    $('#funciones_tecnm_editar').val(d[4]);

}

function actualizarDatos() {
    id_equipo_apoyo_as=$('#id_editar').val();
    console.log(id_equipo_apoyo_as);
    nombre=$('#nombre_editar').val();
    console.log(nombre);
    puesto=$('#puesto_editar').val();
    console.log(puesto);
    grado_estudios=$('#grado_estudios_editar').val();
    console.log(grado_estudios);
    funciones=$('#funciones_tecnm_editar').val();
    console.log(funciones);


    cadena="id_equipo_apoyo_as=" + id_equipo_apoyo_as+
        "&nombre=" + nombre +
        "&puesto=" + puesto +
        "&grado_estudios=" + grado_estudios +
        "&funciones=" + funciones;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Equipo_Apoyo_Asesores/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-equipo-apoyo-asesores').load('assets/components/registro-equipo-apoyo-asesores.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_equipo_apoyo_as){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_equipo_apoyo_as)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_equipo_apoyo_as) {
    cadena= "id_equipo_apoyo_as=" + id_equipo_apoyo_as;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Equipo_Apoyo_Asesores/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-equipo-maestros-itcj').load('assets/components/registro-equipo-apoyo-asesores.php');
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
        url:'assets/components/registro-equipo-apoyo-asesores.php',
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
        url:'assets/components/registro-equipo-apoyo-asesores.php',
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
