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

if(!conexion()){
    echo "No se conecto con la base de datos!";
}
else{
    echo "Se conecto con la base de datos!";
}

?>
