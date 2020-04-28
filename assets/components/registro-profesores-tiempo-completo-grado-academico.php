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

$tablaRequerida = 'profesores_tiempo_completo';

if($resultado == $tablaRequerida){

?>


<div class="row">
    <div class="col-sm-12">
        <h2>Registro de profesores de tiempo completo por grado académico</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Grado</td>
                    <td class="text-center align-middle background-table">Mujer</td>
                    <td class="text-center align-middle background-table">Hombre</td>
                    <td class="text-center align-middle background-table">Total</td>
                    <td class="text-center align-middle background-table">Porcentaje</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php

                $sql="select id_prof_tiemp_comp,grado,mujer,hombre,total from profesores_tiempo_completo";

                $resultado = mysqli_query($conexion,$sql);

                while($buscar=mysqli_fetch_row($resultado)) {

                $datos = $buscar[0]."||".
                    $buscar[1]."||".
                    $buscar[2]."||".
                    $buscar[3]."||".
                    $buscar[4];

                ?>

                <tr>
                    <td><?php echo $buscar[1]?></td>
                    <td><?php echo $buscar[2]?></td>
                    <td><?php echo $buscar[3]?></td>
                    <td><?php echo $buscar[4]?></td>
                    <?php
                    $sql1="select sum(total) as total from profesores_tiempo_completo";

                    $resultado1 = mysqli_query($conexion,$sql1);

                    $buscar1=mysqli_fetch_row($resultado1);

                    $total = $buscar1[0];

                    $porcentaje = ($buscar[4] * 100)/$total;
                    $porcentaje = round($porcentaje);



                    ?>


                    <td><?php echo $porcentaje?>%</td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos?>')"><i class="far fa-edit" ></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $buscar[0]?>')"><i class="fas fa-trash" ></i>  Eliminar</button>
                    </td>
                </tr>

                    <?php

                }
                ?>
                <tr style="font-weight: bold">
                    <td>Total</td>
                    <?php
                     $sql="select sum(mujer) as mujer from profesores_tiempo_completo";

                     $resultado = mysqli_query($conexion,$sql);

                     $buscar=mysqli_fetch_row($resultado);
                    ?>
                    <td><?php echo $buscar[0]; ?></td>
                    <?php
                    $sql="select sum(hombre) as hombre from profesores_tiempo_completo";

                    $resultado = mysqli_query($conexion,$sql);

                    $buscar=mysqli_fetch_row($resultado);
                    ?>

                    <td><?php echo $buscar[0]; ?></td>
                    <?php
                    $sql="select sum(total) as total from profesores_tiempo_completo";

                    $resultado = mysqli_query($conexion,$sql);

                    $buscar=mysqli_fetch_row($resultado);
                    ?>

                    <td><?php echo $buscar[0]; ?></td>

                    <td>100%</td>
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