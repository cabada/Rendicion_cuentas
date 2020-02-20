function agregarDatos(nombre_completo,sexo,grado_estudios, horas_jornada,area_academica,
                      disciplina,vigencia,area_experiencia,fecha_ingreso) {
    cadena = "nombre_completo=" + nombre_completo +
        "&sexo=" + sexo +
        "&grado_estudios=" + grado_estudios +
        "&horas_jornada=" + horas_jornada +
        "&area_academica=" + area_academica +
        "&disciplina=" + disciplina +
        "&vigencia=" + vigencia +
        "&area_experiencia=" + area_experiencia +
        "&fecha_ingreso=" + fecha_ingreso;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Profesores/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-profesores').load('../components/registro-profesores.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}