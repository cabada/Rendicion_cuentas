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
                $('#registro-equipo-maestros-itcj').load('assets/components/registro-equipo-apoyo-asesores.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("Fallo el servidor");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_editar').val(d[0]);
    $('#nombre_editar').val(d[1]);
    $('#categoria_editar').val(d[2]);
    $('#grado_estudios_editar').val(d[3]);
    $('#sni_editar').val(d[4]);
    $('#area_especializacion_editar').val(d[5]);
    $('#experiencia_profesional_editar').val(d[6]);
    $('#experiencia_docente_editar').val(d[7]);

}

function actualizarDatos() {
    id_equipo_ms=$('#id_editar').val();
    nombre_docente=$('#nombre_editar').val();
    categoria=$('#categoria_editar').val();
    grado_estudios=$('#grado_estudios_editar').val();
    sni=$('#sni_editar').val();
    area_especializacion=$('#area_especializacion_editar').val();
    experiencia_profesional=$('#experiencia_profesional_editar').val();
    experiencia_docente=$('#experiencia_docente_editar').val();

    cadena="id_equipo_ms=" + id_equipo_ms +
        "&nombre_docente=" + nombre_docente +
        "&categoria=" + categoria +
        "&grado_estudios=" + grado_estudios +
        "&sni=" + sni +
        "&area_especializacion=" + area_especializacion +
        "&experiencia_profesional=" + experiencia_profesional +
        "&experiencia_docente=" + experiencia_docente;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Equipo_Maestros_ITCJ/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-equipo-maestros-itcj').load('assets/components/registro-equipo-maestros-itcj.php');
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
function eliminarDatos(id_equipo_ms) {
    cadena= "id_equipo_ms=" + id_equipo_ms;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Equipo_Maestros_ITCJ/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-equipo-maestros-itcj').load('assets/components/registro-equipo-maestros-itcj.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("Fallo el servidor!");
            }
        }
    });
}
