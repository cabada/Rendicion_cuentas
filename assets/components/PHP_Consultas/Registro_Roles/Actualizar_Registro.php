<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_rol=$_POST['id_rol'];
$nombre_rol=$_POST['nombre_rol'];
$modulo=$_POST['modulo'];
$permiso=$_POST['permiso'];

$stmt = $conexion->prepare("update roles set nombre_rol=? where id_rol='$id_rol'");
$stmt->bind_param("s", $nombre_rol);

$resultado = $stmt->execute();

$query = "select    id_perfil_operacion,
                    id_operacion
                    from rol_operacion
                    where id_rol='$id_rol'";

$resultado = mysqli_query($conexion,$query);

echo $id_rol;


//Se saca el largo del arreglo y se guarda en una variable, en este caso de los arreglos de
//permiso y de modulo
$arrPerm = count($permiso);
$arrMod = count($modulo);



for($i = 0; $i < $arrPerm; $i++){

    $fila = mysqli_fetch_array($resultado);

   echo (string)$perm = $permiso[$i];
   echo "\n";

      echo  $id_operaciones =$fila['id_operacion'];
      echo "\n";

        for($j = 0;$j < $arrMod; $j++){

             echo $mod = $modulo[$j];
             echo "\n";


            $stmt = $conexion->prepare("update operaciones
                                                set nombre_operacion=?,
                                                id_modulo=?
                                                where id_operaciones = $id_operaciones");
            $stmt->bind_param("si", $perm,$mod);
            $stmt->execute();


        }



}

var_dump($_POST);

$stmt->close();
$conexion->close();

?>
