<?php

    function conexion(){
        $servidor="localhost";
        $usuario="root";
        $password="";
        $bd="rendicion_cuentas";

        $conexion=mysqli_connect($servidor,$usuario,$password,$bd);

        return $conexion;
    }

   if(conexion()) {
        echo "conectado";
    }else{
        echo "no conectado";
    }

    ?>

