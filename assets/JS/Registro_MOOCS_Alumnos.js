function  agregarDatos(nombre_curso,numero_alumnos) {

    cadena="cursos_mooc=" + nombre_curso +
        "&numero_alumnos_inscritos=" + numero_alumnos;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_MOOCS_Alumnos/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cantidad-alumnos-moocs').load('assets/components/registro-cantidad-alumnos-moocs.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_moocs_alm_editar').val(d[0]);
    $('#nombre_curso_editar').val(d[1]);
    $('#cantidad_alumnos_editar').val(d[2]);

}

function actualizarDatos() {
    id_moocs_alumnos=parseInt($('#id_moocs_alm_editar').val());
    console.log(id_moocs_alumnos);
    nombre_curso= $('#nombre_curso_editar').val();
    console.log(nombre_curso);
    numero_alumnos=parseInt($('#cantidad_alumnos_editar').val());
    console.log(numero_alumnos);


    cadena="id_moocs_alumnos="+id_moocs_alumnos+
        "&cursos_mooc=" + nombre_curso+
        "&numero_alumnos_inscritos=" + numero_alumnos;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_MOOCS_Alumnos/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cantidad-alumnos-moocs').load('assets/components/registro-cantidad-alumnos-moocs.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_moocs_alm){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_moocs_alm)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_moocs_alm) {
    cadena= "id_moocs_alumnos=" + id_moocs_alm;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_MOOCS_Alumnos/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-cantidad-alumnos-moocs').load('assets/components/registro-cantidad-alumnos-moocs.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}
