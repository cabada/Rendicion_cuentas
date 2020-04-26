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

$tablaRequerida = 'periodo_docentes_capacitados';

if($resultado == $tablaRequerida){

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro periodo de docentes capacitados</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Tipo de Nombramiento</td>
                    <td class="text-center align-middle background-table">Total de docentes</td>
                    <td class="text-center align-middle background-table">No. de docentes capacitados</td>
                    <td class="text-center align-middle background-table">Porcentaje de docentes capacitados</td>
                    <td class="text-center align-middle background-table">Periodo</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php
                $sql="select id_periodo_docentes_capacitados,
                            tipo_nombramiento,
                            total_docentes,
                            no_docentes_capacitados,
                            porcentaje_docentes_capacitados,
                            periodo
                            from periodo_docentes_capacitados";

                $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)){

                $datos=$ver[0]."||".
                    $ver[1]."||".
                    $ver[2]."||".
                    $ver[3]."||".
                    $ver[4]."||".
                    $ver[5];
                ?>

                <tr>
                    <td><?php echo $ver[1]?></td>
                    <td><?php echo $ver[2]?></td>
                    <td><?php echo $ver[3]?></td>
                    <td><?php echo $ver[4]?></td>
                    <td><?php echo $ver[5]?></td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $ver[0] ?>')"><i class="fas fa-trash"></i> Eliminar</button>
                    </td>
                </tr>
                    <?php
                }
                ?>
                <tr style="font-weight: bold">
                    <td>Total Enero</td>
                    <?php
                    $sql="select sum(total_docentes) as tota_docentes from periodo_docentes_capacitados where periodo='Enero'";

                    $resultado = mysqli_query($conexion,$sql);

                    $buscar=mysqli_fetch_row($resultado);
                    ?>
                    <td><?php echo $buscar[0]?></td>
                    <?php
                    $sql1="select sum(no_docentes_capacitados) as docentes_capacitados from periodo_docentes_capacitados where periodo='Enero'";

                    $resultado1 = mysqli_query($conexion,$sql1);

                    $buscar1=mysqli_fetch_row($resultado1);
                    ?>
                    <td><?php echo $buscar1[0]?></td>
                    <?php

                    if(isset($buscar[0])){
                        $porcentaje= ($buscar1[0]*100)/$buscar[0];
                        $porcentaje = round($porcentaje);

                    }
                    else{
                        $porcentaje=0;
                    }

                    ?>
                    <td><?php echo $porcentaje?>%</td>
                </tr>
                <tr style="font-weight: bold">
                    <td>Total Junio</td>
                    <?php
                    $sql="select sum(total_docentes) as tota_docentes from periodo_docentes_capacitados where periodo='Junio'";

                    $resultado = mysqli_query($conexion,$sql);

                    $buscar=mysqli_fetch_row($resultado);
                    ?>
                    <td><?php echo $buscar[0]?></td>
                    <?php
                    $sql1="select sum(no_docentes_capacitados) as docentes_capacitados from periodo_docentes_capacitados where periodo='Junio'";

                    $resultado1 = mysqli_query($conexion,$sql1);

                    $buscar1=mysqli_fetch_row($resultado1);
                    ?>
                    <td><?php echo $buscar1[0]?></td>
                    <?php

                    if(isset($buscar[0])){
                        $porcentaje= ($buscar1[0]*100)/$buscar[0];
                        $porcentaje = round($porcentaje);

                    }
                    else{
                        $porcentaje=0;
                    }



                    ?>
                    <td><?php echo $porcentaje?>%</td>
                </tr>
            </table>
        </div>
    </div>
</div>

    <?php
}


}

$stmt->close();
$conexion->close();



?>
