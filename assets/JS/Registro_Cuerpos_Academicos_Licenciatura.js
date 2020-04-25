
function agregarDatos(id_area_academica,nombre_cuerpo_academico,grado,estado,anio_registro,vigencia,area) {

    cadena= "id_area_academica=" + id_area_academica +
            "&nombre_cuerpo_academico=" + nombre_cuerpo_academico +
            "&grado=" + grado +
            "&estado=" + estado +
            "&anio_registro=" + anio_registro +
            "&vigencia=" + vigencia +
            "&area=" + area;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Area_Academica_Licenciatura/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cuerpos-academicos').load('assets/components/registro-cuerpos-academicos.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function agregaform(datos) {

    d=datos.split('||');
    $('option:selected', 'select[area_academica_editar="options"]').removeAttr('selected');


    $('#id_cuerpo_academico').val(d[0]);
    $("#area_academica_editar option:contains('"+d[1]+"')").attr('selected', true);
    $('#nombre_cuerpo_academico_editar').val(d[2]);
    $('#grado_editar').val(d[3]);
    $('#nombre_estado_editar').val(d[4]);
    $('#anio_registro_editar').val(d[5]);
    $('#anio_vigencia_editar').val(d[6]);
    $('#area_editar').val(d[7]);
}

function actualizarDatos() {


    id_cuerpo_academico=$('#id_cuerpo_academico').val();
    id_area_academica=$('#area_academica_editar').val();
    nombre_cuerpo_academico=$('#nombre_cuerpo_academico_editar').val();
    grado=$('#grado_editar').val();
    estado=$('#nombre_estado_editar').val();
    anio_registro=$('#anio_registro_editar').val();
    vigencia=$('#anio_vigencia_editar').val();
    area=$('#area_editar').val();

    cadena="id_cuerpo_academico=" + id_cuerpo_academico +
        "&id_area_academica=" + id_area_academica +
        "&nombre_cuerpo_academico=" + nombre_cuerpo_academico +
        "&grado=" + grado +
        "&estado=" + estado +
        "&anio_registro=" + anio_registro +
        "&vigencia=" + vigencia +
        "&area=" + area;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Area_Academica_Licenciatura/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cuerpos-academicos').load('assets/components/registro-cuerpos-academicos.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_cuerpo_academico){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_cuerpo_academico)}
        , function(){ alertify.error('Se cancelo')});
}

function eliminarDatos(id_cuerpo_academico) {
    cadena= "id_cuerpo_academico=" + id_cuerpo_academico;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Area_Academica_Licenciatura/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-cuerpos-academicos').load('assets/components/registro-cuerpos-academicos.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}