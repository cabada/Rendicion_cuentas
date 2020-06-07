<?php

require_once "PHP_Consultas/Conexion.php";
require_once "PHP_Consultas/Usuarios/Verificar_Rol_Usuario.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$stmt = consultaRol($conn,$id_usuario);


$stmt->execute();


$stmt->bind_result($resultado);

while($stmt->fetch()){

    $rol = 'Administrador';

    if($resultado == $rol){

        ?>

        <div class="row">
            <div class="col-sm-12">
                <h2>Bitacora de Transacciones</h2>

                <div class="table-responsive-xl">
                    <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                        <tr>
                            <td class="text-center align-middle background-table">Operacion</td>
                            <td class="text-center align-middle background-table">Hora de la Operacion</td>
                            <td class="text-center align-middle background-table">Nombre de la Tabla</td>
                        </tr>
                        <?php


                        $query = "select operacion,hora_operacion,nombre_de_tabla from bitacora";
                        $resultado = mysqli_query($conexion,$query);

                        while($fila = mysqli_fetch_array($resultado)){
                            $datos= $fila[0]."||".
                                $fila[1]."||".
                                $fila[2];


                            ?>

                            <tr>

                                <td><?php echo $fila[0]?></td>


                                <td><?php echo $fila[1]?> </td>

                              <td><?php echo $fila[2]?></td>

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
