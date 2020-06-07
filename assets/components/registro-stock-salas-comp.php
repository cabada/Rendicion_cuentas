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

$tablaRequerida = 'stock_salas_comp';

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
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Stock_Comp/reportePDF.php';
                                document.reporte.submit()" />

                                <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Stock_Comp/reporteExcel.php';
                                document.reporte.submit()" />
                            </div>

                            <!--Select de año-->
                            <div class="col d-flex justify-content-end">
                                <select class="form-control col-md-5 anio" id="anio-select" name="anio-select">
                                    <option>Buscar por año</option>
                                    <?php
                                    $query = "select distinct year(fecha_creado) as fecha_creado from stock_salas_comp order by fecha_creado desc";
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
                                $sql="select stock_salas_comp.id_stock_comp,
                                area_academica.nombre_area_academica,
                                stock_salas_comp.sala,
                                stock_salas_comp.numero_comp,
                                stock_salas_comp.total_comp
                                from stock_salas_comp
                                join area_academica
                                on area_academica.id_area_academica = stock_salas_comp.id_area_academica";

                                if(isset($_POST['consulta'])) {

             $q = $conexion->real_escape_string($_POST['consulta']);
             $_SESSION['consulta'] = $q;
                                             $sql="select stock_salas_comp.id_stock_comp,
                                area_academica.nombre_area_academica,
                                stock_salas_comp.sala,
                                stock_salas_comp.numero_comp,
                                stock_salas_comp.total_comp
                                from stock_salas_comp
                                join area_academica
                                on area_academica.id_area_academica = stock_salas_comp.id_area_academica
                                where area_academica.nombre_area_academica like '%$q%'";

if (isset($_POST['consulta_anio'])) {
                 /*variable goblal*/
                 $p = $_SESSION['consulta_anio'];
                                                               $sql="select stock_salas_comp.id_stock_comp,
                                area_academica.nombre_area_academica,
                                stock_salas_comp.sala,
                                stock_salas_comp.numero_comp,
                                stock_salas_comp.total_comp
                                from stock_salas_comp
                                join area_academica
                                on area_academica.id_area_academica = stock_salas_comp.id_area_academica
                                where area_academica.nombre_area_academica like '%$q%'
                                and  stock_salas_comp.fecha_creado like '%$p%'";
  }
}
                                /*Query para consultas del buscador*/

            if(isset($_POST['consulta_anio'])){
                $q = $conexion->real_escape_string($_POST['consulta_anio']);
                /*Variable global*/
                if($_POST['consulta_anio']!='Todos los registros'){
                $_SESSION['consulta_anio']=$q;

                                $sql="select stock_salas_comp.id_stock_comp,
                                area_academica.nombre_area_academica,
                                stock_salas_comp.sala,
                                stock_salas_comp.numero_comp,
                                stock_salas_comp.total_comp
                                from stock_salas_comp
                                join area_academica
                                on area_academica.id_area_academica = stock_salas_comp.id_area_academica
                                where stock_salas_comp.fecha_creado  like '%$q%'";
                                }
                else{
                                                $sql="select stock_salas_comp.id_stock_comp,
                                area_academica.nombre_area_academica,
                                stock_salas_comp.sala,
                                stock_salas_comp.numero_comp,
                                stock_salas_comp.total_comp
                                from stock_salas_comp
                                join area_academica
                                on area_academica.id_area_academica = stock_salas_comp.id_area_academica";
                }
                }
 $resultado = $conexion->query($sql);
            if ($resultado->num_rows>0){
            $salida.='<table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2" id="tabla-php">
                <tr>
                    <td class="text-center align-middle background-table">Área Académica</td>
                    <td class="text-center align-middle background-table">No. de Salas con Computadoras</td>
                    <td class="text-center align-middle background-table">No. de Computadoras por Sala</td>
                    <td class="text-center align-middle background-table">Total de Computadoras</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>';

                     $result=mysqli_query($conexion,$sql);
                     while ($ver=mysqli_fetch_row($result)){

                     $datos=$ver[0]."||".
                            $ver[1]."||".
                            $ver[2]."||".
                            $ver[3]."||".
                            $ver[4];

                $salida.='<tr>
                    <td> '.utf8_encode($ver[1]).'</td>
                    <td> '.$ver[2].'</td>
                    <td>'. $ver[3].'</td>
                    <td>'. $ver[4].'</td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform(\''.$datos.'\')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\''.$ver[0].'\')"><i class="fas fa-trash" ></i>  Eliminar</button>
                    </td>
                </tr>';
                     }

               $salida.=" <tr style='font-weight: bold'>
                    <td>Total</td>";

                    $sql = "select sum(sala) as sala from stock_salas_comp";
                    $result = mysqli_query($conexion,$sql);
                    $ver = mysqli_fetch_row($result);

                    $salida.="<td> $ver[0]</td>";
                    $salida.="<td></td>";
                    $sql = "select sum(total_comp) as total from stock_salas_comp";
                    $result = mysqli_query($conexion,$sql);
                    $ver = mysqli_fetch_row($result);

                    $salida.="<td> $ver[0]</td>";


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