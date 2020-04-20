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

$tablaRequerida = 'equipo_maestros_itcj';

if($resultado == $tablaRequerida){

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro equipo de maestros ITCJ</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de docente</td>
                    <td class="text-center align-middle background-table">Categoría</td>
                    <td class="text-center align-middle background-table">Grado de estudios</td>
                    <td class="text-center align-middle background-table">SNI</td>
                    <td class="text-center align-middle background-table">Área de especialización</td>
                    <td class="text-center align-middle background-table">Experiencia profesional</td>
                    <td class="text-center align-middle background-table">Experiencia docente</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>

                <?php

                $sql="select id_equipo_maestros_itcj,nombre_docente,categoria_hora,grado_estudios,sni,area_especializacion,
                experiencia_profesional,experiencia_docente from equipo_maestros_itcj";

                $resultado = mysqli_query($conexion,$sql);

                while($buscar=mysqli_fetch_row($resultado)) {

                $datos = $buscar[0]."||".
                    $buscar[1]."||".
                    $buscar[2]."||".
                    $buscar[3]."||".
                    $buscar[4]."||".
                    $buscar[5]."||".
                    $buscar[6]."||".
                    $buscar[7];

                ?>

                <tr>
                    <td><?php echo $buscar[1]?></td>
                    <td><?php echo $buscar[2]?></td>
                    <td><?php echo $buscar[3]?></td>
                    <td><?php echo $buscar[4]?></td>
                    <td><?php echo $buscar[5]?></td>
                    <td><?php echo $buscar[6]?></td>
                    <td><?php echo $buscar[7]?></td>
                    <td class="text-center align-middle">
                    <td class="centered-table-title"><button class="btn btn-warning" onclick="agregaform('<?php echo $datos?>')" data-toggle="modal" data-target="#modalEdicion"><i class="far fa-edit"></i></button></td>
                    <td class="centered-table-title"><button class="btn btn-danger" onclick="preguntarSiNo('<?php echo $buscar[0]?>')"><i class="far fa-window-close"></i></button></td>
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