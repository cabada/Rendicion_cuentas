function  agregarDatos(grado,cantidad) {

    cadena="grado=" + grado +
        "&cantidad=" + cantidad;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Total_Profesores_GA/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-total-profesores').load('assets/components/registro-total-profesores.php');
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
        url: "assets/components/PHP_Consultas/Registro_Total_Profesores_GA/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-total-profesores').load('assets/components/registro-total-profesores.php');
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
        url:"assets/components/PHP_Consultas/Registro_Total_Profesores_GA/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-total-profesores').load('assets/components/registro-total-profesores.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("Fallo el servidor!");
            }
        }
    });
}
