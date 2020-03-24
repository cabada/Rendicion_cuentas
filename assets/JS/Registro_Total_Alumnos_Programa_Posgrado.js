
function agregardatos(programa,cantidad,porcentaje,registrado_en) {

    cadena="programa=" + programa +
        "&cantidad=" + cantidad +
        "&porcentaje=" + porcentaje +
        "&registrado_en=" + registrado_en;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Total_Alumnos_Programa_Posgrado/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-total-alumnos-programa-posgrado').load('assets/components/registro-total-alumnos-programa-posgrado.php');
                alertify.success("agregado con exito");

            }else{
                alertify.error("fallo el servidor");
            }
        }
    });
}

function agregaform(datos) {
    d=datos.split('||');

    $('#id_total_prog_posgrado').val(d[0]);
    $('#nombre_curso_editar').val(d[1]);
    $('#cantidad_editar').val(d[2]);
    $('#porcentaje_editar').val(d[3]);
    $('#registro_editar').val(d[4]);

}

function actualizaDatos(){

    id_total_prog_posgrado=$('#id_total_prog_posgrado').val();
    programa=$('#nombre_curso_editar').val();
    cantidad=$('#cantidad_editar').val();
    porcentaje=$('#porcentaje_editar').val();
    registrado_en=$('#registro_editar').val();

    cadena="id_total_prog_posgrado=" + id_total_prog_posgrado +
        "&programa=" + programa +
        "&cantidad=" + cantidad +
        "&porcentaje=" + porcentaje +
        "&registrado_en=" + registrado_en;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Total_Alumnos_Programa_Posgrado/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-total-alumnos-programa-posgrado').load('assets/components/registro-total-alumnos-programa-posgrado.php');
                alertify.success("Actualizado con exito");

            }else{
                alertify.error("fallo el servidor");
            }
        }
    });
}