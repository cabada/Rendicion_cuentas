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

$tablaRequerida = 'equipo_maestros_itcj';

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
                                           onclick= "createPDF()" />


                                    <!--document.reporte.action = 'assets/components/PHP_Consultas/Registro_Total_Alumnos_Programa_Posgrado/reportePDF.php';
                                    document.reporte.submit()-->

                                    <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                           onclick= "tableToExcel('tabla', 'Listado de Maestros con Certificaciones')" />

                                </div>

                                <!--Select de anio-->
                                <div class="col d-flex justify-content-end">
                                    <select class="form-control col-md-5 anio" id="anio-select" name="anio-select">
                                        <option>Buscar por año</option>
                                        <?php
                                        $query = "select distinct year(fecha_creado) as fecha_creado from equipo_maestros_itcj order by fecha_creado desc";
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
                $sql="select id_equipo_maestros_itcj,nombre_docente,categoria_hora,grado_estudios,sni,area_especializacion,
                experiencia_profesional,experiencia_docente from equipo_maestros_itcj";

                if(isset($_POST['consulta'])){
                    $q = $conexion->real_escape_string($_POST['consulta']);
                    $sql = "select id_equipo_maestros_itcj,
                                    nombre_docente,
                                    categoria_hora,
                                    grado_estudios,
                                    sni,area_especializacion,
                                    experiencia_profesional,
                                    experiencia_docente 
                                    from equipo_maestros_itcj
                                    where nombre_docente like '%$q%' or grado_estudios like '%$q%' or grado_estudios like '%$q%'";
                }

                if(isset($_POST['consulta_anio'])){
                    $q = $conexion->real_escape_string($_POST['consulta_anio']);
                    $sql = "select id_equipo_maestros_itcj,
                                    nombre_docente,
                                    categoria_hora,
                                    grado_estudios,
                                    sni,area_especializacion,
                                    experiencia_profesional,
                                    experiencia_docente 
                                    from equipo_maestros_itcj
                                    where fecha_creado like '%$q%'";

                }

                $resultado = $conexion->query($sql);
                if($resultado->num_rows>0){

                    $salida.='
                     <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de docente</td>
                    <td class="text-center align-middle background-table">Categoría</td>
                    <td class="text-center align-middle background-table">Grado de estudios</td>
                    <td class="text-center align-middle background-table">SNI</td>
                    <td class="text-center align-middle background-table">Área de especialización</td>
                    <td class="text-center align-middle background-table">Experiencia profesional</td>
                    <td class="text-center align-middle background-table">Experiencia docente</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>';


                $resultado = mysqli_query($conexion,$sql);

                while($buscar=mysqli_fetch_row($resultado)) {

                $datos = $buscar[0]."||".
                    $buscar[1]."||".
                    $buscar[2]."||".
                    $buscar[3]."||".
                    $buscar[4]."||".
                    $buscar[5]."||".
                    $buscar[6]."||".
                    $buscar[7];



                $salida.='
                <tr>
                    <td>'.$buscar[1].'</td>
                    <td>'.$buscar[2].'</td>
                    <td>'.$buscar[3].'</td>
                    <td>'.$buscar[4].'</td>
                    <td>'.$buscar[5].'</td>
                    <td>'.$buscar[6].'</td>
                    <td>'.$buscar[7].'</td>
                     <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion"  onclick="agregaform(\''.$datos.'\')" ><i class="far fa-edit"></i>  Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\''.$buscar[0].'\')"><i class="fas fa-trash"></i>  Eliminar</button>
                                    
                     </td>
                </tr>';



                }
                ?>
            </table>
                    <?php
                    }else{
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

