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

$tablaRequerida = 'estudiantes_capacidades_diferentes';

if($resultado == $tablaRequerida){

?>
<div class="row">
    <div class="col-sm-12">
        <h2>Registro de estudiantes con capacidades diferentes</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>

        <!--Botones Excel y PDF -->
        <div class="row mt-2">
            <div class="col-12">
                <form id="reporte" name="reporte" method="POST" target="_blank">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <input class="btn btn-danger text-white" type="button" target="_blank" value="Exportar PDF"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Estudiantes_Capacidades_Diferentes/reportePDF.php';
                                document.reporte.submit()" />

                                <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Estudiantes_Capacidades_Diferentes/reporteExcel.php';
                                document.reporte.submit()" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Periodo</td>
                    <td class="text-center align-middle background-table">Año</td>
                    <td class="text-center align-middle background-table">Cantidad de estudiantes</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php
                    $sql="select id_estudiantes_capacidades_diferentes,PERIODO,ANIO,CANTIDAD_ALUMNOS 
                              from estudiantes_capacidades_diferentes";
                    $result=mysqli_query($conexion,$sql);
                    while ($ver=mysqli_fetch_row($result)){

                        $datos=$ver[0]."||".
                               $ver[1]."||".
                               $ver[2]."||".
                               $ver[3];
                ?>

                <tr>
                    <td><?php echo $ver[1]?></td>
                    <td><?php echo $ver[2]?></td>
                    <td><?php echo $ver[3]?></td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos?>')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $ver[0]?>')"><i class="fas fa-trash"></i>  Eliminar</button>
                    </td>
                </tr>
                <?php
                    }
                ?>
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