
 function agregarDatos(nombre_actividad,periodo) {

    cadena="nombre_actividad=" + nombre_actividad +
           "&periodo=" + periodo;

     $.ajax({
         type:"POST",
         url:"assets/components/PHP_Consultas/Registro_Coordinacion_Educativa/Agregar_Registro.php",
         data:cadena,
         success:function (r) {
             if(r==1){
                 $('#registro-coordinacion-educativa-y-tutorias').load('assets/components/registro-coordinacion-educativa-y-tutorias.php');
                 alertify.success("Agregado con exito");
             }else{
                 alertify.error("Fallo el servidor");
             }
         }
     });
 }

 function agregaform(datos) {

     d=datos.split('||');

     $('#id_coordinacion_educativa').val(d[0]);
     $('#nombre_actividad_editar').val(d[1]);
     $('#periodo_editar').val(d[2]);

 }

 function actualizaDatos() {

     id_actividad=$('#id_coordinacion_educativa').val();
     nombre_actividad=$('#nombre_actividad_editar').val();
     periodo=$('#periodo_editar').val();

     cadena="id_coordinacion_educativa=" + id_actividad +
         "&nombre_actividad=" + nombre_actividad +
         "&periodo=" + periodo;

     $.ajax({
         type:"POST",
         url:"assets/components/PHP_Consultas/Registro_Coordinacion_Educativa/Actualizar_Registro.php",
         data:cadena,
         success:function (r) {
             if(r==1){
                 $('#registro-coordinacion-educativa-y-tutorias').load('assets/components/registro-coordinacion-educativa-y-tutorias.php');
                 alertify.success("Actualizado con exito");
             }else{
                 alertify.error("Fallo el servidor");
             }
         }
     });
 }