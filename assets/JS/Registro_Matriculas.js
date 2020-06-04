
function agregardatos(id_carrera,cantidad_alumnos) {

    cadena="id_carrera=" + id_carrera +
           "&cantidad_alumnos=" + cantidad_alumnos;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Matriculas/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-cantidad-matriculas').load('assets/components/registro-cantidad-matriculas.php');
                alertify.success("Agregado con exito");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {

    d=datos.split('||');
    console.log(d[1]);
    $('option:selected', 'select[programa_educativo_editar="options"]').removeAttr('selected');


    $('#id_matricula').val(d[0]);
    $("#programa_educativo_editar option:contains('"+d[1]+"')").attr('selected', true);
    $('#cantidad_alumnos_editar').val(d[2]);

}

function actualizaDatos(){

    id_matricula=$('#id_matricula').val();
    id_carrera=$('#programa_educativo_editar').val();
    cantidad_alumnos=$('#cantidad_alumnos_editar').val();

    cadena="id_matricula=" + id_matricula +
        "&id_carrera=" + id_carrera +
        "&cantidad_alumnos=" + cantidad_alumnos;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Matriculas/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-cantidad-matriculas').load('assets/components/registro-cantidad-matriculas.php');
                alertify.success("Actualizado con exito");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function preguntarSiNo(id_matricula) {
    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminardatos(id_matricula)}
        , function(){ alertify.error('Se cancelo')});
}

function eliminardatos(id_matricula){

    cadena="id_matricula=" + id_matricula;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Matriculas/Eliminar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-cantidad-matriculas').load('assets/components/registro-cantidad-matriculas.php');
                alertify.success("Eliminado con exito");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

// FUNCION PARA BUSCAR DATOS DE TABLA PROGRAMA EDUCATIVO
$(buscar_datos());
function buscar_datos(consulta){
    $.ajax({
        url:'assets/components/registro-cantidad-matriculas.php',
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta},
    })
        .done(function(respuesta){
            $("#registro-cantidad-matriculas").html(respuesta);
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
