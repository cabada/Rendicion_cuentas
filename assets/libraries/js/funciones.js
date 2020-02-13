

function agregardatos(modalidad_agregar,inreso_agregar,reingreso_agregar,estatus_agregar,periodo_agregar){

    cadena="modalidad_agregar=" + modalidad_agregar +
           "&inreso_agregar="  + inreso_agregar +
           "&reingreso_agregar=" + reingreso_agregar +
           "&estatus_agregar=" + estatus_agregar +
           "&periodo_agregar=" + periodo_agregar;

    $.ajax({
        type:"POST",
        url:"php/agregarDatos.php",
        data:cadena,
        success:function(r){
           if (r==1){
               $('#registro-programa-educativo').load('assets/components/registro-programa-educativo.php');
               alertify.success("Agregado con exito :)");
           } else {
               alertify.error("Fallo el servidor :(");
           }
        }
});

}