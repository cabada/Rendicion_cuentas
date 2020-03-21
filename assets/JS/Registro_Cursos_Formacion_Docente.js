function  agregarDatos(nombre_curso,periodo,no_participantes,horas_capacitacion) {

    cadena="nombre_curso=" + nombre_curso +
        "&periodo=" + periodo+
        "&num_participantes=" + no_participantes+
        "&horas_capacitacion=" + horas_capacitacion;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Cursos_Formacion_Docente/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cursos-formacion-docente').load('assets/components/registro-cursos-formacion-docente.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("Fallo el servidor");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_curso_editar').val(d[0]);
    $('#nombre_curso_editar').val(d[1]);
    $('#periodo_editar').val(d[2]);
    $('#no_participantes_editar').val(d[3]);
    $('#no_capacitacion_editar').val(d[4]);

}

function actualizarDatos() {
    id_curso=parseInt($('#id_curso_editar').val());
    console.log(id_curso);
    nombre_curso= $('#nombre_curso_editar').val();
    periodo=$('#periodo_editar').val();
    no_participantes=parseInt($('#no_participantes_editar').val());
    no_capacitacion=parseInt($('#no_capacitacion_editar').val());
    console.log(nombre_curso);
    console.log(periodo);
    console.log(no_participantes);
    console.log(no_capacitacion);


    cadena="id_curso=" + id_curso+
        "&nombre_curso=" + nombre_curso +
        "&periodo=" + periodo+
        "&num_participantes=" + no_participantes+
        "&horas_capacitacion=" + no_capacitacion;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Cursos_Formacion_Docente/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cursos-formacion-docente').load('assets/components/registro-cursos-formacion-docente.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("Fallo el servidor");
            }
        }
    });

}

function preguntarSiNo(id_curso){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_curso)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_curso) {
    cadena= "id_curso=" + id_curso;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Cursos_Formacion_Docente/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-cursos-formacion-docente').load('assets/components/registro-cursos-formacion-docente.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("Fallo el servidor!");
            }
        }
    });
}
