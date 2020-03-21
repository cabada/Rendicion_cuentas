function  agregarDatos(periodo,numero_docentes) {

    cadena="periodo=" + periodo +
        "&numero_docentes=" + numero_docentes;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_MOOCS/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cantidad-docentes-moocs').load('assets/components/registro-cantidad-docentes-moocs.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("Fallo el servidor");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_total_editar').val(d[0]);
    $('#grado_editar').val(d[1]);
    $('#cantidad_editar').val(d[2]);

}

function actualizarDatos() {
    id_prof_grad_acad_=parseInt($('#id_total_editar').val());
    console.log(id_prof_grad_acad_);
    grado= $('#grado_editar').val();
    console.log(grado);
    cantidad=parseInt($('#cantidad_editar').val());
    console.log(cantidad);


    cadena="id_prof_grado_acad="+id_prof_grad_acad_+
        "&grado=" + grado+
        "&cantidad=" + cantidad;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_MOOCS/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-cantidad-docentes-moocs').load('assets/components/registro-cantidad-docentes-moocs.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("Fallo el servidor");
            }
        }
    });

}

function preguntarSiNo(id_prof_grad_acad){

    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_prof_grad_acad)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminarDatos(id_prof_grad_acad) {
    cadena= "id_prof_grado_acad=" + id_prof_grad_acad;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_MOOCS/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-cantidad-docentes-moocs').load('assets/components/registro-cantidad-docentes-moocs.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("Fallo el servidor!");
            }
        }
    });
}
