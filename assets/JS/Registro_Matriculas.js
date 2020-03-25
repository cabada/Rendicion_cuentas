
function agregardatos(programa_educativo,cantidad_alumnos) {

    cadena="programa_educativo=" + programa_educativo +
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
                alertify.error("fallo el servidor");
            }
        }
    });
}

function agregaform(datos) {

    d=datos.split('||');

    $('#id_matricula').val(d[0]);
    $('#programa_educativo_editar').val(d[1]);
    $('#cantidad_alumnos_editar').val(d[2]);

}

function actualizaDatos() {

    id_matricula=$('#id_matricula').val();
    programa_educativo=$('#programa_educativo_editar').val();
    cantidad_alumnos=$('#cantidad_alumnos_editar').val();

    cadena="id_matricula=" + id_matricula +
        "&programa_educativo=" + programa_educativo +
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
                alertify.error("fallo el servidor");
            }
        }
    });

}