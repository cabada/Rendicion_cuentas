function verificarUsuario(usuario,contrasena) {

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
                alertify.error("Fallo el servidor");
            }
        }
    });
}