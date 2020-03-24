
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