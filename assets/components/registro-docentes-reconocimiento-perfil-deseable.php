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

$tablaRequerida = 'profesores_perfil';

if($resultado == $tablaRequerida){

?>



<div class="row">
    <div class="col-sm-12">
        <h2>Registro de docentes con reconocimiento perfil deseable</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Docente</td>
                    <td class="text-center align-middle background-table">Área adscripción</td>
                    <td class="text-center align-middle background-table">Vigencia</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php
                $sql="select profesores.id_profesor,
                            profesores.nombre_completo,
                            area_academica.nombre_area_academica,
                            profesores.vigencia
                            from profesores
                            join area_academica
                            on area_academica.id_area_academica = profesores.id_area_academica
                            where profesores.id_categoria_profesores = 2";

                $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)){

                $datos=$ver[0]."||".
                    $ver[1]."||".
                    $ver[2]."||".
                    $ver[3];
                ?>

                    <tr>
                        <td><?php echo $ver[1]?></td>
                        <td><?php echo $ver[2]?></td>
                        <td><?php echo $ver[3]?></td>
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"><i class="far fa-edit"></i>  Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $ver[0] ?>')"><i class="fas fa-trash"></i> Eliminar</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
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