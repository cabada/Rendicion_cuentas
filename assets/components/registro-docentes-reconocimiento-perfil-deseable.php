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

$tablaRequerida = 'profesores_perfil';

if($resultado == $tablaRequerida) {

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
                                    <input class="btn btn-danger text-white" type="button" target="_blank"
                                           value="Exportar PDF"
                                           onclick="document.reporte.action = 'assets/components/PHP_Consultas/Registro_Docentes_Perfil/reportePDF.php';
                                document.reporte.submit()"/>


                                    <!--document.reporte.action = 'assets/components/PHP_Consultas/Registro_Total_Alumnos_Programa_Posgrado/reportePDF.php';
                                    document.reporte.submit()-->

                                    <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                           onclick="document.reporte.action = 'assets/components/PHP_Consultas/Registro_Docentes_Perfil/reporteExcel.php';
                                       document.reporte.submit()"/>

                                </div>

                                <!--Select de anio-->
                                <div class="col d-flex justify-content-end">
                                    <select class="form-control col-md-5 anio" id="anio-select" name="anio-select">
                                        <option>Buscar por año</option>
                                        <?php
                                        $query = "select distinct year(fecha_creado) as fecha_creado from profesores where id_categoria_profesores = 2 order by fecha_creado desc";
                                        $resultado = mysqli_query($conexion, $query);

                                        while ($fila = mysqli_fetch_array($resultado)) {
                                            $valor = $fila['nombre_area_academica'];

                                            echo "<option>" . ($fila['fecha_creado']) . "</option>\n";

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
                        $sql = "select profesores.id_profesor,
                            profesores.nombre_completo,
                            area_academica.nombre_area_academica,
                            profesores.vigencia
                            from profesores
                            join area_academica
                            on area_academica.id_area_academica = profesores.id_area_academica
                            where profesores.id_categoria_profesores = 2";

                        if(isset($_POST['consulta_anio'])){
                            $q = $conexion->real_escape_string($_POST['consulta_anio']);
                            $_SESSION['consulta_anio'] = $q;
                            $sql="select profesores.id_profesor,
                            profesores.nombre_completo,
                            area_academica.nombre_area_academica,
                            profesores.vigencia
                            from profesores
                            join area_academica
                            on area_academica.id_area_academica = profesores.id_area_academica
                            where profesores.id_categoria_profesores = 2 and profesores.fecha_creado like '%$q%'";

                        }

                        if (isset($_POST['consulta'])) {
                            $q = $conexion->real_escape_string($_POST['consulta']);
                            $_SESSION['consulta'] = $q;
                            $sql = "select profesores.id_profesor,
                            profesores.nombre_completo,
                            area_academica.nombre_area_academica,
                            profesores.vigencia
                            from profesores
                            join area_academica
                            on area_academica.id_area_academica = profesores.id_area_academica
                            where profesores.id_categoria_profesores = 2
                            and(profesores.nombre_completo like '%$q%' or area_academica.nombre_area_academica like '%$q%')";

                        }

                        $result = $conexion->query($sql);
                        if ($result->num_rows > 0) {

                            $salida .= ' <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2" id="tabla-php">
                <tr>
                    <td class="text-center align-middle background-table">Docente</td>
                    <td class="text-center align-middle background-table">Área adscripción</td>
                    <td class="text-center align-middle background-table">Vigencia</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>';


                            $result = mysqli_query($conexion, $sql);
                            while ($ver = mysqli_fetch_row($result)) {

                                $datos = $ver[0] . "||" .
                                    $ver[1] . "||" .
                                    $ver[2] . "||" .
                                    $ver[3];


                                $salida .= '<tr>
                        <td>'.$ver[1].'</td>
                        <td>'.utf8_encode($ver[2]).'</td>
                        <td>'.$ver[3].'</td>
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion"  onclick="agregaform(\'' . $datos . '\')" ><i class="far fa-edit"></i>  Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\'' . $ver[0] . '\')"><i class="fas fa-trash"></i>  Eliminar</button>
                        </td>
                    </tr>';

                            }
                            ?>
                            </table>
                            <?php
                        } else {
                            $salida .= '<div class="row mt-3">
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

<script>

    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
        }
    })()


</script>
