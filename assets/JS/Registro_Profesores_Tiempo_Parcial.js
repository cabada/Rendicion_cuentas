function  agregarDatos(cantidad_tiempo_parcial,grado) {

    cadena="cantidad_tiempo_parcial=" + cantidad_tiempo_parcial +
        "&grado=" + grado;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Profesores_Tiempo_Parcial/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-tiempo-parcial-profesores').load('assets/components/registro-tiempo-parcial-profesores.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_registro_editar').val(d[0]);
    $('#cantidad_editar').val(d[1]);
    $('#grado_editar').val(d[2]);

}

function actualizarDatos() {
    id_prof_tmp_parc=$('#id_registro_editar').val();
    console.log(id_prof_tmp_parc);
    cantidad=parseInt($('#cantidad_editar').val());
    console.log(cantidad);
    grado= $('#grado_editar').val();
    console.log(grado);


    cadena="id_prof_tmp_parc="+id_prof_tmp_parc+
        "&cantidad_tiempo_parcial=" + cantidad +
        "&grado=" + grado;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Profesores_Tiempo_Parcial/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-tiempo-parcial-profesores').load('assets/components/registro-tiempo-parcial-profesores.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_prof_tmp_parc){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_prof_tmp_parc)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_prof_tmp_parc) {
    cadena= "id_prof_tmp_parc=" + id_prof_tmp_parc;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Profesores_Tiempo_Parcial/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-tiempo-parcial-profesores').load('assets/components/registro-tiempo-parcial-profesores.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}
