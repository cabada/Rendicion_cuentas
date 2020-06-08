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

$tablaRequerida = 'programa_delfin';

if($resultado == $tablaRequerida){

?>

<div class="row">
    <div class="col-sm-12">

        <!--Botones Excel y PDF -->
        <div class="row mt-2">
            <div class="col-12">
                <form id="reporte" name="reporte" method="POST" target="_blank">
                    <div class="form-group">
                        <div class="form-row d-flex">
                            <div class="col">
                                <input class="btn btn-danger text-white" type="button" target="_blank" value="Exportar PDF"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Programa_Delfin/reportePDF.php';
                                document.reporte.submit()" />


                                <!--document.reporte.action = 'assets/components/PHP_Consultas/Registro_Total_Alumnos_Programa_Posgrado/reportePDF.php';
                                document.reporte.submit()-->

                                <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Programa_Delfin/reporteExcel.php';
                                       document.reporte.submit()" />

                            </div>

                            <!--Select de anio-->
                            <div class="col d-flex justify-content-end">
                                <select class="form-control col-md-5 anio" id="anio-select" name="anio-select">
                                    <option disabled selected hidden>Buscar por año</option>
                                    <option>Todos los registros</option>
                                    <?php
                                    $query = "select distinct year(fecha_creado) as fecha_creado from programa_delfin order by fecha_creado desc";
                                    $resultado = mysqli_query($conexion,$query);

                                    while($fila = mysqli_fetch_array($resultado)){
                                        $valor = $fila['nombre_area_academica'];

                                        echo "<option>".($fila['fecha_creado'])."</option>\n";

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive-xl">
                <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de proyecto</td>
                    <td class="text-center align-middle background-table">Cantidad de alumnos</td>
                    <td class="text-center align-middle background-table">Carrera</td>
                    <td class="text-center align-middle background-table">Año</td>
                    <td class="text-center align-middle background-table">Fecha de inicio</td>
                    <td class="text-center align-middle background-table">Fecha de terminación</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                    <?php

                        $sql="select
                            programa_delfin.id_programa,
                            programa_delfin.nombre_proyecto,
                            programa_delfin.cantidad_alumnos,
                            carreras.nombre_carrera,
                            programa_delfin.anio,
                            programa_delfin.fecha_inicio,
                            programa_delfin.fecha_termino
                             from carreras
                             right join programa_delfin on carreras.ID_CARRERA = programa_delfin.ID_CARRERA";
                    $result=mysqli_query($conexion,$sql);
                    while($ver=mysqli_fetch_row($result)){

                        $datos=$ver[0]."||".
                            $ver[1]."||".
                            $ver[2]."||".
                            $ver[3]."||".
                            $ver[4]."||".
                            $ver[5]."||".
                            $ver[6];

                    ?>

                <tr>
                    <td><?php echo $ver[1]?></td>
                    <td><?php echo $ver[2]?></td>
                    <td><?php echo utf8_encode($ver[3])?></td>
                    <td><?php echo $ver[4]?></td>
                    <td><?php echo $ver[5]?></td>
                    <td><?php echo $ver[6]?></td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos?>')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $ver[0] ?>')"><i class="fas fa-trash"></i>  Eliminar</button>
                    </td>
                </tr>
                    <?php
                    }
                    ?>
            </table>
        </div>
</div>

    <?php
}


}

$stmt->close();
$conexion->close();



?>