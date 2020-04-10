<?php

    require_once "../Conexion.php";
    $conexion=conexion();

    $tutores_registrados=$_POST['tutores_registrados'];
    $alumnos_tuto_grupal=$_POST['alumnos_tuto_grupal'];
    $encuentro_padres=$_POST['encuentro_padres'];
    $conferencias_alumnos=$_POST['conferencias_alumnos'];
    $alumnos_asistieron_conferencias=$_POST['alumnos_asistieron_conferencias'];

    $stmt = $conexion->prepare("insert into tutorias(tutores_registrados,alumnos_tuto_grupal,encuentro_padres,conferencias_alumnos,alumnos_asistieron_conferencias) values (?,?,?,?,?)");
    $stmt->bind_param("iiiii", $tutores_registrados, $alumnos_tuto_grupal,$encuentro_padres,$conferencias_alumnos,$alumnos_asistieron_conferencias);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

?>

