<?php

require_once "PHP_Consultas/Conexion.php";
$conexion = conexion();

?>

<div class="row">
    <div class="col-sm-12">
        <h2>Registro de Roles</h2>
        <caption>
            <button class="btn btn-main" data-toggle="modal" data-target="#new-modal">Agregar registro  <i class="fas fa-plus"></i></button>
        </caption>
        <div class="table-responsive-xl">
            <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre de Rol</td>
                    <td class="text-center align-middle background-table">Permisos</td>
                    <td class="text-center align-middle background-table">Tablas de Acceso</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>
                <?php
                $query = "select distinct roles.id_rol,
                                    roles.nombre_rol,
                                    operaciones.nombre_operacion,
                                    modulo.nombre_modulo 
                                    from roles
                                    join rol_operacion
                                    on roles.id_rol=rol_operacion.id_rol
                                    join operaciones
                                    on operaciones.id_operaciones=rol_operacion.id_operacion
                                    join modulo
                                    on modulo.id_modulo = operaciones.id_modulo";
                $resultado = mysqli_query($conexion,$query);

                while($fila = mysqli_fetch_array($resultado)){
                    $valor = $fila['nombre_modulo'];

                ?>


                    <tr>
                        <td><?php echo "<label>".$fila[1]."</label>"?></td>
                        <td><?php echo "<label>".$fila[2]."</label>"?></td>
                        <td><?php echo "<label>".$fila['nombre_modulo']."</label>"?></td>
                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" <!--onclick="agregaform('<?php /*echo $datos */?>')"--><i class="far fa-edit"></i>  Editar</button>
                            <button class="btn btn-sm btn-danger" <!--onclick="preguntarSiNo('<?php /*echo $buscar[0]*/?>')"--><i class="fas fa-trash" ></i>  Eliminar</button>
                        </td>
                    </tr>
                   <?php
               }
                ?>
            </table>
        </div>

    </div>
</div>
