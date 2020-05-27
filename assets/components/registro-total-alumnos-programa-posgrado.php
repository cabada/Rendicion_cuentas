<?php

require_once "PHP_Consultas/Conexion.php";
require_once "PHP_Consultas/Usuarios/Verificar_Tablas_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$stmt = consultaTablas($conn,$id_usuario);


$stmt->execute();

$stmt->bind_result($resultado);

while($stmt->fetch()){

$tablaRequerida = 'total_alumnos_programa_posgrado';

if($resultado == $tablaRequerida){

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro total de alumnos de programa posgrado</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2" id="Tabla">
                <thead>
                  <tr>
                    <td class="text-center align-middle background-table">Nombre de programa</td>
                    <td class="text-center align-middle background-table">Cantidad</td>
                    <td class="text-center align-middle background-table">Porcentaje</td>
                    <td class="text-center align-middle background-table">Registrado en</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                  </tr>
                </thead>
                <tbody>
                <?php
                $sql="select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera";

                $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)) {

                    $datos=$ver[0]."||".
                           $ver[1]."||".
                           $ver[2]."||".
                           $ver[3];

                    $sql1 ="select sum(cantidad) as cantidad from
                            total_alumnos_programa_posgrado";
                    $result1 = mysqli_query($conexion,$sql1);
                    $ver1 = mysqli_fetch_row($result1);

                    $porcentaje = ($ver[2]*100)/$ver1[0];
                    $porcentaje = round($porcentaje);

                    ?>

                    <tr>
                        <td><?php echo utf8_encode($ver[1]) ?></td>
                        <td><?php echo $ver[2] ?></td>
                        <td><?php echo $porcentaje ?>%</td>
                        <td><?php echo $ver[3] ?></td>
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"><i
                                        class="far fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $ver[0] ?>')"><i class="fas fa-trash"></i> Eliminar</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr style="font-weight: bold">
                    <td>Total</td>
                    <?php

                    $sql1 ="select sum(cantidad) as cantidad from
                            total_alumnos_programa_posgrado";
                    $result1 = mysqli_query($conexion,$sql1);
                    $ver1 = mysqli_fetch_row($result1);

                    ?>
                    <td><?php echo $ver1[0]?></td>
                    <td>100%</td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <?php
}


}

$stmt->close();
$conexion->close();



?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#Tabla').DataTable({
            dom: 'Brtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            language:{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
cc
        });
    });

</script>