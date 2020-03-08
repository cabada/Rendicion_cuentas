function agregarDatos(grado,mujer,hombre,total,porcentaje) {
    cadena = "grado=" + grado +
        "&mujer=" + mujer +
        "&hombre=" + hombre +
        "&total=" + total +
        "&porcentaje=" + porcentaje;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Profesores_Tiempo_Completo_Grado_Academico/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-profesores').load('assets/components/registro-profesores-tiempo-completo-grado-academico.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}