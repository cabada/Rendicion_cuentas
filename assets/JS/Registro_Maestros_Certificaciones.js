function agregarDatos(nombre_completo,area_academica,
                      disciplina) {
    cadena = "nombre_completo=" + nombre_completo +
        "&area_academica=" + area_academica +
        "&disciplina=" + disciplina;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Maestros_Certificaciones/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-listado-maestros-certificaciones').load('assets/components/registro-listado-maestros-certificaciones.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

//==============================================================================================

function agregaform(datos) {

    d=datos.split('||');

    $('#id_profesor').val(d[0]);
    $('#nombre_editar').val(d[1]);
    $('#area_academica_editar').val(d[2]);
    $('#disciplina_editar').val(d[3]);




}

function actualizaDatos() {


    id_profesor=$('#id_profesor').val();

    var area_sel = document.getElementById("area_academica_editar");
    var area_valor = area_sel.options[area_sel.selectedIndex].value;


    nombre_completo = $('#nombre_editar').val();
    area_academica = parseInt( $('#area_academica_editar').val());
    console.log(area_academica);
    disciplina = $('#disciplina_editar').val();
    console.log(disciplina);


    cadena = "id_profesor="+ id_profesor +
        "&nombre_completo=" + nombre_completo +
        "&area_academica=" + area_academica +
        "&disciplina=" + disciplina;



    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Maestros_Certificaciones/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-listado-maestros-certificaciones').load('assets/components/registro-listado-maestros-certificaciones.php');
                alertify.success("Actualizado con exito: ");
            }
            else{
                alertify.error("No tiene los privilegios suficientes...");
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
        url:"assets/components/PHP_Consultas/Registro_Maestros_Certificaciones/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-listado-maestros-certificaciones').load('assets/components/registro-listado-maestros-certificaciones.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }

        }
    });

}