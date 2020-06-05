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
    $tablaRequerida = 'proyectos_investigacion_posgrado_periodo';
     if($resultado == $tablaRequerida){
        ?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de proyectos de investigación pertenecientes a posgrado</h2>
        <!--Botones Excel y PDF -->
        <div class="row mt-2">
            <div class="col-12">
                <form id="reporte" name="reporte" method="POST" target="_blank">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <input class="btn btn-danger text-white" type="button" target="_blank" value="Exportar PDF"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Proyectos_Investigacion_Posgrado_Periodo/reportePDF.php';
                                document.reporte.submit()" />

                                <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Proyectos_Investigacion_Posgrado_Periodo/reporteExcel.php';
                                document.reporte.submit()" />
                            </div>

                            <!--Select de año-->
                            <div class="col d-flex justify-content-end">
                                <select class="form-control col-md-5 anio" id="anio-select" name="anio-select">
                                    <option>Buscar por año</option>
                                    <?php
                                    $query = "select distinct year(fecha_creado) as fecha_creado from proyectos_investigacion_posgrado_periodo order by fecha_creado desc";
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

    <div class="row">
        <div class="col-sm-12">

        <div class="table-responsive-xl">
            <?php
            $salida = "";
            //query predefinido
            $sql="select ID_PROYECTO_INV_POSGRADO_PERIODO,CLAVE,NOMBRE_PROYECTO,RESPONSABLE
                      from proyectos_investigacion_posgrado_periodo";

            if(isset($_POST['consulta'])){

                $q= $conexion->real_escape_string($_POST['consulta']);
                $_SESSION['consulta'] = $q;
                $sql="select ID_PROYECTO_INV_POSGRADO_PERIODO,CLAVE,NOMBRE_PROYECTO,RESPONSABLE
                      from proyectos_investigacion_posgrado_periodo 
                      where proyectos_investigacion_posgrado_periodo.CLAVE LIKE '%$q%' or 
                      proyectos_investigacion_posgrado_periodo.NOMBRE_PROYECTO LIKE '%$q%' or 
                      proyectos_investigacion_posgrado_periodo.RESPONSABLE LIKE '%$q%'";

                if (isset($_POST['consulta_anio'])) {
                    /*variable goblal*/
                    $p = $_SESSION['consulta_anio'];
                    $sql="select ID_PROYECTO_INV_POSGRADO_PERIODO,CLAVE,NOMBRE_PROYECTO,RESPONSABLE
                      from proyectos_investigacion_posgrado_periodo 
                      where proyectos_investigacion_posgrado_periodo.CLAVE LIKE '%$q%' or 
                      proyectos_investigacion_posgrado_periodo.NOMBRE_PROYECTO LIKE '%$q%' or 
                      proyectos_investigacion_posgrado_periodo.RESPONSABLE LIKE '%$q%'
                      and fecha_creado LIKE '%$p%'";

                }

            }
            /*Query para consultas del buscador*/

            if(isset($_POST['consulta_anio'])){
                $q = $conexion->real_escape_string($_POST['consulta_anio']);
                /*Variable global*/
                if($_POST['consulta_anio']!='Todos los registros'){
                $_SESSION['consulta_anio']=$q;
                $sql="select ID_PROYECTO_INV_POSGRADO_PERIODO,CLAVE,NOMBRE_PROYECTO,RESPONSABLE
                      from proyectos_investigacion_posgrado_periodo
                      where fecha_creado LIKE '%$q%'";

            } else {
                    $sql="select ID_PROYECTO_INV_POSGRADO_PERIODO,CLAVE,NOMBRE_PROYECTO,RESPONSABLE
                      from proyectos_investigacion_posgrado_periodo";

                }
            }

            $resultado = $conexion->query($sql);
            if ($resultado->num_rows>0){
            $salida.='<table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Clave</td>
                    <td class="text-center align-middle background-table">Nombre de proyecto</td>
                    <td class="text-center align-middle background-table">Responsable</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>';

                $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)){

                    $datos=$ver[0]."||".
                           $ver[1]."||".
                           $ver[2]."||".
                           $ver[3];

                $salida.='<tr>
                    <td>'.utf8_decode($ver[1]) .'</td>
                    <td>'. $ver[2] .'</td>
                    <td>'. $ver[3] .'</td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform(\''.$datos.'\')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\''.$ver[0].'\')"><i class="fas fa-trash"></i>  Eliminar</button>
                    </td>
                </tr>';
                }
                ?>
                </table>
                <?php
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
    </div>
          </div>

       <?php
     }

}

$stmt->close();
$conexion->close();

?>