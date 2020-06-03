<?php

require_once "PHP_Consultas/Conexion.php";
require_once "PHP_Consultas/Usuarios/Verificar_Rol_Usuario.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$stmt = consultaRol($conn,$id_usuario);


$stmt->execute();

$stmt->bind_result($resultado);

while($stmt->fetch()){

$rol = 'Administrador';

if($resultado == $rol){

?>
<div class="row">
    <div class="col-sm-12">



<div class="row">
    <div class="col-sm-12">

        <div class="table-responsive-xl">

                <?php

                $salida = "";
                $sql="select usuarios.id_usuario,
                            usuarios.nombre_usuario,
                            usuarios.apellido_usuario,
                            usuarios.email_usuario,
                            roles.nombre_Rol
                            from usuarios
                            join roles on usuarios.id_Rol_Usuario=roles.id_Rol";


                if(isset($_POST['consulta'])){
                    $q = $conexion->real_escape_string($_POST['consulta']);
                    $sql="select usuarios.id_usuario,
                            usuarios.nombre_usuario,
                            usuarios.apellido_usuario,
                            usuarios.email_usuario,
                            roles.nombre_Rol
                            from usuarios
                            join roles on usuarios.id_Rol_Usuario=roles.id_Rol
                            where usuarios.nombre_usuario like '%$q%'
                            or usuarios.apellido_usuario like '%$q%'
                            or roles.nombre_Rol like '%$q%'";

                }

                $result  = $conexion->query($sql);
                if($result->num_rows>0){

                    $salida.=' <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2">
                <tr>
                    <td class="text-center align-middle background-table">Nombre</td>
                    <td class="text-center align-middle background-table">Apellido</td>
                    <td class="text-center align-middle background-table">Email</td>
                    <td class="text-center align-middle background-table">Rol</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>';



                $result=mysqli_query($conexion,$sql);
                while($buscar=mysqli_fetch_row($result)){

                    $datos=$buscar[0]."||".
                        $buscar[1]."||".
                        $buscar[2]."||".
                        $buscar[3]."||".
                        $buscar[4];


                    $salida.='
                    <tr>
                        <td>'.$buscar[1].'</td>
                        <td>'.$buscar[2].'</td>
                        <td>'.$buscar[3].'</td>
                        <td>'.$buscar[4].'</td>
                       <td class="text-center align-middle">
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion"  onclick="agregaform(\''.$datos.'\')" ><i class="far fa-edit"></i>  Editar</button>
                                <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\''.$buscar[0].'\')"><i class="fas fa-trash"></i>  Eliminar</button>
                                    
                       </td>
                    </tr>';

                }
                ?>
            </table>
    <?php
    }else
                    $salida.='<div class="row mt-3">
                            <div class="col-12 text-center">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>¡No se encontró ningún elemento!</strong><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>';

}
    echo $salida;



    ?>
        </div>

    </div>
</div>


    </div>
</div>

    <?php
}




$stmt->close();
$conexion->close();



?>