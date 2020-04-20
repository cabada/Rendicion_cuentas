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

$tablaRequerida = 'cuerpos_academicos';

if($resultado == $tablaRequerida){

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de cuerpos académicos</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Area académica</td>
                    <td class="text-center align-middle background-table">Nombre de cuerpo académico</td>
                    <td class="text-center align-middle background-table">Grado</td>
                    <td class="text-center align-middle background-table">Estado</td>
                    <td class="text-center align-middle background-table">Año de registro</td>
                    <td class="text-center align-middle background-table">Fecha de vigencia</td>
                    <td class="text-center align-middle background-table">Área</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php
                $sql="select 
                      cuerpos_academicos.id_cuerpo_academico,
                      area_academica.id_area_academica,
                      cuerpos_academicos.nombre_cuerpo_academico,
                      cuerpos_academicos.grado,
                      cuerpos_academicos.estado,
                      cuerpos_academicos.anio_registro,
                      cuerpos_academicos.vigencia,
                      cuerpos_academicos.AREA
                      from area_academica
                      right join cuerpos_academicos on area_academica.ID_AREA_ACADEMICA = cuerpos_academicos.ID_AREA_ACADEMICA";
                $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)){

                    $datos=$ver[0]."||".
                           $ver[1]."||".
                           $ver[2]."||".
                           $ver[3]."||".
                           $ver[4]."||".
                           $ver[5]."||".
                           $ver[6]."||".
                           $ver[7];
                ?>

                <tr>
                    <td><?php echo $ver[1]?></td>
                    <td><?php echo $ver[2]?></td>
                    <td><?php echo $ver[3]?></td>
                    <td><?php echo $ver[4]?></td>
                    <td><?php echo $ver[5]?></td>
                    <td><?php echo $ver[6]?></td>
                    <td><?php echo $ver[7]?></td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $ver[0]?>')"><i class="fas fa-trash"></i>  Eliminar</button>
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