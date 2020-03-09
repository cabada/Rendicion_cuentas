function agregarDatos(nombre_proyecto,cantidad_alumnos,id_carrera,anio,fecha_inicio,fecha_termino) {

    cadena="nombre=" + nombre_proyecto +
           "&cantidad_alumnos=" + cantidad_alumnos +
           "&id_carrera=" + id_carrera +
           "&annio=" + anio +
           "&fecha_inicio=" + fecha_inicio +
           "&fecha_termino=" + fecha_termino;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Programa_Delfin/Agregar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-programa-delfin').load('assets/components/registro-programa-delfin.php');
                alertify.success("Agregado con exito");
            }else {
                alertify.error("Fallo el servidor");
            }

        }
    })


}