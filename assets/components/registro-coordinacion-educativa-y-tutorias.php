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

$tablaRequerida = 'coordinacion_educativa_y_tutorias';

if($resultado == $tablaRequerida){

?>


<div class="row">
    <div class="col-sm-12">
        <h2>Registro de coordinación educativa</h2>

        <!--Botones Excel y PDF -->
        <div class="row mt-2">
            <div class="col-12">
                <form id="reporte" name="reporte" method="POST" target="_blank">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <input class="btn btn-danger text-white" type="button" target="_blank" value="Exportar PDF"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Coordinacion_Educativa/reportePDF.php';
                                document.reporte.submit()" />

                                <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Coordinacion_Educativa/reporteExcel.php';
                                document.reporte.submit()" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive-xl">
            <?php
            $salida = "";
            $sql="select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias";

            if(isset($_POST['consulta'])){
                $q = $conexion->real_escape_string($_POST['consulta']);
                $sql="select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias where coordinacion_educativa_y_tutorias.NOMBRE_ACTIVIDAD LIKE '%$q%'"  ;
            }

                $resultado = $conexion->query($sql);
                if ($resultado->num_rows>0){
               $salida.='<table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                    <tr>
                        <td class="text-center align-middle background-table">Nombre de actividad</td>
                        <td class="text-center align-middle background-table">Periodo ENE-JUN</td>
                        <td class="text-center align-middle background-table">Periodo AGO-DIC</td>
                        <td class="text-center align-middle background-table">Total</td>
                        <td class="text-center align-middle background-table">Acciones</td>
                    </tr>';

                     $result=mysqli_query($conexion,$sql);
                     while($ver=mysqli_fetch_row($result)){

                         $datos=$ver[0]."||".
                                $ver[1]."||".
                                $ver[2]."||".
                                $ver[3];

            $suma=$ver[2]+$ver[3];
            $salida.='<tr>
                    <td>'. utf8_decode($ver[1]).'</td>
                    <td>'. $ver[2].'</td>
                    <td>'. $ver[3].'</td>
                    <td>'. $suma .'</td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform(\''.$datos.'\')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\''.$ver[0].'\')"><i class="fas fa-trash"></i>  Eliminar</button>
                    </td>
                </tr>';
                     }

                    $salida.="</table>";
                } else {
                    $salida.='<div class="row mt-3">
                        <div class="col-12 text-center">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>¡No se encontró ningún elemento!</strong><br>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>';
                }
            echo $salida;
            ?>
        </div>
    </div>
</div>

    <?php
}


}

$stmt->close();
$conexion->close();



?>