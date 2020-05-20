<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'tutorias';
$stmt = consultaPermisos($conn,$id_usuario,$tabla,'Update');

$stmt->execute();

if($stmt->fetch()){

$id_tutorias=$_POST['id_tutorias'];
$tutores_registrados=$_POST['tutores_registrados'];
$alumnos_tuto_grupal=$_POST['alumnos_tuto_grupal'];
$encuentro_padres=$_POST['encuentro_padres'];
$conferencias_alumnos=$_POST['conferencias_alumnos'];
$alumnos_asistieron_conferencias=$_POST['alumnos_asistieron_conferencias'];

$stmt = $conexion->prepare("update tutorias set
                                            TUTORES_REGISTRADOS=?,
                                            ALUMNOS_TUTO_GRUPAL=?,
                                            ENCUENTRO_PADRES=?,
                                            CONFERENCIAS_ALUMNOS=?,
                                            ALUMNOS_ASISTIERON_CONFERENCIAS=?
                                            where ID_TUTORIAS = $id_tutorias");

$stmt->bind_param("iiiii", $tutores_registrados, $alumnos_tuto_grupal,
                      $encuentro_padres,$conferencias_alumnos,$alumnos_asistieron_conferencias);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();

}
else{
    echo 2;
}


?>
