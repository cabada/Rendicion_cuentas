function agregarDatos(nombre_completo,area_academica,
                      vigencia) {
    cadena = "nombre_completo=" + nombre_completo +
        "&area_academica=" + area_academica +
        "&vigencia=" + vigencia;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Docentes_Perfil/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-docentes-reconocimiento-perfil-deseable').load('assets/components/registro-docentes-reconocimiento-perfil-deseable.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

//==============================================================================================

function agregaform(datos) {

    d=datos.split('||');

    $('option:selected', 'select[area_academica_editar="options"]').removeAttr('selected');

    $('#id_profesor').val(d[0]);
    $('#nombre_editar').val(d[1]);
    $("#area_academica_editar option:contains('"+d[2]+"')").attr('selected', true);

    console.log(d[2]);
    $('#vigencia_editar').val(d[3]);




}

function actualizaDatos() {


    id_profesor=$('#id_profesor').val();

    var area_sel = document.getElementById("area_academica_editar");
    var area_valor = area_sel.options[area_sel.selectedIndex].value;


    nombre_completo = $('#nombre_editar').val();
    area_academica = parseInt( $('#area_academica_editar').val());
    console.log(area_academica);
    vigencia = $('#vigencia_editar').val();



    cadena = "id_profesor="+ id_profesor +
        "&nombre_completo=" + nombre_completo +
        "&area_academica=" + area_academica +
        "&vigencia=" + vigencia;



    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Docentes_Perfil/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-docentes-reconocimiento-perfil-deseable').load('assets/components/registro-docentes-reconocimiento-perfil-deseable.php');
                alertify.success("Actualizado con exito: ");
            }
            else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}


function preguntarSiNo(id_profesor) {

    alertify.confirm('Eliminar Registro', 'Esta seguro de eliminar este registro??',
        function(){ eliminarDatos(id_profesor) }
        , function(){ alertify.error('Se cancelo.')});

}

function eliminarDatos(id_profesor) {
    cadena = "id_profesor="+id_profesor ;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Docentes_Perfil/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-docentes-reconocimiento-perfil-deseable').load('assets/components/registro-docentes-reconocimiento-perfil-deseable.php');
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
        url:'assets/components/registro-docentes-reconocimiento-perfil-deseable.php',
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
        url:'assets/components/registro-docentes-reconocimiento-perfil-deseable.php',
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
        buscar_datos_anio();
        $('#caja_busqueda').val('');
        buscar_datos("");
    }
});