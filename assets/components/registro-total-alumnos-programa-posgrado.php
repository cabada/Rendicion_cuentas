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

$tablaRequerida = 'total_alumnos_programa_posgrado';

if($resultado == $tablaRequerida){

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro total de alumnos de programa posgrado</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de programa</td>
                    <td class="text-center align-middle background-table">Cantidad</td>
                    <td class="text-center align-middle background-table">Porcentaje</td>
                    <td class="text-center align-middle background-table">Registrado en</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php
                $sql="select ID_TOTAL_PROG_POSGRADO,PROGRAMA,CANTIDAD,REGISTRADO_EN
                    from total_alumnos_programa_posgrado";
                $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)) {

                    $datos=$ver[0]."||".
                           $ver[1]."||".
                           $ver[2]."||".
                           $ver[3];

                    $sql1="select sum(CANTIDAD) as cantidad
                    from total_alumnos_programa_posgrado";
                    $result1=mysqli_query($conexion,$sql1);
                    $ver1=mysqli_fetch_row($result1);

                    $porcentaje = ($ver[2]*100)/$ver1[0];
                    $porcentaje=round($porcentaje);

                    ?>

                    <tr>
                        <td><?php echo $ver[1] ?></td>
                        <td><?php echo $ver[2] ?></td>
                        <td><?php echo $porcentaje ?>%</td>
                        <td><?php echo $ver[3] ?></td>
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"><i
                                        class="far fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $ver[0] ?>')"><i class="fas fa-trash"></i> Eliminar</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr style="font-weight: bold;">
                    <td>Total</td>
                    <?php
                    $sql="select sum(CANTIDAD) as cantidad
                    from total_alumnos_programa_posgrado";
                    $result=mysqli_query($conexion,$sql);
                    $ver=mysqli_fetch_row($result);
                    ?>
                    <td><?php echo $ver[0]?></td>
                    <td>100%</td>
                    <td></td>
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