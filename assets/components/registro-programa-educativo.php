<?php
require_once "PHP_Consultas/Conexion.php";
require_once "PHP_Consultas/Usuarios/Verificar_Tablas_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$stmt = consultaTablas($conn,$id_usuario);
$stmt->execute();
$stmt->bind_result($resultado);

while($stmt->fetch()){
    $tablaRequerida = 'programa_educativo';
    if($resultado == $tablaRequerida){
        ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive-xl">
                    <?php
                    $salida = "";
                    $sql="SELECT 
                    programa_educativo.id_programa_educativo,
                    carreras.nombre_carrera,
                    programa_educativo.modalidad,
                    programa_educativo.nuevo_ingreso,
                    programa_educativo.reingreso,
                    programa_educativo.estatus,
                    programa_educativo.periodo 
                    FROM carreras 
                    RIGHT JOIN programa_educativo ON carreras.id_carrera = programa_educativo.id_carrera";

                    if (isset($_POST['consulta'])) {
                        $q = $conexion->real_escape_string($_POST['consulta']);
                        $sql="SELECT 
                        programa_educativo.id_programa_educativo,
                        carreras.nombre_carrera,
                        programa_educativo.modalidad,
                        programa_educativo.nuevo_ingreso,
                        programa_educativo.reingreso,
                        programa_educativo.estatus,
                        programa_educativo.periodo 
                        FROM carreras 
                        RIGHT JOIN programa_educativo ON carreras.id_carrera = programa_educativo.id_carrera WHERE carreras.nombre_carrera LIKE '%$q%'";
                    }

                    $resultado = $conexion->query($sql);
                    if ($resultado->num_rows>0) {
                        $salida.='<table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                        <tr>
                            <td class="text-center align-middle background-table">Carrera</td>
                            <td class="text-center align-middle background-table">Modalidad</td>
                            <td class="text-center align-middle background-table">Nuevo ingreso</td>
                            <td class="text-center align-middle background-table">Reingreso</td>
                            <td class="text-center align-middle background-table">Estatus</td>
                            <td class="text-center align-middle background-table">Periodo</td>
                            <td class="text-center align-middle background-table">Total</td>
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
                                $buscar[6];


                            $suma = $buscar[3]+$buscar[4];
                            $salida.='<tr class="tablasuma">
                                    <td>'.$buscar[1].'</td>
                                    <td>'.$buscar[2].'</td>
                                    <td>'.$buscar[3].'</td>
                                    <td>'.$buscar[4].'</td>
                                    <td>'.$buscar[5].'</td>
                                    <td>'.$buscar[6].'</td>
                                    <td class="tdsuma">'.$suma.'</td>
                                    <td class="text-center align-middle">
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion"  onclick="agregaForm(\''.$datos.'\')" ><i class="far fa-edit"></i>  Editar</button>
                                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\''.$buscar[0].'\')"><i class="fas fa-trash"></i>  Eliminar</button>
                                    </td>
                                </tr>';
                        }

                        $salida.="<tr style='font-weight: bold'>

                                    <td>Total</td>";
                        $sql = "select sum(nuevo_ingreso) as nuevo_ingreso from programa_educativo";
                        $resultado = $conexion->query($sql);
                        $buscar = mysqli_fetch_row($resultado);
                           $salida.="<td></td>
                                    <td>$buscar[0]</td>";
                        $sql = "select sum(reingreso) as reingreso from programa_educativo";
                        $resultado = $conexion->query($sql);
                        $buscar = mysqli_fetch_row($resultado);
                                    $salida.="<td>$buscar[0]</td>
                                    <td></td>
                                    <td></td>";
                        $sql = "select sum(total) as total from programa_educativo";
                        $resultado = $conexion->query($sql);
                        $buscar = mysqli_fetch_row($resultado);

                                    $salida.="<td>$buscar[0]</td>";

                                  $salida.="</tr>";
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