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

$tablaRequerida = 'permanencia';

if($resultado == $tablaRequerida){

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de programa permanencia</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de programa</td>
                    <td class="text-center align-middle background-table">Porcentaje</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php
                $sql="select 
                            permanencia.ID_PERMANENCIA,
                            carreras.nombre_CARRERA,
                            permanencia.PORCENTAJE 
                            from carreras
                            right join permanencia on carreras.ID_CARRERA = permanencia.ID_CARRERA";
                $result=mysqli_query($conexion,$sql);
                while ($ver=mysqli_fetch_row($result)){

                    $datos=$ver[0]."||".
                           $ver[1]."||".
                           $ver[2];
                ?>

                <tr>
                    <td><?php echo utf8_encode($ver[1])?></td>
                    <td><?php echo $ver[2]?>%</td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $ver[0] ?>')"><i class="fas fa-trash"></i>  Eliminar</button>
                    </td>
                </tr>
                <?php
                }
                ?>
                <tr style="font-weight: bold">
                    <td>Promedio Total</td>
                    <?php
                    $sql="select round(avg(porcentaje),2) as porcentaje 
                            from permanencia";
                    $result=mysqli_query($conexion,$sql);
                     $ver=mysqli_fetch_row($result);
                    ?>

                    <td><?php echo $ver[0] ?>%</td>

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