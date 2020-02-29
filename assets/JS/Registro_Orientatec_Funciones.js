function agregarDatos(nombre_preparatoria,fecha,estudiantes_atendidos) {

    cadena="nombre_preparatoria=" + nombre_preparatoria +
           "&fecha=" + fecha +
           "&estudiantes_atendidos=" + estudiantes_atendidos;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Orientatec/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-orientatec').load('assets/components/registro-orientatec.php');
                alertify.success("Agregado con exito");
            }else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}

function agregaForm(datos) {

    d=datos.split('||');

    $('#id_orientatec').val(d[0]);
    $('#nombre_preparatoria_editar').val(d[1]);
    $('#fecha_editar').val(d[2]);
    $('#estudiantes_atendidos_editar').val(d[3]);

}

function actualizaDatos() {

    id_orientatec=$('#id_orientatec').val();

    nombre_preparatoria=$('#nombre_preparatoria_editar').val();
    console.log(nombre_preparatoria);

    fecha=$('#fecha_editar').val();
    console.log(fecha);

    estudiantes_atendidos=$('#estudiantes_atendidos_editar').val();
    console.log(estudiantes_atendidos);

    cadena="id_orientatec=" + id_orientatec +
        "&nombre_preparatoria=" + nombre_preparatoria +
        "&fecha=" + fecha +
        "&estudiantes_atendidos=" + estudiantes_atendidos;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Orientatec/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-orientatec').load('assets/components/registro-orientatec.php');
                alertify.success("Actualizado con exito");
            }else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}

function preguntarSiNo() {
    alertify.confirm('Eliminar Registro', '¿Esta seguro de eliminar este registro?',
        function(){ alertify.success('Ok')}
        , function(){ alertify.error('Se cancelo.')});

}

function eliminarDatos(id_orientatec) {
      cadena="id_orientatec=" + id_orientatec;

      $.ajax({
         type:"POST",
         url:"assets/components/PHP_Consultas/Registro_Orientatec/Eliminar_Registro.php",
         data:cadena,
         success:function (r) {
             if(r==1){
                 $('#registro-orientatec').load('assets/components/registro-orientatec.php');
                 alertify.success("Eliminado con exito");
             }else{
                 alertify.error("Fallo el servidor");
             }
         }
      });
}