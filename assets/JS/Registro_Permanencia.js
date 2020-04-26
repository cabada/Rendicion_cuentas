
function agregarDatos(programa,porcentaje) {

    cadena="permanencia=" + programa +
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
                alertify.error("No tiene los privilegios suficientes...");
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

function actualizaDatos() {
    id_permanencia=$('#id_permanencia').val();
    var carrera_sel = document.getElementById("nombre_programa_editar");
    var carrera_valor = carrera_sel.options[carrera_sel.selectedIndex].value;

    programa=carrera_valor;

    porcentaje=parseFloat($('#porcentaje_editar').val());

    cadena="id_permanencia=" + id_permanencia +
        "&programa=" + programa +
        "&porcentaje=" + porcentaje;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Permanencia/Actualizar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-permanencia').load('assets/components/registro-permanencia.php');
                alertify.success("Actualizado con exito");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

function preguntarSiNo(id_permanencia) {
    alertify.confirm('Eliminar Registro', '¿Esta seguro de eliminar este registro?',
             function () { eliminarDatos(id_permanencia)}
          ,function () { alertify.error('Se cancelo')});
}

function eliminarDatos(id_permanencia) {

    cadena="id_permanencia=" + id_permanencia;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Permanencia/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if (r == 1) {
                $('#registro-permanencia').load('assets/components/registro-permanencia.php');
                alertify.success("Eliminado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}