function verificarUsuario(usuario,contrasena) {

    cadena="correo_electronico=" + usuario +
        "&contrasena=" + contrasena ;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Usuarios/Verificar_Usuario.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                alert("Existe Usuario...");
            }else{
                alert("Fallo al intentar iniciar sesion...");
            }
        }
    });
}