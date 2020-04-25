function agregarDatos(nombre_proyecto, cantidad_alumnos, id_carrera, anio, fecha_inicio, fecha_termino) {

    cadena = "nombre_proyecto=" + nombre_proyecto +
        "&cantidad_alumnos=" + cantidad_alumnos +
        "&id_carrera=" + id_carrera +
        "&anio=" + anio +
        "&fecha_inicio=" + fecha_inicio +
        "&fecha_termino=" + fecha_termino;
    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Programa_Delfin/Agregar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-programa-delfin').load('assets/components/registro-programa-delfin.php');
                alertify.success("Agregado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }

        }
    });

}
function agregaform(datos) {

    d = datos.split('||');

    $('#id_programa').val(d[0]);
    $('#nombre_proyecto_editar').val(d[1]);
    $('#cantidad_alumnos_editar').val(d[2]);
    $('#carrera_editar').val(d[3]);
    $('#anio_editar').val(d[4]);
    $('#fecha_inicio_editar').val(d[5]);
    $('#fecha_inicio_editar').val(d[6]);

}

function actualizarDatos() {
    id_programa = $('#id_programa').val();
    nombre_proyecto = $('#nombre_proyecto_editar').val();
    cantidad_alumnos = $('#cantidad_alumnos_editar').val();
    console.log(cantidad_alumnos);

    var carrera_sel = document.getElementById("carrera_editar");
    var carrera_valor = carrera_sel.options[carrera_sel.selectedIndex].value;
    id_carrera = carrera_valor;
    console.log(id_carrera);
    anio = $('#anio_editar').val();
    console.log(anio);
    fecha_inicio = $('#fecha_inicio_editar').val();
    console.log(fecha_inicio);
    fecha_termino = $('#fecha_inicio_editar').val();
    console.log(fecha_termino);

    cadena = "id_programa=" + id_programa +
        "&nombre_proyecto=" + nombre_proyecto +
        "&cantidad_alumnos=" + cantidad_alumnos +
        "&id_carrera=" + id_carrera +
        "&anio=" + anio +
        "&fecha_inicio=" + fecha_inicio +
        "&fecha_termino=" + fecha_termino;

    $.ajax({
        type: "POST",
        url: "assets/components/PHP_Consultas/Registro_Programa_Delfin/Actualizar_Registro.php",
        data: cadena,
        success: function (r) {
            if (r == 1) {
                $('#registro-programa-delfin').load('assets/components/registro-programa-delfin.php');
                alertify.success("Actualizado con exito");
            } else {
                alertify.error("No tiene los privilegios suficientes...");
            }
        },
        error: function (error) {

        }
    });

}

function preguntarSiNo(id_programa) {
    alertify.confirm('Eliminar Datos','Esta seguro de eliminar este registro?',
        function () { eliminarDatos(id_programa)}
        , function () { alertify.error('Se cancelo')});

}

function eliminarDatos(id_programa) {
    cadena="id_programa=" + id_programa;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Programa_Delfin/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-programa-delfin').load('assets/components/registro-programa-delfin.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}