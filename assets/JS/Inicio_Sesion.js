function verificarUsuario(usuario,contrasena) {

    cadena="correo_electronico=" + usuario +
        "&contrasena=" + contrasena ;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Usuarios/Verificar_Usuario.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                alert("Hola");

                window.location.href="inicio.html";

            }else{

                alert("Usuario/Contrasena invalido, intente nuevamente...");
            }
        }
    });
}