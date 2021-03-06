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
      $tablaRequerida = 'matriculas';
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
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Matriculas/reportePDF.php';
                                document.reporte.submit()" />

                                <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Matriculas/reporteExcel.php';
                                document.reporte.submit()" />
                            </div>

                            <!--Select de año-->
                            <div class="col d-flex justify-content-end">
                                <select class="form-control col-md-5 anio" id="anio-select" name="anio-select">
                                    <option disabled selected hidden>Buscar por año</option>
                                    <option>Todos los registros</option>
                                    <?php
                                    $query = "select distinct year(fecha_creado) as fecha_creado from matriculas order by fecha_creado desc";
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

        <div id="tabla">
    <div class="row">
        <div class="col-sm-12">

        <div class="table-responsive-xl">
            <?php
            $salida = "";
            //query predefinido
            $sql="select
                matriculas.ID_MATRICULA,
                carreras.nombre_carrera,
                matriculas.CANTIDAD_ALUMNOS
                      from carreras
                      right join matriculas on carreras.ID_CARRERA = matriculas.ID_CARRERA";

            if (isset($_POST['consulta_anio'])) {

                if ($_POST['consulta_anio'] != 'Todos los registros') {
                    $q = $conexion->real_escape_string($_POST['consulta_anio']);
                    $_SESSION['consulta'] = $q;
                    $sql = "select
                matriculas.ID_MATRICULA,
                carreras.nombre_carrera,
                matriculas.CANTIDAD_ALUMNOS
                      from carreras
                      right join matriculas on carreras.ID_CARRERA = matriculas.ID_CARRERA 
                      where matriculas.fecha_creado LIKE '%$q%'";

                    if (isset($_POST['consulta'])) {
                        echo "estoy dentro";
                        /*variable goblal*/
                        $p = $_SESSION['consulta'];
                        $sql = "select
                matriculas.ID_MATRICULA,
                carreras.nombre_carrera,
                matriculas.CANTIDAD_ALUMNOS
                      from carreras
                      right join matriculas on carreras.ID_CARRERA = matriculas.ID_CARRERA 
                      where carreras.NOMBRE_CARRERA LIKE '%$p%'
                      and matriculas.fecha_creado LIKE '%$q%'";
                    }

                } else {
                    $sql = "select
                matriculas.ID_MATRICULA,
                carreras.nombre_carrera,
                matriculas.CANTIDAD_ALUMNOS
                      from carreras
                      right join matriculas on carreras.ID_CARRERA = matriculas.ID_CARRERA";

                    unset($_SESSION['consulta_anio']);
                    unset($_SESSION['consulta']);
                }
            }

            /*Query para consultas del buscador*/
            if(isset($_POST['consulta'])) {
                $q = $conexion->real_escape_string($_POST['consulta']);

                $_SESSION['consulta'] = $q;
                var_dump($_SESSION['consulta']);
                $sql = "select
                        matriculas.ID_MATRICULA,
                        carreras.nombre_carrera,
                        matriculas.CANTIDAD_ALUMNOS
                        from carreras
                        right join matriculas on carreras.ID_CARRERA = matriculas.ID_CARRERA 
                        where carreras.NOMBRE_CARRERA LIKE '%$q%'";

                if (isset($_SESSION['consulta_anio'])) {
                    $p = $_SESSION['consulta_anio'];
                    $sql = "select
                            matriculas.ID_MATRICULA,
                            carreras.nombre_carrera,
                            matriculas.CANTIDAD_ALUMNOS
                            from carreras
                            right join matriculas on carreras.ID_CARRERA = matriculas.ID_CARRERA
                            where carreras.NOMBRE_CARRERA LIKE '%$q%'
                            and matriculas.fecha_creado like '%$p%'";

                }
            }


            $resultado = $conexion->query($sql);
            if ($resultado->num_rows>0){
            $salida.='<table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2" id="tabla-php">
                <tr>
                    <td class="text-center align-middle background-table">Programa educativo</td>
                    <td class="text-center align-middle background-table">Cantidad de alumnos</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>';

                $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)) {

                    $datos = $ver[0] . "||" .
                        $ver[1] . "||" .
                        $ver[2];

                    $salida .= '<tr>
                        <td>' . $ver[1] . '</td>
                        <td>' . $ver[2] . '</td>
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform(\'' . $datos . '\')" ><i
                                    class="far fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\'' . $ver[0] . '\')"><i class="fas fa-trash"></i> Eliminar</button>
                        </td>
                    </tr>';
                }
                    $salida .= "<tr style='font-weight: bold'>
                          <td>Total</td>";

                    $sql = "select sum(CANTIDAD_ALUMNOS) 
                      from matriculas";
                    $result = mysqli_query($conexion, $sql);
                    $ver = mysqli_fetch_row($result);

                    $salida .= "<td> $ver[0]</td>";
                    $salida .= "</tr>";

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
