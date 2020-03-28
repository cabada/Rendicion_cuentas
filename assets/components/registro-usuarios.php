<?php

require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de Usuarios</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre</td>
                    <td class="text-center align-middle background-table">Apellido</td>
                    <td class="text-center align-middle background-table">Email</td>
                    <td class="text-center align-middle background-table">Rol</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>
                <?php
                $sql="select usuarios.id_usuario,
                            usuarios.nombre_usuario,
                            usuarios.apellido_usuario,
                            usuarios.email_usuario,
                            roles.nombre_Rol
                            from usuarios
                            join roles on usuarios.id_Rol_Usuario=roles.id_Rol";
                $result=mysqli_query($conexion,$sql);

                while($buscar=mysqli_fetch_row($result)){

                    $datos=$buscar[0]."||".
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
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos ?>')"><i class="far fa-edit"></i>  Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="preguntarSiNo('<?php echo $buscar[0]?>')"><i class="fas fa-trash" ></i>  Eliminar</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>

    </div>
</div>
