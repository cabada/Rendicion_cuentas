
function agregardatos(programa,cantidad,registrado_en) {

    cadena="programa=" + programa +
        "&cantidad=" + cantidad +
        "&registrado_en=" + registrado_en;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Total_Alumnos_Programa_Posgrado/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-total-alumnos-programa-posgrado').load('assets/components/registro-total-alumnos-programa-posgrado.php');
                alertify.success("agregado con exito");

            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('option:selected', 'select[nombre_curso_editar="options"]').removeAttr('selected');


    $('#id_total_prog_posgrado').val(d[0]);
    $("#nombre_curso_editar option:contains('"+d[1]+"')").attr('selected', true);

    $('#cantidad_editar').val(d[2]);
    $('#registro_editar').val(d[3]);

}

function actualizaDatos(){

    id_total_prog_posgrado=$('#id_total_prog_posgrado').val();
    var carrera_sel = document.getElementById("nombre_curso_editar");
    var carrera_valor = carrera_sel.options[carrera_sel.selectedIndex].value;

    id_carrera=carrera_valor;
    cantidad=$('#cantidad_editar').val();
    registrado_en=$('#registro_editar').val();

    cadena="id_total_prog_posgrado=" + id_total_prog_posgrado +
        "&programa=" + id_carrera +
        "&cantidad=" + cantidad +
        "&registrado_en=" + registrado_en;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Total_Alumnos_Programa_Posgrado/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-total-alumnos-programa-posgrado').load('assets/components/registro-total-alumnos-programa-posgrado.php');
                alertify.success("Actualizado con exito");

            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function preguntarSiNo(id_total_prog_posgrado) {
    alertify.confirm('Eliminar Registro', '¿Esta seguro de eliminar este registro?',
        function(){eliminarDatos(id_total_prog_posgrado) }
        , function(){ alertify.error('Se cancelo.')});
}

function eliminarDatos(id_total_prog_posgrado) {

    cadena="id_total_prog_posgrado=" + id_total_prog_posgrado;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Total_Alumnos_Programa_Posgrado/Eliminar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-total-alumnos-programa-posgrado').load('assets/components/registro-total-alumnos-programa-posgrado.php');
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
        url:'assets/components/registro-total-alumnos-programa-posgrado.php',
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
    console.log(valor);
    if (valor != "") {
        buscar_datos(valor);
    }else {
        //verifica que la variable global no este vacia
        if (window.valor !== "") {

            //valorAnio es igual al valor de la variable global
            valorAnio = window.valor;

            console.log(valorAnio);
            buscar_datos_anio(valorAnio);

        } else {

            buscar_datos();

        }
    }
});

//BUSCADOR CON FECHA
$(buscar_datos());
function buscar_datos_anio(consulta_anio){
    $.ajax({
        url:'assets/components/registro-total-alumnos-programa-posgrado.php',
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

        //variable global
        window.valor = valor;

        buscar_datos_anio(valor);
        console.log(valor);

    }
    else{
        //variable global
        window.valor="";
        buscar_datos_anio('Todos los registros');
        $('#caja_busqueda').val('');
        buscar_datos("");
    }
});
