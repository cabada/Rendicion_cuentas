

function agregarDatos(nombre_rol,modulo,permiso){

    cadena="nombre_rol=" + nombre_rol +
        "&modulo=" + modulo +
        "&permiso=" + permiso;


    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Roles/Agregar_Registro.php",
        data:{nombre_rol:nombre_rol,modulo:modulo,permiso:permiso},
        success:function(r) {
            if(r==1){
                $('#roles').load('assets/components/registro-roles.php');
                alertify.success("agregado con exito");

            }else{
                alertify.error("fallo el servidor");
            }
        }
    });
}

function agregaform(datos,filaOP,filaMod) {

    d=datos.split('||');
    p=filaOP.split(',');
    m=filaMod.split(',');

    console.log(Math.max.apply(null,m));


    $('#id_rol_editar').val(d[0]);
    $('#nombre_rol_editar').val(d[1]);
    console.log(p);

    $('input[name=permisosEdit]:checked').each(function () {


                $(this).prop("checked",false);

        });

    $('input[name=modulosEdit]:checked').each(function () {


        $(this).prop("checked",false);

    });





    $('input[name=permisosEdit]:not(:checked)').each(function () {

        console.log($(this).val());
        len = p.length;
        console.log(len);

        for (i=0;i<len;i++){

            if($(this).val() == p[i]){


                $(this).click();

            }

        }


    });

    $('input[name=modulosEdit]:not(:checked)').each(function () {

        len =Math.max.apply(null,m) ;
        console.log($(this).val());

        for (i=0;i<=len;i++){

            if($(this).val() == m[i]){

                $(this).click();
            }

        }



    });
}

function actualizaDatos(){

    id_rol=$('#id_rol_editar').val();
    nombre_rol=$('#nombre_rol_editar').val();

    console.log(nombre_rol);

    moduloEdit = [];
    $('input[name=modulosEdit]:checked').each(function () {

        moduloEdit.push(parseInt(this.value));

    });

    console.log(moduloEdit);

    permisoEdit = [];
    $('input[name=permisosEdit]:checked').each(function () {

        permisoEdit.push(this.value);

    });

    moduloEditUCHK = [];
    $('input[name=modulosEdit]:not(:checked)').each(function () {

        moduloEditUCHK.push(parseInt(this.value));

    });

    permisoEditUCHK = [];
    $('input[name=permisosEdit]:not(:checked)').each(function () {

        permisoEditUCHK.push(this.value);

    });




    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Roles/Actualizar_Registro.php",
        data:{id_rol:id_rol,nombre_rol:nombre_rol,modulo:moduloEdit,permiso:permisoEdit,moduloUCHK:moduloEditUCHK,permisoUCHK:permisoEditUCHK},
        success:function(r) {
            if(r==1){
                $('#roles').load('assets/components/registro-roles.php');
                alertify.success("Actualizado con exito");

            }else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}

function preguntarSiNo(id_rol) {
    alertify.confirm('Eliminar Registro', '¿Esta seguro de eliminar este registro?',
        function(){ eliminarDatos(id_rol) }
        , function(){ alertify.error('Se cancelo.')});

}

function eliminarDatos(id_rol) {
    cadena="id_rol=" + id_rol;

    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Roles/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#roles').load('assets/components/registro-roles.php');
                alertify.success("Eliminado con exito");
            }else{
                alertify.error("Fallo el servidor");
            }
        }

    });


}

