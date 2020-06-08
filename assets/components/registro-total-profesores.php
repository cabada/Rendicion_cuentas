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

        $tablaRequerida = 'total_profesores_grado_academico';
        if($resultado == $tablaRequerida){
?>

<div class="row">
    <div class="col-sm-12">
       <!--BOTONES EXCEL Y PDF -->
        <div class="row mt-2">
            <div class="col-12">
                <form id="reporte" name="reporte" method="POST" target="_blank">
                    <div class="form-group">
                        <div class="form-row d-flex">
                            <div class="col">
                                <input class="btn btn-danger text-white" type="button" target="_blank"
                                    value="Exportar PDF"
                                    onclick="document.reporte.action = 'assets/components/PHP_Consultas/Registro_Total_Profesores_GA/reportePDF.php';
                                    document.reporte.submit()"/>

                                    <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                    onclick="document.reporte.action = 'assets/components/PHP_Consultas/Registro_Total_Profesores_GA/reporteExcel.php';
                                    document.reporte.submit()"/>
                            </div>

                            <!--SELECT DE ANIO -->
                            <div class="col d-flex justify-content-end">
                                <select class="form-control col-md-5 anio" id="anio-select" name="anio-select">
                                    <option disabled selected hidden>Buscar por año</option>
                                    <option>Todos los registros</option>
                                    <?php
                                        $query = "SELECT DISTINCT year(fecha_creado) AS fecha_creado FROM total_profesores_grado_academico ORDER BY fecha_creado DESC";
                                        $resultado = mysqli_query($conexion, $query);

                                        while ($fila = mysqli_fetch_array($resultado)) {
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
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="table-responsive-xl">
            <?php
                $salida = "";
                $sql = "SELECT id_prof_grado_acad, grado, cantidad, fecha_creado FROM total_profesores_grado_academico";

                if(isset($_POST['consulta_anio'])){
                    if($_POST['consulta_anio']!='Todos los registros'){
                        $q = $conexion->real_escape_string($_POST['consulta_anio']);
                        $_SESSION['consulta_anio'] = $q;
                        $sql="SELECT id_prof_grado_acad, grado, cantidad, fecha_creado 
                            FROM total_profesores_grado_academico WHERE fecha_creado LIKE '%$q%'";

                    } else {
                        unset($_SESSION['consulta_anio']);
                        $sql="SELECT id_prof_grado_acad, grado, cantidad, fecha_creado FROM total_profesores_grado_academico";
                        
                    }
                }

                if (isset($_POST['consulta'])) {
                    $q = $conexion->real_escape_string($_POST['consulta']);
                    $_SESSION['consulta'] = $q;
                    $sql = "SELECT id_prof_grado_acad, grado, cantidad, fecha_creado FROM total_profesores_grado_academico 
                        WHERE grado LIKE '%$q%' OR cantidad LIKE '%$q%'";

                    if(isset($_SESSION['consulta_anio'])){
                        $p = $_SESSION['consulta_anio'];
                        $sql = "SELECT id_prof_grado_acad, grado, cantidad, fecha_creado FROM total_profesores_grado_academico 
                            WHERE (grado LIKE '%$q%' OR cantidad LIKE '%$q%') AND fecha_creado LIKE '%$p%'";
                    }
                }

                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    $salida.='<table class="table table-sm table-hover table-condensed table-bordered table-striped" id="tabla-php">
                        <tr>
                            <td class="text-center align-middle background-table">Grado</td>
                            <td class="text-center align-middle background-table">Cantidad</td>
                            <td class="text-center align-middle background-table">Porcentaje</td>
                            <td class="text-center align-middle background-table" style="min-width: 180px; width: 180px;">Acciones</td>
                        </tr>';

                    $result = mysqli_query($conexion, $sql);
                    while ($buscar = mysqli_fetch_row($result)) {
                        $datos = $buscar[0]."||".
                            $buscar[1]."||".
                            $buscar[2]."||".
                            $buscar[3];

                        $sql1="SELECT SUM(cantidad) AS cantidad FROM total_profesores_grado_academico";
                        $resultado1 = mysqli_query($conexion,$sql1);
                        $buscar1=mysqli_fetch_row($resultado1);
                        $total = $buscar1[0];
                        $porcentaje = ($buscar[2] * 100)/$total;
                        $porcentaje = round($porcentaje);

                        $salida.='<tr>
                            <td>'.utf8_decode($buscar[1]).'</td>
                            <td>'.utf8_decode($buscar[2]).'</td>
                            <td>'.utf8_decode($porcentaje).'%</td>
                            <td class="text-center align-middle">
                                <button class="btn btn-sm btn-warning" onclick="agregaform(\''.$datos.'\')" data-toggle="modal" data-target="#modalEdicion"><i class="far fa-edit"></i> Editar</button>
                                <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\''.$buscar[0].'\')"><i class="fas fa-trash"></i> Eliminar</button>
                            </td>
                        </tr>';
                    }

                    $salida.='<tr style="font-weight: bold">
                        <td>Total profesores</td>';

                    $sql="SELECT SUM(cantidad) AS cantidad FROM total_profesores_grado_academico";
                    $resultado = mysqli_query($conexion,$sql);
                    $buscar=mysqli_fetch_row($resultado);
                    
                    $salida.='<td>'.$buscar[0].'</td>
                        <td>100%</td>
                    </tr>';
                    
                    $salida.='</table>';

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