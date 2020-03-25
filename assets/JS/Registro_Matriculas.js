
function agregardatos(programa_educativo,cantidad_alumnos) {

    cadena="programa_educativo=" + programa_educativo +
           "&cantidad_alumnos=" + cantidad_alumnos;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Matriculas/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-cantidad-matriculas').load('assets/components/registro-cantidad-matriculas.php');
                alertify.success("Agregado con exito");
            }else{
                alertify.error("fallo el servidor");
            }
        }
    });
}