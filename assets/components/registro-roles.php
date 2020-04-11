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

                //Primerso se verifican los datos de todas las tablas relacionadas, si tienen datos relacionados o no

                $query = "select distinct roles.id_rol,
                                    roles.nombre_rol 
                                    from roles
                                    join rol_operacion
                                    on roles.id_rol=rol_operacion.id_rol
                                    join operaciones
                                    on operaciones.id_operaciones=rol_operacion.id_operacion
                                    join modulo
                                    on modulo.id_modulo = operaciones.id_modulo
                                    ORDER BY
                                    roles.id_rol asc";
                $resultado = mysqli_query($conexion,$query);


                //Primer Ciclo

                //Cuando encuentre registros, va a hacer ciclos hasta que no encuentre registros
               while($fila = mysqli_fetch_array($resultado)){
                   $datos= $fila[0]."||".
                            $fila[1];
                    //Se le asigna el valor de la columna de la fila que esta actualmente ciclando
                    $nombre_rol = $fila['nombre_rol'];
                    $query = "select distinct operaciones.nombre_operacion
                                              from operaciones
                                              join rol_operacion
                                              on operaciones.id_operaciones=rol_operacion.id_operacion
                                              join roles
                                              on roles.id_rol=rol_operacion.id_rol
                                              where nombre_rol='$nombre_rol'";
                   $operaciones = mysqli_query($conexion,$query);

                ?>

                    <tr>
<!--                         Se le asigna el nombre de rol al label-->
                        <td><?php echo "<label>".$nombre_rol."</label>"?></td>


<!--                        Se hace un ciclo para capturar las operaciones que tiene dicho rol que se hace con la ultima query-->
                        <td>

                            <?php
                            $filaOp = array();
                            while($filaOperaciones = mysqli_fetch_array($operaciones)){

                            echo "<label>".$filaOperaciones['nombre_operacion']."</label><br>";



                               array_push($filaOp,$filaOperaciones['nombre_operacion']);


                        }

                         $filaOp = implode(",",$filaOp);

                        ?></td>

                        <?php

                        $query = "select distinct modulo.id_modulo,
                                                modulo.nombre_modulo
                                              from modulo
                                              join operaciones
                                              on modulo.id_modulo=operaciones.id_modulo
                                              join rol_operacion
                                              on operaciones.id_operaciones=rol_operacion.id_operacion
                                              join roles
                                              on roles.id_rol=rol_operacion.id_rol
                                              where nombre_rol='$nombre_rol'";
                        $modulos = mysqli_query($conexion,$query);

                        ?>

<!--                     Se hace un ciclo para capturar las operaciones que tiene dicho rol que se hace con la ultima query-->
                        <td><?php  $filaMod = array();
                            while($filaModulos = mysqli_fetch_array($modulos)){
                                echo "<label>".$filaModulos['nombre_modulo']."</label><br>";

                                array_push($filaMod,$filaModulos['id_modulo']);

                            }
                            $filaMod = implode(",",$filaMod);

                                ?></td>

                        <td class="text-center align-middle">
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $datos?>','<?php echo $filaOp?>','<?php echo $filaMod?>')"><i class="far fa-edit"></i>  Editar</button>
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