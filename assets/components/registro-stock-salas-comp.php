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

$tablaRequerida = 'stock_salas_comp';

if($resultado == $tablaRequerida){

?>
<div class="row">
    <div class="col-sm-12">
        <h2>Registro de Aulas Equipadas con Equipo Informático por Carrera</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Área Académica</td>
                    <td class="text-center align-middle background-table">No. de Salas con Computadoras</td>
                    <td class="text-center align-middle background-table">No. de Computadoras por Sala</td>
                    <td class="text-center align-middle background-table">Total de Computadoras</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>
                 <?php
                    $sql="select stock_salas_comp.id_stock_comp,
                                area_academica.nombre_area_academica,
                                stock_salas_comp.sala,
                                stock_salas_comp.numero_comp,
                                stock_salas_comp.total_comp
                                from stock_salas_comp
                                join area_academica
                                on area_academica.id_area_academica = stock_salas_comp.id_area_academica";
                     $result=mysqli_query($conexion,$sql);
                     while ($ver=mysqli_fetch_row($result)){

                     $datos=$ver[0]."||".
                            $ver[1]."||".
                            $ver[2]."||".
                            $ver[3]."||".
                            $ver[4];
        ?>

                <tr>
                    <td><?php echo $ver[1]?></td>
                    <td><?php echo $ver[2]?></td>
                    <td><?php echo $ver[3]?></td>
                    <td><?php echo $ver[4]?></td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo ver[0]?>')"><i class="fas fa-trash" ></i>  Eliminar</button>
                    </td>
                </tr>
                         <?php
                     }
                 ?>
                <tr style="font-weight: bold">
                    <td>Total</td>
                    <td></td>
                    <td></td>
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