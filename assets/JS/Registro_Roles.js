

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
    nombre_rol=$('#nombe_rol_editar').val();


    moduloEdit = [];
    $('input[name=modulosEdit]:checked').each(function () {

        moduloEdit.push(parseInt(this.value));

    });

    console.log(moduloEdit);

    permisoEdit = [];
    $('input[name=permisosEdit]:checked').each(function () {

        permisoEdit.push(this.value);

    });

    console.log(permiso);


    $.ajax({
        type:"POST",
        url:"assets/components/PHP_Consultas/Registro_Roles/Actualizar_Registro.php",
        data:{id_rol:id_rol,nombre_rol:nombre_rol,modulo:modulo,permiso:permiso},
        success:function(r) {
            if(r==1){
                $('#registro-tutorias').load('assets/components/registro-roles.php');
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

