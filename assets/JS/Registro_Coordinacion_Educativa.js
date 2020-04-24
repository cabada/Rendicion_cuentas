
 function agregarDatos(nombre_actividad,periodo_ene_jun,periodo_ago_dic) {

    cadena="nombre_actividad=" + nombre_actividad +
           "&periodo_ene_jun=" + periodo_ene_jun +
           "&periodo_ago_dic=" + periodo_ago_dic;

     $.ajax({
         type:"POST",
         url:"assets/components/PHP_Consultas/Registro_Coordinacion_Educativa/Agregar_Registro.php",
         data:cadena,
         success:function (r) {
             if(r==1){
                 $('#registro-coordinacion-educativa-y-tutorias').load('assets/components/registro-coordinacion-educativa-y-tutorias.php');
                 alertify.success("Agregado con exito");
             }else{
                 alertify.error("No tiene los privilegios suficientes...");
             }
         }
     });
 }

 function agregaform(datos) {

     d=datos.split('||');

     $('#id_coordinacion_educativa').val(d[0]);
     $('#nombre_actividad_editar').val(d[1]);
     $('#periodoej_editar').val(d[2]);
     $('#periodoad_editar').val(d[3]);
 }

 function actualizaDatos() {

     id_actividad=$('#id_coordinacion_educativa').val();
     nombre_actividad=$('#nombre_actividad_editar').val();
     periodo_ene_jun=$('#periodoej_editar').val();
     periodo_ago_dic=$('#periodoad_editar').val();

     cadena="id_coordinacion_educativa=" + id_actividad +
         "&nombre_actividad=" + nombre_actividad +
         "&periodo_ene_jun=" + periodo_ene_jun +
         "&periodo_ago_dic=" + periodo_ago_dic;

     $.ajax({
         type:"POST",
         url:"assets/components/PHP_Consultas/Registro_Coordinacion_Educativa/Actualizar_Registro.php",
         data:cadena,
         success:function (r) {
             if(r==1){
                 $('#registro-coordinacion-educativa-y-tutorias').load('assets/components/registro-coordinacion-educativa-y-tutorias.php');
                 alertify.success("Actualizado con exito");
             }else{
                 alertify.error("No tiene los privilegios suficientes...");
             }
         }
     });
 }
 
 function preguntarSiNo(id_actividad) {
    alertify.confirm('Eliminar Registro','Esta seguro de eliminar este registro?',
                     function (){ eliminarDatos(id_actividad)}
                  , function () { alertify.error('Se cancelo')});
 }
 
 function eliminarDatos(id_actividad) {
     cadena="id_coordinacion_educativa=" + id_actividad;

     $.ajax({
         type:"POST",
         url:"assets/components/PHP_Consultas/Registro_Coordinacion_Educativa/Eliminar_Registro.php",
         data:cadena,
         success:function (r) {
             if(r==1){
                 $('#registro-coordinacion-educativa-y-tutorias').load('assets/components/registro-coordinacion-educativa-y-tutorias.php');
                 alertify.success("Eliminado con exito");
             }else{
                 alertify.error("No tiene los privilegios suficientes...");
             }
         }
     });
 }
 
 
 
 
 
 
 