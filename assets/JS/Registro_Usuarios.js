

function agregardatos(nombre_usuario,apellido,email,v_contrasena,rol){

    cadena="nombre=" + nombre +
        "&apellido=" + apellido +
        "&email=" + email+
        "&contrasena=" + v_contrasena +
        "&rol=" + rol;


    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Usuarios/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#usuarios').load('assets/components/registro-usuarios.php');
                alertify.success("agregado con exito");

            }else{
                alertify.error("fallo el servidor");
            }
        }
    });
}

function agregaform(datos) {

    d=datos.split('||');

    $('#id_usuario_editar').val(d[0]);
    $('#nombre_usuario_editar').val(d[1]);
    $('#apellido_usuario_editar').val(d[2]);
    $('#email_editar').val(d[3]);
    $('#v_contrasena_editar').val(d[4]);
    $('#rol_editar').val(d[5]);

}

function actualizaDatos(){

    id_usuario=$('#id_usuario_editar').val();
    var rol_sel = document.getElementById("rol_agregar");
    var rol_valor = rol_sel.options[rol_sel.selectedIndex].value;


    nombre_usuario =  $('#nombre_usuario_agregar').val();
    console.log(nombre_usuario);
    apellido= $('#apellido_usuario_agregar').val();
    console.log(apellido);
    email= $('#email_agregar').val();
    console.log(email);
    contra = $('#contrasena_agregar').val();
    v_contrasena= parseInt($('#v_contrasena_agregar').val());
    console.log(contrasena);
    rol = rol_valor;


    cadena="id_usuario=" + id_usuario +
        "&nombre=" + nombre +
        "&apellido=" + apellido +
        "&email=" + email+
        "&contrasena=" + v_contrasena +
        "&rol=" + rol;
    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Usuarios/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#usuarios').load('assets/components/registro-usuarios.php');
                alertify.success("Actualizado con exito");

            }else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}

function preguntarSiNo(id_usuario) {
    alertify.confirm('Eliminar Registro', '¿Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_usuario) }
        , function(){ alertify.error('Se cancelo.')});

}

function eliminarDatos(id_usuario) {
    cadena="id_usuario=" + id_usuario;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Usuarios/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#usuarios').load('assets/components/registro-usuarios.php');
                alertify.success("Eliminado con exito");
            }else{
                alertify.error("Fallo el servidor");
            }
        }

    });


}

