<?php

     require_once "conexion.php";
     $conexion=conexion();
     $modalidad=$_POST['modalidad_agregar'];
     $inreso=$_POST['inreso_agregar'];
     $reingreso=$_POST['reingreso_agregar'];
     $estatus=$_POST['estatus_agregar'];
     $periodo=$_POST['periodo_agregar'];

     $stmt = $conexion->prepare("INSERT into programa_educativo (MODALIDAD,NUEVO_INGRESO,REINGRESO,ESTATUS,PERIODO) 
                              values ('$modalidad','$inreso','$reingreso','$estatus','$periodo')");

     $stmt->bind_param("siiss",$modalidad,$inreso,$reingreso,$estatus,$periodo);

     echo $result= $stmt->execute();

     if(!$result) {
       echo "conectado";
         }else{
       echo "no conectado";
         }

     $stmt->close();
     $conexion->close();

?>