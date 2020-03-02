

function agregardatos(tutores_registrados, alumnos_tuto_grupal,encuentro_padres,conferencias_alumnos,
                      alumnos_asistieron_conferencias){

    cadena="tutores_registrados=" + tutores_registrados +
        "&alumnos_tuto_grupal=" + alumnos_tuto_grupal +
        "&encuentro_padres=" + encuentro_padres +
        "&conferencias_alumnos=" + conferencias_alumnos +
        "&alumnos_asistieron_conferencias=" + alumnos_asistieron_conferencias;


          $.ajax({
              type:"POST",
              url:"assets/components/PHP_Consultas/Registro_Tutorias/Agregar_Registro.php",
              data:cadena,
              success:function(r) {
                  if(r==1){
                      $('#registro-tutorias').load('assets/components/registro-tutorias.php');
                      alertify.success("agregado con exito");

                  }else{
                      alertify.error("fallo el servidor");
                  }
              }
          });
}

function agregaform(datos) {

    d=datos.split('||');

    $('#id_tutorias').val(d[0]);
    $('#tutores_registrados_editar').val(d[1]);
    $('#cantidad_alumnos_grupal_editar').val(d[2]);
    $('#cantidad_encuentro_padres_editar').val(d[3]);
    $('#cantidad_conferencia_alumnos_editar').val(d[4]);
    $('#cantidad_alumnos_conferencia_editar').val(d[5]);
    
}

function actualizaDatos(){

    id_tutorias=$('#id_tutorias').val();
    tutores_registrados=$('#tutores_registrados_editar').val();
    alumnos_tuto_grupal=$('#cantidad_alumnos_grupal_editar').val();
    encuentro_padres=$('#cantidad_encuentro_padres_editar').val();
    conferencias_alumnos=$('#cantidad_conferencia_alumnos_editar').val();
    alumnos_asistieron_conferencias=$('#cantidad_alumnos_conferencia_editar').val();

    cadena="id_tutorias=" + id_tutorias +
        "&tutores_registrados=" + tutores_registrados +
        "&alumnos_tuto_grupal=" + alumnos_tuto_grupal +
        "&encuentro_padres=" + encuentro_padres +
        "&conferencias_alumnos=" + conferencias_alumnos +
        "&alumnos_asistieron_conferencias=" + alumnos_asistieron_conferencias;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Tutorias/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-tutorias').load('assets/components/registro-tutorias.php');
                alertify.success("Actualizado con exito");

            }else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}

function preguntarSiNo(id_tutorias) {
    alertify.confirm('Eliminar Registro', '¿Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_tutorias) }
        , function(){ alertify.error('Se cancelo.')});

}

function eliminarDatos(id_tutorias) {
    cadena="id_tutorias=" + id_tutorias;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Tutorias/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-tutorias').load('assets/components/registro-tutorias.php');
                alertify.success("Eliminado con exito");
            }else{
                alertify.error("Fallo el servidor");
            }
        }

    });


}

