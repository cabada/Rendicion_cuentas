<?php

require "../Conexion.php";
require_once "../Usuarios/Verificar_Permisos_Usuarios.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$tabla = 'periodo_docentes_capacitados';

$query = consultaPermisos($conn,$id_usuario,$tabla,'Insert');


$query->execute();

if($query->fetch()) {
    $tipo_nombramiento=$_POST['tipo_nombramiento'];
    $total_docentes=$_POST['total_docentes'];
    $no_docentes_capacitados=$_POST['no_docentes_capacitados'];
    $porcentaje=$_POST['porcentaje'];
    $periodo=$_POST['periodo'];

    $stmt = $conexion->prepare("insert into periodo_docentes_capacitados(tipo_nombramiento,
                            total_docentes,
                            no_docentes_capacitados,
                            porcentaje_docentes_capacitados,
                            periodo) values (?,?,?,?,?)");
    $stmt->bind_param("siiss", $tipo_nombramiento, $total_docentes,$no_docentes_capacitados,$porcentaje,$periodo);

echo $resultado = $stmt->execute();

$stmt->close();
$conexion->close();


}
else{
    echo "2";
}

?>

