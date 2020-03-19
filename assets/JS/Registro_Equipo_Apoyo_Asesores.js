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
                alertify.error("Fallo el servidor");
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
    nombre=$('#nombre_editar').val();
    puesto=$('#puesto_editar').val();
    grado_estudios=$('#grado_estudios_editar').val();
    funciones=$('#funciones_tecnm_editar').val();


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
                $('#registro-equipo-maestros-itcj').load('assets/components/registro-equipo-apoyo-asesores.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("Fallo el servidor");
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
                alertify.error("Fallo el servidor!");
            }
        }
    });
}
