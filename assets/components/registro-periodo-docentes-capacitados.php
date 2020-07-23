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
      $tablaRequerida = 'periodo_docentes_capacitados';
      if($resultado == $tablaRequerida){
?>

<div class="row">
    <div class="col-sm-12">

        <!--Botones Excel y PDF -->
        <div class="row mt-2">
            <div class="col-12">
                <form id="reporte" name="reporte" method="POST" target="_blank">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <input class="btn btn-danger text-white" type="button" target="_blank" value="Exportar PDF"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Periodo_Docentes_Capacitados/reportePDF.php';
                                document.reporte.submit()" />

                                <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Periodo_Docentes_Capacitados/reporteExcel.php';
                                document.reporte.submit()" />
                            </div>

                            <!--Select de año-->
                            <div class="col d-flex justify-content-end">
                                <select class="form-control col-md-5 anio" id="anio-select" name="anio-select">
                                    <option disabled selected hidden>Buscar por año</option>
                                    <option>Todos los registros</option>
                                    <?php
                                    $query = "select distinct year(fecha_creado) as fecha_creado from periodo_docentes_capacitados order by fecha_creado desc";
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
            $salida="";
            $sql="select id_periodo_docentes_capacitados,
                            tipo_nombramiento,
                            total_docentes,
                            no_docentes_capacitados,
                            porcentaje_docentes_capacitados,
                            periodo
                            from periodo_docentes_capacitados";

            if (isset($_POST['consulta'])){
                $q = $conexion->real_escape_string($_POST['consulta']);
                $_SESSION['consulta'] = $q;
                $sql="select id_periodo_docentes_capacitados,
                            tipo_nombramiento,
                            total_docentes,
                            no_docentes_capacitados,
                            porcentaje_docentes_capacitados,
                            periodo
                            from periodo_docentes_capacitados
                            where tipo_nombramiento like '%$q%' 
                            or periodo like '%$q%'";

                if (isset($_POST['consulta_anio'])) {
                    /*variable goblal*/
                    $p = $_SESSION['consulta_anio'];
                    $sql = "select id_periodo_docentes_capacitados,
                            tipo_nombramiento,
                            total_docentes,
                            no_docentes_capacitados,
                            porcentaje_docentes_capacitados,
                            periodo
                            from periodo_docentes_capacitados
                            where tipo_nombramiento like '%$q%' 
                            or periodo like '%$q%'
                            and fecha_creado like '%$p%'";
                }

            }
            if(isset($_POST['consulta_anio'])){
            $q = $conexion->real_escape_string($_POST['consulta_anio']);
            /*Variable global*/
            if($_POST['consulta_anio']!='Todos los registros') {
                $_SESSION['consulta_anio'] = $q;
                $sql = "select id_periodo_docentes_capacitados,
                            tipo_nombramiento,
                            total_docentes,
                            no_docentes_capacitados,
                            porcentaje_docentes_capacitados,
                            periodo
                            from periodo_docentes_capacitados
                            where fecha_creado like '%$q%'";
            }
            else {
                $sql = "select id_periodo_docentes_capacitados,
                            tipo_nombramiento,
                            total_docentes,
                            no_docentes_capacitados,
                            porcentaje_docentes_capacitados,
                            periodo
                            from periodo_docentes_capacitados";

                unset($_SESSION['consulta_anio']);
            }

            }
            $resultado = $conexion->query($sql);
            if ($resultado->num_rows>0){

            $salida.='<table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2" id="tabla-php">
                <tr>
                    <td class="text-center align-middle background-table">Tipo de Nombramiento</td>
                    <td class="text-center align-middle background-table">Total de docentes</td>
                    <td class="text-center align-middle background-table">No. de docentes capacitados</td>
                    <td class="text-center align-middle background-table">Porcentaje de docentes capacitados</td>
                    <td class="text-center align-middle background-table">Periodo</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>';

                $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)){

                $datos=$ver[0]."||".
                    $ver[1]."||".
                    $ver[2]."||".
                    $ver[3]."||".
                    $ver[4]."||".
                    $ver[5];

                $salida.='<tr>
                    <td>'. $ver[1].'</td>
                    <td>'. $ver[2].'</td>
                    <td>'. $ver[3].'</td>
                    <td>'. $ver[4].'</td>
                    <td>'. $ver[5].'</td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#modalEdicion" onclick="agregaform(\''.$datos.'\')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\''.$ver[0].'\')"><i class="fas fa-trash"></i> Eliminar</button>
                    </td>
                </tr>';

                }

                $salida.="<tr style='font-weight: bold'>
                    <td>Total Enero</td>";

                    $sql="select sum(total_docentes) as tota_docentes from periodo_docentes_capacitados where periodo='Enero'";

                    $resultado = mysqli_query($conexion,$sql);

                    $buscar=mysqli_fetch_row($resultado);

                    $salida.="<td><?php echo $buscar[0]?></td>";

                    $sql1="select sum(no_docentes_capacitados) as docentes_capacitados from periodo_docentes_capacitados where periodo='Enero'";

                    $resultado1 = mysqli_query($conexion,$sql1);

                    $buscar1=mysqli_fetch_row($resultado1);

                    $salida.="<td><?php echo $buscar1[0]?></td>";

                    if(isset($buscar[0])){
                        $porcentaje= ($buscar1[0]*100)/$buscar[0];
                        $porcentaje = round($porcentaje);

                    }
                    else{
                        $porcentaje=0;
                    }

                    $salida.="<td><?php echo $porcentaje?>%</td>";

                $salida.="</tr>";

                $salida.="<tr style='font-weight: bold'>
                    <td>Total Junio</td>";

                    $sql="select sum(total_docentes) as tota_docentes from periodo_docentes_capacitados where periodo='Junio'";

                    $resultado = mysqli_query($conexion,$sql);

                    $buscar=mysqli_fetch_row($resultado);

                    $salida.="<td><?php echo $buscar[0]?></td>";

                    $sql1="select sum(no_docentes_capacitados) as docentes_capacitados from periodo_docentes_capacitados where periodo='Junio'";

                    $resultado1 = mysqli_query($conexion,$sql1);

                    $buscar1=mysqli_fetch_row($resultado1);

                    $salida.="<td><?php echo $buscar1[0]?></td>";

                    if(isset($buscar[0])){
                        $porcentaje= ($buscar1[0]*100)/$buscar[0];
                        $porcentaje = round($porcentaje);

                    }
                    else{
                        $porcentaje=0;
                    }

                    $salida.="<td><?php echo $porcentaje?>%</td>";
                $salida.="</tr>";
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
