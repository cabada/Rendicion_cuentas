<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


    require_once "../Conexion.php";
    $conexion=conexion();

    $nombre_rol=$_POST['nombre_rol'];
    $modulo=$_POST['modulo'];
    $permiso=$_POST['permiso'];


    $stmt = $conexion->prepare("insert into roles(nombre_rol) values (?)");
    $stmt->bind_param("s", $nombre_rol);

    echo $resultado = $stmt->execute();

    $query = "select id_rol from roles where nombre_rol='$nombre_rol'";
    $resultado = mysqli_query($conexion,$query);
    $fila = mysqli_fetch_assoc($resultado);

    $id_rol = $fila['id_rol'];

    //Se saca el largo del arreglo y se guarda en una variable, en este caso de los arreglos de
    //permiso y de modulo
    $arrPerm = count($permiso);
    $arrMod = count($modulo);

    for($i = 0; $i < $arrPerm; $i++){

        (string)$perm = $permiso[$i];

        for($j = 0;$j < $arrMod; $j++){

           $mod = $modulo[$j];


            $stmt = $conexion->prepare("insert into operaciones(nombre_operacion,id_modulo) values (?,?)");
            $stmt->bind_param("si", $perm,$mod);
            $stmt->execute();

            $query = "select id_operaciones from operaciones where nombre_operacion='$perm' and id_modulo='$mod'";
            $resultado = mysqli_query($conexion,$query);
            $fila = mysqli_fetch_assoc($resultado);

            $id_operaciones = $fila['id_operaciones'];


            $stmt = $conexion->prepare("insert into rol_operacion(id_rol,id_operacion) values (?,?)");
            $stmt->bind_param("ii", $id_rol,$id_operaciones);
            $stmt->execute();



        }

    }


$stmt->close();
$conexion->close();

?>

