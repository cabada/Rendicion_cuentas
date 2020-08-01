function  agregarDatos(profesor,proyecto_realizado) {

    cadena="profesor=" + profesor +
        "&proyecto_realizado=" + proyecto_realizado;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Producto_Anio_Sabatico/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-anio-sabatico').load('assets/components/registro-anio-sabatico.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_prof_editar').val(d[0]);
    $('#profesor_editar').val(d[1]);
    $('#proyecto_realizado_editar').val(d[2]);

}

function actualizarDatos() {
    id_sabatico=parseInt($('#id_prof_editar').val());
    console.log(id_sabatico);
    profesor= $('#profesor_editar').val();
    console.log(profesor);
    proyecto_realizado=$('#proyecto_realizado_editar').val();
    console.log(proyecto_realizado);


    cadena="id_sabatico="+id_sabatico+
        "&profesor=" + profesor+
        "&proyecto_realizado=" + proyecto_realizado;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Producto_Anio_Sabatico/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-anio-sabatico').load('assets/components/registro-anio-sabatico.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los permisos suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_sabatico){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_sabatico)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_sabatico) {
    cadena= "id_sabatico=" + id_sabatico;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Producto_Anio_Sabatico/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-anio-sabatico').load('assets/components/registro-anio-sabatico.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("No tiene los permisos suficientes...");
            }
        }
    });
}

// FUNCION PARA BUSCAR DATOS DE TABLA LISTADO DE MAESTROS CON CERTIFICACIONES
//BUSCAR CON BUSCADOR DE TEXTO
$(buscar_datos());
function buscar_datos(consulta){
    $.ajax({
        url:'assets/components/registro-anio-sabatico.php',
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
//ERROR A LA  VISTA
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
        url:'assets/components/registro-anio-sabatico.php',
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

