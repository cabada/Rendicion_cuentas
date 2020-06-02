function agregarDatos(carrera,modalidad,nuevo_ingreso, reingreso,status,
                      periodo,total) {
    cadena = "carrera=" + carrera +
        "&modalidad=" + modalidad +
        "&nuevo_ingreso=" + nuevo_ingreso +
        "&reingreso=" + reingreso +
        "&status=" + status +
        "&periodo=" + periodo+
        "&total="+total;

    $.ajax({
        type:"post",
        url:"assets/components/P HP_Consultas/Registro_Programa_Educativo/Agregar_Registro.php",
        data:cadena,
        success:function(r) {
            if(r==1){
                $('#registro-programa-educativo').load('assets/components/registro-programa-educativo.php');

                alertify.success("Agregado con exito: ");
            }
            else{
                alertify.error("No tiene los privilegios suficientes...");
            }

        }

    });

}

function agregaForm(datos) {


    d = datos.split('||');

    $('#id_programa_educativo').val(d[0]);

    $('option:selected', 'select[carrera_editar="options"]').removeAttr('selected');
    $('option:selected', 'select[modalidad_editar="options"]').removeAttr('selected');
    $('option:selected', 'select[estatus_editar="options"]').removeAttr('selected');
    $('option:selected', 'select[periodo_editar="options"]').removeAttr('selected');

    $("#carrera_editar option:contains('"+d[1]+"')").attr('selected', true);
    $("#modalidad_editar option:contains('"+d[2]+"')").attr('selected', true);
    $('#ingreso_editar').val(d[3]);
    $('#reingreso_editar').val(d[4]);
    $("#estatus_editar option:contains('"+d[5]+"')").attr('selected', true);
    $("#periodo_editar option:contains('"+d[6]+"')").attr('selected', true);

}

function actualizarDatos() {
    id_programa_educativo=$('#id_programa_educativo').val();

    var modalidad_sel = document.getElementById("modalidad_editar");
    var modalidad_valor = modalidad_sel.options[modalidad_sel.selectedIndex].text;

    var estatus_sel = document.getElementById("estatus_editar");
    var estatus_valor = estatus_sel.options[estatus_sel.selectedIndex].text;

    var periodo_sel = document.getElementById("periodo_editar");
    var periodo_valor = periodo_sel.options[periodo_sel.selectedIndex].text;

    carrera = parseInt($('#carrera_editar').val());
    console.log(carrera);

    modalidad= modalidad_valor;
    console.log(modalidad);
    nuevo_ingreso=parseInt($('#ingreso_editar').val());
    console.log(nuevo_ingreso);
    reingreso=parseInt($('#reingreso_editar').val());
    console.log(reingreso);
    status=estatus_valor;
    console.log(status);

    periodo=periodo_valor;
    console.log(periodo);
    total = nuevo_ingreso + reingreso;

    cadena ="id_programa_educativo=" + id_programa_educativo +
        "&carrera=" + carrera +
        "&modalidad=" + modalidad +
        "&nuevo_ingreso=" + nuevo_ingreso +
        "&reingreso=" + reingreso +
        "&status=" + status +
        "&periodo=" + periodo+
        "&total="+total;

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
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });

}

function preguntarSiNo(id_programa_educativo) {
    alertify.confirm('Eliminar este registro', 'Esta seguro de eliminar este registro?',
        function(){ eliminardatos(id_programa_educativo)}
        , function(){ alertify.error('Se cancelo')});
}
function eliminardatos(id_programa_educativo) {

    cadena ="id_programa_educativo=" + id_programa_educativo;

    $.ajax({
        type:"post",
        url:"assets/components/PHP_Consultas/Registro_Programa_Educativo/Eliminar_Registro.php",
        data:cadena,
        success:function (r) {
            if(r==1){
                $('#registro-programa-educativo').load('assets/components/registro-programa-educativo.php');
                alertify.success("Eliminado con exito!");
            }else{
                alertify.error("No tiene los privilegios suficientes...");
            }
        }
    });
}

// FUNCION PARA BUSCAR DATOS DE TABLA PROGRAMA EDUCATIVO
$(buscar_datos());
function buscar_datos(consulta){
	$.ajax({
		url:'assets/components/registro-programa-educativo.php',
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta},
	})
	.done(function(respuesta){
		$("#registro-programa-educativo").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}

$(document).on('keyup','#caja_busqueda', function(){
	var valor = $(this).val();
	if (valor != "") {
		buscar_datos(valor);
	}else{
		buscar_datos();
	}
});