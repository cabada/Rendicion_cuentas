
function agregardatos(clave,nombre_proyecto,responsable) {

    cadena="clave=" + clave +
           "&nombre_proyecto=" + nombre_proyecto +
           "&responsable=" + responsable;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Proyectos_Investigacion_Posgrado_Periodo/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-proyectos-investigacion-posgrado-periodo').load('assets/components/registro-proyectos-investigacion-posgrado-periodo.php');
                alertify.success("Agregado con exito");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {

    d=datos.split('||');

    $('#id_proyecto_inv_posgrado_periodo').val(d[0]);
    $('#clave_editar').val(d[1]);
    $('#nombre_proyecto_editar').val(d[2]);
    $('#responsable_editar').val(d[3]);

}

function actualizaDatos(){

    id_proyecto_inv_posgrado_periodo= $('#id_proyecto_inv_posgrado_periodo').val();
    clave=$('#clave_editar').val();
    nombre_proyecto=$('#nombre_proyecto_editar').val();
    responsable=$('#responsable_editar').val();

    cadena="id_proyecto_inv_posgrado_periodo=" + id_proyecto_inv_posgrado_periodo +
           "&clave=" + clave +
           "&nombre_proyecto=" + nombre_proyecto +
           "&responsable=" + responsable;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Proyectos_Investigacion_Posgrado_Periodo/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-proyectos-investigacion-posgrado-periodo').load('assets/components/registro-proyectos-investigacion-posgrado-periodo.php');
                alertify.success("Actualizado con exito");

            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function preguntarSiNo(id_proyecto_inv_posgrado_periodo) {
    alertify.confirm('Eliminar Registro', '¿Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_proyecto_inv_posgrado_periodo) }
        , function(){ alertify.error('Se cancelo.')});
}

function eliminarDatos(id_proyecto_inv_posgrado_periodo) {

    cadena="id_proyecto_inv_posgrado_periodo=" + id_proyecto_inv_posgrado_periodo;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Proyectos_Investigacion_Posgrado_Periodo/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-proyectos-investigacion-posgrado-periodo').load('assets/components/registro-proyectos-investigacion-posgrado-periodo.php');
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
        url:'assets/components/registro-proyectos-investigacion-posgrado-periodo.php',
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta},
    })
        .done(function(respuesta){
            $("#registro-proyectos-investigacion-posgrado-periodo").html(respuesta);
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
