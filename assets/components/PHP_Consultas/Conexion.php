<?php

function conexion()
{
    $servidor = "localhost";
    $usuario = "root";
    $bd = "rendicion_cuentas";
    $password = "";

    $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

    return $conexion;

}


?>
