function agregarDatos(nombre_completo,area_academica,
                      vigencia) {
    cadena = "nombre_completo=" + nombre_completo +
        "&area_academica=" + area_academica +
        "&vigencia=" + vigencia;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Docentes_Perfil/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-docentes-reconocimiento-perfil-deseable').load('assets/components/registro-docentes-reconocimiento-perfil-deseable.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}

//==============================================================================================

function agregaform(datos) {

    d=datos.split('||');

    $('#id_profesor').val(d[0]);
    $('#nombre_editar').val(d[1]);
    $('#area_academica_editar').val(d[2]);
    $('#vigencia_editar').val(d[3]);




}

function actualizaDatos() {


    id_profesor=$('#id_profesor').val();

    var area_sel = document.getElementById("area_academica_editar");
    var area_valor = area_sel.options[area_sel.selectedIndex].value;


    nombre_completo = $('#nombre_editar').val();
    area_academica = parseInt( $('#area_academica_editar').val());
    console.log(area_academica);
    vigencia = $('#vigencia_editar').val();



    cadena = "id_profesor="+ id_profesor +
        "&nombre_completo=" + nombre_completo +
        "&area_academica=" + area_academica +
        "&vigencia=" + vigencia;



    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Docentes_Perfil/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-docentes-reconocimiento-perfil-deseable').load('assets/components/registro-docentes-reconocimiento-perfil-deseable.php');
                alertify.success("Actualizado con exito: ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });
}


function preguntarSiNo(id_profesor) {

    alertify.confirm('Eliminar Registro', 'Esta seguro de eliminar este registro??',
        function(){ eliminarDatos(id_profesor) }
        , function(){ alertify.error('Se cancelo.')});

}

function eliminarDatos(id_profesor) {
    cadena = "id_profesor="+id_profesor ;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Docentes_Perfil/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-docentes-reconocimiento-perfil-deseable').load('assets/components/registro-docentes-reconocimiento-perfil-deseable.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("Fallo el servidor!");
            }

        }
    });

}