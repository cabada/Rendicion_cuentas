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

$tablaRequerida = 'equipo_apoyo_asesores_pda';

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
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Equipo_Apoyo_Asesores/reportePDF.php';
                                document.reporte.submit()" />

                                <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Equipo_Apoyo_Asesores/reporteExcel.php';
                                document.reporte.submit()" />
                            </div>

                            <!--Select de año-->
                            <div class="col d-flex justify-content-end">
                                <select class="form-control col-md-5 anio" id="anio-select" name="anio-select">
                                    <option disabled selected hidden>Buscar por año</option>
                                    <option>Todos los registros</option>
                                    <?php
                                    $query = "select distinct year(fecha_creado) as fecha_creado from equipo_apoyo_asesores_pda order by fecha_creado desc";
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
            $sql="select id_equipo_apoyo,nombre,puesto,grado_estudios,funciones_med_tecnm from equipo_apoyo_asesores_pda";

            if(isset($_POST['consulta'])) {

             $q = $conexion->real_escape_string($_POST['consulta']);
             $_SESSION['consulta'] = $q;

            $sql="select id_equipo_apoyo,nombre,puesto,grado_estudios,funciones_med_tecnm from equipo_apoyo_asesores_pda
            where nombre like '%$q%'
            or puesto like '%$q%'
            or grado_estudios like '%$q%'
            or funciones_med_tecnm like '%$q%'";


            if (isset($_POST['consulta_anio'])) {
                 /*variable goblal*/
                 $p = $_SESSION['consulta_anio'];

              $sql="select id_equipo_apoyo,nombre,puesto,grado_estudios,funciones_med_tecnm from equipo_apoyo_asesores_pda
            where nombre like '%$q%'
            or puesto like '%$q%'
            or grado_estudios like '%$q%'
            or funciones_med_tecnm like '%$q%'
            and fecha_creado like '%$p%'";

              }}
            /*Query para consultas del buscador*/

            if(isset($_POST['consulta_anio'])){
                $q = $conexion->real_escape_string($_POST['consulta_anio']);
                /*Variable global*/
                if($_POST['consulta_anio']!='Todos los registros'){
                $_SESSION['consulta_anio']=$q;

                $sql="select id_equipo_apoyo,nombre,puesto,grado_estudios,funciones_med_tecnm from equipo_apoyo_asesores_pda
                where fecha_creado like '%$q%'";
                }else {
                    $sql="select id_equipo_apoyo,nombre,puesto,grado_estudios,funciones_med_tecnm from equipo_apoyo_asesores_pda";

                    unset($_SESSION['çonsulta_anio']);
                }}

            $resultado = $conexion->query($sql);
            if ($resultado->num_rows>0){


            $salida.='<table id="tabla-php" class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre</td>
                    <td class="text-center align-middle background-table">Puesto</td>
                    <td class="text-center align-middle background-table">Grado de estudios</td>
                    <td class="text-center align-middle background-table">Funciones TECNM</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>';


                $resultado = mysqli_query($conexion,$sql);

                while($buscar=mysqli_fetch_row($resultado)) {

                    $datos = $buscar[0] . "||" .
                        $buscar[1] . "||" .
                        $buscar[2] . "||" .
                        $buscar[3] . "||" .
                        $buscar[4];

                    $salida .= '<tr>
                    <td>' . $buscar[1]. '</td>
                    <td>' . $buscar[2] . '</td>
                    <td>' . $buscar[3] . '</td>
                    <td>' . $buscar[4] . '</td>
                    <td class="text-center align-middle">
                   <button class="btn btn-warning" onclick="agregaform(\'' . $datos . '\')" data-toggle="modal" data-target="#modalEdicion"><i class="far fa-edit"></i></button>
                    <button class="btn btn-danger" onclick="preguntarSiNo(\'' . $buscar[0] . '\')"><i class="far fa-window-close"></i></button>
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