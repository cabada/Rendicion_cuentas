<?php

require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de tutorias</h2>
        <caption>
            <button class="btn btn-page-theme-2" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <br>
        <table class="table table-hover table-condensed table-bordered table-striped white-background">
            <br>
            <tr>
                <td class="centered-table-title">Tutores registrados</td>
                <td class="centered-table-title">Cantidad de alumnos grupal</td>
                <td class="centered-table-title">Cantidad de encuentro con padres</td>
                <td class="centered-table-title">Cantidad de confererencias a alumnos</td>
                <td class="centered-table-title">Cantidad de alumnos en conferencia</td>
                <td class="centered-table-title">Editar</td>
                <td class="centered-table-title">Eliminar</td>
            </tr>

            <?php
            $sql="select id_tutorias,tutores_registrados, alumnos_tuto_grupal,encuentro_padres,conferencias_alumnos,
            alumnos_asistieron_conferencias from tutorias";

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
                <td class="centered-table-title"><button class="btn btn-warning"  data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"><i class="far fa-edit"></i></button></td>
                <td class="centered-table-title"><button class="btn btn-danger" onclick="preguntarSiNo('<?php echo $ver[0] ?>')"><i class="far fa-window-close"></i></button></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>