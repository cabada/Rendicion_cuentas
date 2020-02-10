<?php


function conexion()
{
    $servidor = "localhost";
    $usuario = "root";
    $bd = "rendimiento_cuentas";
    $password = "mysql";

    $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

    return $conexion;


}


?>
