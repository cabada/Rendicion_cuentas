function agregarDatos(carrera,modalidad,nuevo_ingreso, reingreso,status,
                      periodo) {
    cadena = "carrera=" + carrera +
        "&modalidad=" + modalidad +
        "&nuevo_ingreso=" + nuevo_ingreso +
        "&reingreso=" + reingreso +
        "&status=" + status +
        "&periodo=" + periodo;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Programa_Educativo/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-programa-educativo').load('assets/components/registro-programa-educativo.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}
