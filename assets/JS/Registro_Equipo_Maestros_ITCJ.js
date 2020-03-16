function agregarDatos(area_academica,nombre_cuerpo,grado,estado,anio_registro,vigencia,area) {

    cadena="area_academica=" + area_academica +
        "&nombre_cuerpo=" + nombre_cuerpo +
        "&grado=" + grado +
        "&estado=" + estado +
        "&anio_registro=" + anio_registro +
        "&vigencia=" + vigencia +
        "&area=" + area;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Cuerpos_Academicos_Posgrado/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cuerpos-academicos-posgrado').load('assets/components/registro-cuerpos-academicos-posgrado.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("Fallo el servidor");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_cuerpos_academicos_posgrado').val(d[0]);
    $('#area-academica-editar').val(d[1]);
    $('#nombre_cuerpo_academico_editar').val(d[2]);
    $('#grado_editar').val(d[3]);
    $('#nombre_estado_editar').val(d[4]);
    $('#anio_registro_editar').val(d[5]);
    $('#vigencia_editar').val(d[6]);
    $('#area_editar').val(d[7]);

}

function actualizarDatos() {
    id_cuerpos_academicos_posgrado=$('#id_cuerpos_academicos_posgrado').val();
    area_academica=$('#area-academica-editar').val();
    nombre_cuerpo=$('#nombre_cuerpo_academico_editar').val();
    grado=$('#grado_editar').val();
    estado=$('#nombre_estado_editar').val();
    anio_registro=$('#anio_registro_editar').val();
    vigencia=$('#vigencia_editar').val();
    area=$('#area_editar').val();

    cadena="id_cuerpos_academicos_posgrado=" + id_cuerpos_academicos_posgrado +
        "&area_academica=" + area_academica +
        "&nombre_cuerpo=" + nombre_cuerpo +
        "&grado=" + grado +
        "&estado=" + estado +
        "&anio_registro=" + anio_registro +
        "&vigencia=" + vigencia +
        "&area=" + area;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Cuerpos_Academicos_Posgrado/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cuerpos-academicos-posgrado').load('assets/components/registro-cuerpos-academicos-posgrado.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("Fallo el servidor");
            }
        }
    });

}

function preguntarSiNo(id_cuerpos_academicos_posgrado){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_cuerpos_academicos_posgrado)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_cuerpos_academicos_posgrado) {
    cadena= "id_cuerpos_academicos_posgrado=" + id_cuerpos_academicos_posgrado;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Cuerpos_Academicos_Posgrado/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-cuerpos-academicos-posgrado').load('assets/components/registro-cuerpos-academicos-posgrado.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("Fallo el servidor!");
            }
        }
    });
}
