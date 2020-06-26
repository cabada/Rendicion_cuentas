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
     $tablaRequerida = 'total_alumnos_programa_posgrado';
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
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Total_Alumnos_Programa_Posgrado/reportePDF.php';
                                document.reporte.submit()" />

                                <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Total_Alumnos_Programa_Posgrado/reporteExcel.php';
                                document.reporte.submit()" />
                            </div>

                            <!--Select de año-->
                            <div class="col d-flex justify-content-end">
                                <select class="form-control col-md-5 anio" id="anio-select" name="anio-select">
                                    <option disabled selected hidden>Buscar por año</option>
                                    <option>Todos los registros</option>
                                    <?php
                                    $query = "select distinct year(fecha_creado) as fecha_creado from total_alumnos_programa_posgrado order by fecha_creado desc";
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
            $sql="select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera";

         if(isset($_POST['consulta_anio'])) {
             /*Se agrega un if para verificar que el combobox sea algo diferente a todos los registros*/
                    if($_POST['consulta_anio']!='Todos los registros'){

             $q = $conexion->real_escape_string($_POST['consulta_anio']);
             $_SESSION['consulta_anio'] = $q;
             $sql = "select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera 
                    where total_alumnos_programa_posgrado.fecha_creado LIKE '%$q%'";

             if (isset($_POST['consulta'])) {
                 echo "estoy dentro";

                 $p = $_SESSION['consulta'];
                 $sql = "select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera 
                    where total_alumnos_programa_posgrado.fecha_creado like '%$q%'
                    and carreras.NOMBRE_CARRERA LIKE '%$p%'";

             }

         }
                else{
                    $sql="select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera";

                    unset($_SESSION['consulta_anio']);
                    unset($_SESSION['consulta']);
                }
            }
         /*Query para consultas del buscador*/

                /*Verifica que se haya definido $_Post['consulta]*/
                if(isset($_POST['consulta'])) {

                    $q = $conexion->real_escape_string($_POST['consulta']);

                    /*Variable global*/
                    $_SESSION['consulta'] = $q;
                    var_dump($_SESSION['consulta']);
                    $sql = "select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera 
                    where carreras.nombre_carrera LIKE '%$q%'";

                    /*Buscar en la caja de busqueda con el anio seleccionado*/
                    if (isset($_SESSION['consulta_anio'])) {

                        $p = $_SESSION['consulta_anio'];
                        $sql = "select total_alumnos_programa_posgrado.ID_TOTAL_PROG_POSGRADO,
                            carreras.nombre_carrera,
                            total_alumnos_programa_posgrado.CANTIDAD,
                            total_alumnos_programa_posgrado.REGISTRADO_EN
                    from total_alumnos_programa_posgrado
                    join carreras
                    on carreras.id_carrera = total_alumnos_programa_posgrado.id_carrera 
                    where carreras.nombre_carrera LIKE '%$q%'
                    and total_alumnos_programa_posgrado.fecha_creado like '%$p%'";
                    }
                }


            $resultado = $conexion->query($sql);
            if ($resultado->num_rows>0){
            $salida.='<table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2" id="tabla-php">
                  <tr>
                    <td class="text-center align-middle background-table">Nombre de programa</td>
                    <td class="text-center align-middle background-table">Cantidad</td>
                    <td class="text-center align-middle background-table">Porcentaje</td>
                    <td class="text-center align-middle background-table">Registrado en</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                  </tr>';

                $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)) {

                    $datos=$ver[0]."||".
                           $ver[1]."||".
                           $ver[2]."||".
                           $ver[3];

                    $sql1 ="select sum(cantidad) as cantidad from
                            total_alumnos_programa_posgrado";
                    $result1 = mysqli_query($conexion,$sql1);
                    $ver1 = mysqli_fetch_row($result1);

                    $porcentaje = ($ver[2]*100)/$ver1[0];
                    $porcentaje = round($porcentaje);


                    $salida.='<tr>
                        <td>'.$ver[1].'</td>
                        <td>'. $ver[2] .'</td>
                        <td>'. $porcentaje .'</td>
                        <td>'. $ver[3].'</td>
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform(\''.$datos.'\')"><i
                                        class="far fa-edit"></i> Editar </button>
                            <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\''.$ver[0].'\')"><i class="fas fa-trash"></i> Eliminar</button>
                        </td>
                    </tr>';
                }
                $salida.="<tr style=' font-weight: bold'>
                           <td>Total</td>";

                    $sql1 ="select sum(cantidad) as cantidad from
                            total_alumnos_programa_posgrado";

                    $result1 = mysqli_query($conexion,$sql1);
                    $ver1 = mysqli_fetch_row($result1);

                    $salida.="<td> $ver1[0]</td>";
                    $salida.="<td>100%</td>";

                $salida.="</tr>";


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
    </div>
        </div>
</div>

    <?php
}

}

$stmt->close();
$conexion->close();

?>