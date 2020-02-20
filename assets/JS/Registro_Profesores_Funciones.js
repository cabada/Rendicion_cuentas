function agregarDatos(nombre_completo,sexo,grado_estudios, horas_jornada,area_academica,
                      disciplina,vigencia,area_experiencia,fecha_ingreso) {
    cadena = "nombre_completo=" + nombre_completo +
        "&sexo=" + sexo +
        "&grado_estudios=" + grado_estudios +
        "&horas_jornada=" + horas_jornada +
        "&area_academica=" + area_academica +
        "&disciplina=" + disciplina +
        "&vigencia=" + vigencia +
        "&area_experiencia=" + area_experiencia +
        "&fecha_ingreso=" + fecha_ingreso;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Profesores/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-profesores').load('assets/components/registro-profesores.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}

//==============================================================================================

function agregaform(datos) {

    d=datos.split('||');

    $d[0];
    $('#nombre_editar').val(d[1]);
    $('#sexo_editar').val(d[2]);
    $('#grado_estudios_editar').val(d[3]);
    $('#numero_horas_jornada_editar').val(d[4]);
    $('#area_academica_editar').val(d[5]);
    $('#disciplina_editar').val(d[6]);
    $('#vigencia_editar').val(d[7]);
    $('#area_experiencia_editar').val(d[8]);
    $('#fecha_ingreso_editar').val(d[9]);



}

function actualizaDatos() {


    id_curso=$('#id_curso').val();
    nombre_curso=$('#nombre_curso_editar').val();
    periodo=$('#periodo_editar').val();
    horas_capacitacion=$('#horas_capacitacion_editar').val();
    numero_participantes_base=$('#numero_participantes_base_editar').val();
    numero_participantes_honorarios=$('#numero_participantes_honorarios_editar').val();

    cadena = "id_curso="+ id_curso +
        "&nombre_curso=" + nombre_curso +
        "&periodo=" + periodo +
        "&horas_capacitacion=" + horas_capacitacion +
        "&numero_participantes_base=" + numero_participantes_base +
        "&numero_participantes_honorarios=" + numero_participantes_honorarios;

    $.ajax({
        type:"post",
        url:"php/actualizaDatos.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#tablaRegistroCurso').load('componentes/TablaRegistroCurso.php');
                alertify.success("Actualizado con exito: ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });
}


function preguntarSiNo(id_curso) {

    alertify.confirm('Eliminar Registro', 'Esta seguro de eliminar este registro??',
        function(){ eliminarDatos(id_curso) }
        , function(){ alertify.error('Se cancelo.')});


}

function eliminarDatos(id_curso) {
    cadena = "id_curso="+id_curso ;

    $.ajax({
        type:"post",
        url:"php/eliminarDatos.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#tablaRegistroCurso').load('componentes/TablaRegistroCurso.php');
                alertify.success("Eliminado con exito!")
            }else{
                alertify.error("Fallo el servidor!")
            }


        }
    });

}