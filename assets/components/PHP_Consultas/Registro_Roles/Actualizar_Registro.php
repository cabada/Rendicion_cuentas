<?php

require_once "../Conexion.php";
$conexion=conexion();

$id_rol=$_POST['id_rol'];
$nombre_rol=$_POST['nombre_rol'];
$modulo=$_POST['modulo'];
$permiso=$_POST['permiso'];



//hace update al nombre del rol con el id

$stmt = $conexion->prepare("update roles set nombre_rol=? where id_rol='$id_rol'");
$stmt->bind_param("s", $nombre_rol);

echo $resultado = $stmt->execute();

$query = "select    id_perfil_operacion,
                    id_operacion
                    from rol_operacion
                    where id_rol='$id_rol'";

$resultado = mysqli_query($conexion,$query);


$arrPerm = count($permiso);
$arrMod = count($modulo);

//verifica si permisoUCHK no es nulo

if (isset($_POST['permisoUCHK'])){
    $permisoUCHK = $_POST['permisoUCHK'];
    $arrPermUCHK = count($permisoUCHK);


    if($arrPerm >= $arrPermUCHK){

        $ArrPerm1 = $permiso;
        $ArrPerm2 = $permisoUCHK;
        $tamArrGrande = $arrPerm;
        $tamArrChico = $arrPermUCHK;

    }
    else{
        $ArrPerm1 = $permisoUCHK;
        $ArrPerm2 = $permiso;
        $tamArrGrande = $arrPermUCHK;
        $tamArrChico = $arrPerm;
    }




}
else{

    $ArrPerm1 = $permiso;
    $tamArrGrande = $arrPerm;


}

//verifica si moduloUCHK no es nulo

if (isset($_POST['moduloUCHK'])){
    $moduloUCHK = $_POST['moduloUCHK'];
    $arrModUCHK = count($moduloUCHK);


    if($arrMod >=$arrModUCHK){
        $ArrMod1 = $modulo;
        $ArrMod2 = $moduloUCHK;
        $tamArrGrande1 = $arrMod;
        $tamArrChico2 = $arrModUCHK;


    }
    else{
        $ArrMod1 = $moduloUCHK;
        $ArrMod2 = $modulo;
        $tamArrGrande1 = $arrModUCHK;
        $tamArrChico2 = $arrMod;

    }

}
else{

    $ArrMod1 = $modulo;

    $tamArrGrande1 = $arrMod;


}






