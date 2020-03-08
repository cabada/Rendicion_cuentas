function agregarDatos(carrera,modalidad,nuevo_ingreso, reingreso,status,
                      periodo) {
    cadena = "carrera=" + carrera +
        "&modalidad=" + modalidad +
        "&nuevo_ingreso=" + nuevo_ingreso +
        "&reingreso=" + reingreso +
        "&status=" + status +
        "&periodo=" + periodo;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Programa_Educativo/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-programa-educativo').load('assets/components/registro-programa-educativo.php');
                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}

function agregaForm(datos) {

    d = datos.split('||');

    $('#id_programa_educativo').val(d[0]);
    $('#carrera_editar').val(d[1]);
    $('#modalidad_editar').val(d[2]);
    $('#ingreso_editar').val(d[3]);
    $('#reingreso_editar').val(d[4]);
    $('#estatus_editar').val(d[5]);
    $('#periodo_editar').val(d[6]);

}

function actualizarDatos() {
    id_programa_educativo=$('#id_programa_educativo').val();

    var carrera_sel = document.getElementById("carrera_editar");
    var carrera_valor = carrera_sel.options[carrera_sel.selectedIndex].text;

    var modalidad_sel = document.getElementById("modalidad_editar");
    var modalidad_valor = modalidad_sel.options[modalidad_sel.selectedIndex].text;

    var estatus_sel = document.getElementById("estatus_editar");
    var estatus_valor = estatus_sel.options[estatus_sel.selectedIndex].text;

    var periodo_sel = document.getElementById("periodo_editar");
    var periodo_valor = periodo_sel.options[periodo_sel.selectedIndex].text;

    carrera = carrera_valor;
    console.log(carrera);

    modalidad= modalidad_valor;
    console.log(modalidad);
    nuevo_ingreso=$('#ingreso_editar').val();
    console.log(nuevo_ingreso);
    reingreso=$('#reingreso_editar').val();
    console.log(reingreso);
    status=estatus_valor;
    console.log(status);

    periodo=periodo_valor;
    console.log(periodo);

    cadena ="id_programa_educativo" + id_programa_educativo +
        "&carrera=" + carrera +
        "&modalidad=" + modalidad +
        "&nuevo_ingreso=" + nuevo_ingreso +
        "&reingreso=" + reingreso +
        "&status=" + status +
        "&periodo=" + periodo;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Programa_Educativo/Actualizar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-programa-educativo').load('assets/components/registro-programa-educativo.php');
                alertify.success("Actualizado con exito ");
            }
            else{
                alertify.error("Fallo el servidor");
            }
        }
    });

}

