

function agregarDatos(nombre_usuario,apellido,email,v_contrasena,rol){

    cadena="nombre=" + nombre_usuario +
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

    $('option:selected', 'select[rol_editar="options"]').removeAttr('selected');

    $('#id_usuario_editar').val(d[0]);
    $('#nombre_usuario_editar').val(d[1]);
    $('#apellido_usuario_editar').val(d[2]);
    $('#email_editar').val(d[3]);
    $("#rol_editar option:contains('"+d[4]+"')").attr('selected', true);


}

function actualizaDatos(){

    id_usuario=$('#id_usuario_editar').val();
    var rol_sel = document.getElementById("rol_agregar");
    var rol_valor = rol_sel.options[rol_sel.selectedIndex].value;


    nombre_usuario =  $('#nombre_usuario_editar').val();

    apellido= $('#apellido_usuario_editar').val();

    email= $('#email_editar').val();

    contra = $('#contrasena_editar').val();
    v_contrasena= $('#v_contrasena_editar').val();

    rol = rol_valor;


    cadena="id_usuario=" + id_usuario +
        "&nombre=" + nombre_usuario +
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