for($i=0;$i<$tamArrGrande;$i++){


    if(isset($ArrPerm2)){
    if(array_key_exists($i,$ArrPerm2)){



        //Verifica si $ArrPerm1 no es igual a los permisos que estan checados


             (string)$perm = $ArrPerm2[$i];


            //Busca si hay permisos de los cuales no estan checados en la interfaz


        if($ArrPerm2==$permisoUCHK){


            $query="select roles.id_rol,
                            roles.nombre_Rol,
                            operaciones.id_operaciones,
                            operaciones.nombre_operacion, 
                            modulo.nombre_modulo 
                            from modulo 
                            join operaciones 
                            on modulo.id_modulo=operaciones.id_modulo 
                            join rol_operacion 
                            on operaciones.id_operaciones=rol_operacion.id_operacion 
                            join roles
                             on roles.id_rol=rol_operacion.id_rol 
                             where roles.id_Rol='$id_rol' and operaciones.nombre_operacion='$perm'";


            $resultado = mysqli_query($conexion,$query);

            while($fila = mysqli_fetch_array($resultado)){


                $res = $fila['id_operaciones'];
                $stmt = $conexion->prepare("delete from operaciones where id_operaciones=?");
                $stmt->bind_param('i',$res);
               $stmt->execute();

            }

        }

        else{

                for($j = 0;$j < $arrMod; $j++){


                    $mod = $modulo[$j];


                    $query="select roles.id_rol,
                            roles.nombre_Rol,
                            operaciones.id_Operaciones,
                            operaciones.nombre_Operacion, 
                            modulo.id_modulo,
                            modulo.nombre_modulo 
                            from modulo 
                            join operaciones 
                            on modulo.id_modulo=operaciones.id_modulo 
                            join rol_operacion 
                            on operaciones.id_operaciones=rol_operacion.id_operacion 
                            join roles
                             on roles.id_rol=rol_operacion.id_rol 
                             where roles.id_Rol='$id_rol' and operaciones.nombre_operacion='$perm' and modulo.id_modulo='$mod'";

                    $resultadoCHK = mysqli_query($conexion,$query);
                    $fil2 = mysqli_fetch_row($resultadoCHK);


                    if(!$fil2){


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

                if(isset($_POST['moduloUCHK'])){

                    for($k=0;$k<$arrModUCHK;$k++){

                        $modUCHK = $moduloUCHK[$k];

                        $query="select roles.id_rol,
                            roles.nombre_Rol,
                            operaciones.id_Operaciones,
                            operaciones.nombre_Operacion, 
                            modulo.id_modulo,
                            modulo.nombre_modulo 
                            from modulo 
                            join operaciones 
                            on modulo.id_modulo=operaciones.id_modulo 
                            join rol_operacion 
                            on operaciones.id_operaciones=rol_operacion.id_operacion 
                            join roles
                             on roles.id_rol=rol_operacion.id_rol 
                             where roles.id_Rol='$id_rol' and operaciones.nombre_operacion='$perm' and modulo.id_modulo='$modUCHK'";

                        $resUCHK = mysqli_query($conexion,$query);

                        while($fila = mysqli_fetch_array($resUCHK)){
                            $res = $fila['id_modulo'];
                            $stmt = $conexion->prepare("delete from operaciones where id_modulo=?");
                            $stmt->bind_param('i',$res);
                            $stmt->execute();
                        }


                    }

                }


        }





    }
    }
    (string)$perm1 = $ArrPerm1[$i];




    if(isset($_POST['permisoUCHK'])){

        //Verifica si el arreglo mas grande es igual a los permisos no checados

        if($ArrPerm1==$permisoUCHK ){

            $query="select roles.id_rol,
                            roles.nombre_Rol,
                            operaciones.id_operaciones,
                            operaciones.nombre_operacion, 
                            modulo.nombre_modulo 
                            from modulo 
                            join operaciones 
                            on modulo.id_modulo=operaciones.id_modulo 
                            join rol_operacion 
                            on operaciones.id_operaciones=rol_operacion.id_operacion 
                            join roles
                             on roles.id_rol=rol_operacion.id_rol 
                             where roles.id_Rol='$id_rol' and operaciones.nombre_operacion='$perm1'";


            $resultado = mysqli_query($conexion,$query);


            while($fila = mysqli_fetch_array($resultado)){

                $res = $fila['id_operaciones'];
                $stmt = $conexion->prepare("delete from operaciones where id_operaciones=?");
                $stmt->bind_param('i',$res);
                $stmt->execute();
            }


        }

        else{

            for($j = 0;$j < $arrMod; $j++){


                $mod = $modulo[$j];


                $query="select roles.id_rol,
                            roles.nombre_Rol,
                            operaciones.id_Operaciones,
                            operaciones.nombre_Operacion, 
                            operaciones.id_modulo,
                            modulo.nombre_modulo 
                            from modulo 
                            join operaciones 
                            on modulo.id_modulo=operaciones.id_modulo 
                            join rol_operacion 
                            on operaciones.id_operaciones=rol_operacion.id_operacion 
                            join roles
                             on roles.id_rol=rol_operacion.id_rol 
                             where roles.id_Rol='$id_rol' and operaciones.nombre_operacion='$perm1' and operaciones.id_modulo='$mod'";

                $resultadoCHK = mysqli_query($conexion,$query);
                $fil = mysqli_fetch_row($resultadoCHK);

                if(!$fil){





                    $stmt = $conexion->prepare("insert into operaciones(nombre_operacion,id_modulo) values (?,?)");
                    $stmt->bind_param("si", $perm1,$mod);
                    $stmt->execute();

                    $query = "select id_operaciones from operaciones where nombre_operacion='$perm1' and id_modulo='$mod'";
                    $resultado = mysqli_query($conexion,$query);
                    $fila = mysqli_fetch_assoc($resultado);

                    $id_operaciones = $fila['id_operaciones'];


                    $stmt = $conexion->prepare("insert into rol_operacion(id_rol,id_operacion) values (?,?)");
                    $stmt->bind_param("ii", $id_rol,$id_operaciones);
                    $stmt->execute();

                }


            }

            if(isset($_POST['moduloUCHK'])){
                for($k=0;$k<$arrModUCHK;$k++){

                    $modUCHK = $moduloUCHK[$k];

                    $query="select roles.id_rol,
                            roles.nombre_Rol,
                            operaciones.id_Operaciones,
                            operaciones.nombre_Operacion, 
                            modulo.id_modulo,
                            modulo.nombre_modulo 
                            from modulo 
                            join operaciones 
                            on modulo.id_modulo=operaciones.id_modulo 
                            join rol_operacion 
                            on operaciones.id_operaciones=rol_operacion.id_operacion 
                            join roles
                             on roles.id_rol=rol_operacion.id_rol 
                             where roles.id_Rol='$id_rol' and operaciones.nombre_operacion='$perm1' and modulo.id_modulo='$modUCHK'";

                    $resUCHK = mysqli_query($conexion,$query);

                    while($fila = mysqli_fetch_array($resUCHK)){
                        $res = $fila['id_modulo'];
                        $stmt = $conexion->prepare("delete from operaciones where id_modulo=?");
                        $stmt->bind_param('i',$res);
                        $stmt->execute();
                    }


                }

            }




        }


    }

    else{

        for($j = 0;$j < $arrMod; $j++){


            $mod = $modulo[$j];


            $query="select roles.id_rol,
                            roles.nombre_Rol,
                            operaciones.id_Operaciones,
                            operaciones.nombre_Operacion, 
                            operaciones.id_modulo,
                            modulo.nombre_modulo 
                            from modulo 
                            join operaciones 
                            on modulo.id_modulo=operaciones.id_modulo 
                            join rol_operacion 
                            on operaciones.id_operaciones=rol_operacion.id_operacion 
                            join roles
                             on roles.id_rol=rol_operacion.id_rol 
                             where roles.id_Rol='$id_rol' and operaciones.nombre_operacion='$perm1' and operaciones.id_modulo='$mod'";

            $resultadoCHK = mysqli_query($conexion,$query);
            $fil = mysqli_fetch_row($resultadoCHK);

            if(!$fil){





                $stmt = $conexion->prepare("insert into operaciones(nombre_operacion,id_modulo) values (?,?)");
                $stmt->bind_param("si", $perm1,$mod);
                $stmt->execute();

                $query = "select id_operaciones from operaciones where nombre_operacion='$perm1' and id_modulo='$mod'";
                $resultado = mysqli_query($conexion,$query);
                $fila = mysqli_fetch_assoc($resultado);

                $id_operaciones = $fila['id_operaciones'];


                $stmt = $conexion->prepare("insert into rol_operacion(id_rol,id_operacion) values (?,?)");
                $stmt->bind_param("ii", $id_rol,$id_operaciones);
                $stmt->execute();

            }


        }

        if(isset($_POST['moduloUCHK'])){
            for($k=0;$k<$arrModUCHK;$k++){

                $modUCHK = $moduloUCHK[$k];

                $query="select roles.id_rol,
                            roles.nombre_Rol,
                            operaciones.id_Operaciones,
                            operaciones.nombre_Operacion, 
                            modulo.id_modulo,
                            modulo.nombre_modulo 
                            from modulo 
                            join operaciones 
                            on modulo.id_modulo=operaciones.id_modulo 
                            join rol_operacion 
                            on operaciones.id_operaciones=rol_operacion.id_operacion 
                            join roles
                             on roles.id_rol=rol_operacion.id_rol 
                             where roles.id_Rol='$id_rol' and operaciones.nombre_operacion='$perm1' and modulo.id_modulo='$modUCHK'";

                $resUCHK = mysqli_query($conexion,$query);

                while($fila = mysqli_fetch_array($resUCHK)){
                    $res = $fila['id_modulo'];
                    $stmt = $conexion->prepare("delete from operaciones where id_modulo=?");
                    $stmt->bind_param('i',$res);
                    $stmt->execute();
                }


            }

        }




    }

}



$stmt->close();
$conexion->close();

?>
