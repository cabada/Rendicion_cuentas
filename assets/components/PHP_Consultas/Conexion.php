<?php

function conexion()
{
    $servidor = "localhost";
    $usuario = "root";
    $bd = "rendicion_cuentas_temporal";
    $password = "mysql";

    $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

    return $conexion;

}


?>
