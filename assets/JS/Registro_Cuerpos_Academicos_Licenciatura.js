
function agregardatos(id_area_academica,nombre_cuerpo_academico,grado,estado,anio_registro,vigencia,area){

    cadena="id_area_academica=" + id_area_academica +
        "&nombre_cuerpo_academico=" + nombre_cuerpo_academico +
        "&grado=" + grado +
        "&estado=" + estado +
        "&anio_registro=" + anio_registro +
        "&vigencia=" + vigencia +
        "&area=" + area
        ;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Cuerpos_Academicos/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                //cuando se agrega un registro se recarga la tabla
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
    //llenar valores de la caja de texto
    $('#id_cuerpo_academico').val(d[0]);
    $("#area_academica_editar option:contains('"+d[1]+"')").attr('selected', true);
    $('#nombre_cuerpo_academico_editar').val(d[2]);
    $('#grado_editar').val(d[3]);
    $('#nombre_estado_editar').val(d[4]);
    $('#anio_registro_editar').val(d[5]);
    $('#anio_vigencia_editar').val(d[6]);
    $('#area_editar').val(d[7]);

}

function actualizaDatos() {

    id_cuerpo_academico=$('#id_cuerpo_academico').val();

    var area_sel = document.getElementById("area_academica_editar");
    var area_valor = area_sel.options[area_sel.selectedIndex].value;

    id_area_academica = parseInt( $('#area_academica_editar').val());
    


    nombre_cuerpo_academico_editar=$('#nombre_cuerpo_academico_editar').val();
    grado_editar=$('#grado_editar').val();
    nombre_estado_editar=$('#nombre_estado_editar').val();
    anio_registro_editar=$('#anio_registro_editar').val();
    anio_vigencia_editar=$('#anio_vigencia_editar').val();
    area_editar=$('#area_editar').val();

    cadena="id_cuerpo_academico=" + id_cuerpo_academico +
        "&id_area_academica=" + id_area_academica +
        "&nombre_cuerpo_academico=" + nombre_cuerpo_academico_editar +
        "&grado=" + grado_editar +
        "&estado=" + nombre_estado_editar +
        "&anio_registro=" + anio_registro_editar +
        "&vigencia=" + anio_vigencia_editar +
        "&area=" + area_editar
        ;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Cuerpos_Academicos/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                //cuando se agrega un registro se recarga la tabla
                $('#registro-cuerpos-academicos').load('assets/components/registro-cuerpos-academicos.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function preguntarSiNo(id_cuerpo_academico) {
    alertify.confirm('Eliminar Registro','Esta seguro de eliminar este registro?',
        function (){ eliminarDatos(id_cuerpo_academico)}
        , function () { alertify.error('Se cancelo')});

}

function eliminarDatos(id_cuerpo_academico) {
    cadena="id_cuerpo_academico=" + id_cuerpo_academico;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Cuerpos_Academicos/Eliminar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                //cuando se agrega un registro se recarga la tabla
                $('#registro-cuerpos-academicos').load('assets/components/registro-cuerpos-academicos.php');
                alertify.success("Eliminado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}
