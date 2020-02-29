<?php

require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro OrientaTec</h2>
        <caption>
            <button class="btn btn-page-theme-2" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <br>
        <table class="table table-hover table-condensed table-bordered table-striped white-background">
            <br>
            <tr>
                <td class="centered-table-title">Nombre de preparatoria</td>
                <td class="centered-table-title">Fecha</td>
                <td class="centered-table-title">Cantidad de estudiantes atendidos</td>
                <td class="centered-table-title">Editar</td>
                <td class="centered-table-title">Eliminar</td>
            </tr>

            <?php

              $sql="select ID_ORIENTATEC,nombre_preparatoria,fecha,estudiantes_atendidos 
                       from orientatec";
              $result=mysqli_query($conexion,$sql);
              while($ver=mysqli_fetch_row($result)){

                  $datos=$ver[0]."||".
                         $ver[1]."||".
                         $ver[2]."||".
                         $ver[3];

            ?>

            <tr>
                <td><?php echo $ver[1] ?></td>
                <td><?php echo $ver[2] ?></td>
                <td><?php echo $ver[3] ?></td>
                <td class="centered-table-title"><button class="btn btn-warning"  data-toggle="modal" data-target="#modalEdicion" onclick="agregaForm('<?php echo $datos ?>')"><i class="far fa-edit"></i></button></td>
                <td class="centered-table-title"><button class="btn btn-danger"><i class="far fa-window-close"></i></button></td>
            </tr>

            <?php
              }
            ?>

        </table>
    </div>
</div>