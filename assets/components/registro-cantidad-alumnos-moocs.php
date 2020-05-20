<?php

require "PHP_Consultas/Conexion.php";
require_once "PHP_Consultas/Usuarios/Verificar_Tablas_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$stmt = consultaTablas($conn,$id_usuario);

$stmt->execute();

$stmt->bind_result($resultado);

while($stmt->fetch()){

$tablaRequerida = 'moocs_alumnos';

if($resultado == $tablaRequerida){

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de cantidad de alumnos en cursos de moocs</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de curso</td>
                    <td class="text-center align-middle background-table">Cantidad de alumnos inscritos</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>
                <?php
                $sql="select id_moocs_alumnos,cursos_mooc,numero_alumnos_inscritos
                            from moocs_alumnos";

                $result=mysqli_query($conexion,$sql);

                while($buscar=mysqli_fetch_row($result)){

                    $datos=$buscar[0]."||".
                        $buscar[1]."||".
                        $buscar[2];
                    ?>

                    <tr>
                        <td><?php echo $buscar[1]?></td>
                        <td><?php echo $buscar[2]?></td>

                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"><i class="far fa-edit"></i>  Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $buscar[0]?>')"><i class="fas fa-trash" ></i>  Eliminar</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr style="font-weight: bold">
                    <td>Total</td>
                    <?php
                     $sql="select sum(numero_alumnos_inscritos) as alumnos_inscritos
                            from moocs_alumnos";

                     $result=mysqli_query($conexion,$sql);

                     $buscar=mysqli_fetch_row($result);
                    ?>
                    <td><?php echo $buscar[0]?></td>

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
