
function agregarDatos(programa,porcentaje) {

    cadena="programa=" + programa +
           "&porcentaje=" + porcentaje;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Permanencia/Agregar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-permanencia').load('assets/components/registro-permanencia.php');
                alertify.success("Agregado con exito");
            }else{
                alertify.error("Fallo el servidor");
            }
        }
    });
}

function agregaform(datos) {

    d=datos.split('||');

    $('#id_permanencia').val(d[0]);
    $('#nombre_programa_editar').val(d[1]);
    $('#porcentaje_editar').val(d[2]);

}