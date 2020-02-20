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

    $('#id_profesor').val(d[0]);
    $('#nombre_editar').val(d[1]);
    $('#sexo_editar').val(d[2]);
    $('#grado_estudios_editar').val(d[3]);
    $('#horas_jornada_editar').val(d[4]);
    $('#area_academica_editar').val(d[5]);
    $('#disciplina_editar').val(d[6]);
    $('#anio_vigencia_editar').val(d[7]);
    $('#area_experiencia_editar').val(d[8]);
    $('#fecha_ingreso_editar').val(d[9]);



}

function actualizaDatos() {


    id_profesor=$('#id_profesor').val();

    var sexo_sel = document.getElementById("sexo_editar");
    var sexo_valor = sexo_sel.options[sexo_sel.selectedIndex].text;

    var grado_sel = document.getElementById("grado_estudios_editar");
    var grado_valor = grado_sel.options[grado_sel.selectedIndex].text;

    var area_sel = document.getElementById("area_academica_editar");
    var area_valor = grado_sel.options[area_sel.selectedIndex].value;

    var disc_sel = document.getElementById("disciplina_editar");
    var disc_valor = disc_sel.options[disc_sel.selectedIndex].value;



    nombre_completo = $('#nombre_editar').val();
    console.log(nombre_completo);
    sexo = sexo_valor;
    console.log(sexo);
    grado_estudios = grado_valor;
    console.log(grado_estudios);
    horas_jornada = $('#horas_jornada_editar').val();
    console.log(horas_jornada);
    area_academica = parseInt( $('#area_academica_editar').val());
    console.log(area_academica);
    disciplina = parseInt(disc_valor);
    console.log(disciplina);
    vigencia = $('#anio_vigencia_editar').val();
    console.log(vigencia);
    area_experiencia = $('#area_experiencia_editar').val();
    console.log(area_experiencia);
    fecha_ingreso = $('#fecha_ingreso_editar').val();

    cadena = "id_profesor="+ id_profesor +
        "&nombre_completo=" + nombre_completo +
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
        url:"assets/components/PHP_Consultas/Registro_Profesores/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-profesores').load('assets/components/registro-profesores.php');
                alertify.success("Actualizado con exito: ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });
}


function preguntarSiNo(id_profesor) {

    alertify.confirm('Eliminar Registro', 'Esta seguro de eliminar este registro??',
        function(){ eliminarDatos(id_profesor) }
        , function(){ alertify.error('Se cancelo.')});


}

function eliminarDatos(id_profesor) {
    cadena = "id_profesor="+id_profesor ;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Profesores/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-profesores').load('assets/components/registro-profesores.php');
                alertify.success("Eliminado con exito!")
            }else{
                alertify.error("Fallo el servidor!")
            }


        }
    });

}