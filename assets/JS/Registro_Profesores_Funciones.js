function agregarDatos(nombre_curso,periodo,horas_capacitacion,numero_participantes_base,
                      numero_participantes_honorarios) {
    cadena = "nombre_curso=" + nombre_curso +
        "&periodo=" + periodo +
        "&horas_capacitacion=" + horas_capacitacion +
        "&numero_participantes_base=" + numero_participantes_base +
        "&numero_participantes_honorarios=" + numero_participantes_honorarios;

    $.ajax({
        type:"post",
        url:"php/agregarDatos.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#tablaRegistroCurso').load('componentes/TablaRegistroCurso.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}