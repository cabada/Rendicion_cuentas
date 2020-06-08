<?php

require_once "PHP_Consultas/Conexion.php";
require_once "PHP_Consultas/Usuarios/Verificar_Tablas_Usuarios.php";

session_start();
$conexion = conexion();
$conn = conexion();
$id_usuario = $_SESSION["id_usuario"];
$stmt = consultaTablas($conn,$id_usuario);


$stmt->execute();

$stmt->bind_result($resultado);

while($stmt->fetch()){

$tablaRequerida = 'cuerpos_academicos';

if($resultado == $tablaRequerida){

?>
<div class="row">
    <div class="col-sm-12">

        <!--Botones Excel y PDF -->
        <div class="row mt-2">
            <div class="col-12">
                <form id="reporte" name="reporte" method="POST" target="_blank">
                    <div class="form-group">
                        <div class="form-row d-flex">
                            <div class="col">
                                <input class="btn btn-danger text-white" type="button" target="_blank" value="Exportar PDF"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Cuerpos_Academicos/reportePDF.php';
                                document.reporte.submit()" />


                                <!--document.reporte.action = 'assets/components/PHP_Consultas/Registro_Total_Alumnos_Programa_Posgrado/reportePDF.php';
                                document.reporte.submit()-->

                                <input class="btn btn-success text-white" type="button" value="Exportar Excel"
                                       onclick= "document.reporte.action = 'assets/components/PHP_Consultas/Registro_Cuerpos_Academicos/reporteExcel.php';
                                       document.reporte.submit()" />

                            </div>

                            <!--Select de anio-->
                            <div class="col d-flex justify-content-end">
                                <select class="form-control col-md-5 anio" id="anio-select" name="anio-select">
                                    <option disabled selected hidden>Buscar por año</option>
                                    <option>Todos los registros</option>
                                    <?php
                                    $query = "select distinct year(fecha_creado) as fecha_creado from cuerpos_academicos order by fecha_creado desc";
                                    $resultado = mysqli_query($conexion,$query);

                                    while($fila = mysqli_fetch_array($resultado)){
                                        $valor = $fila['nombre_area_academica'];

                                        echo "<option>".($fila['fecha_creado'])."</option>\n";

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
           

        <div class="row">
            <div class="col-sm-12">

        <div class="table-responsive-xl">


                <?php
                $salida="";
                $sql="select 
                      cuerpos_academicos.id_cuerpo_academico,
                      area_academica.nombre_area_academica,
                      cuerpos_academicos.nombre_cuerpo_academico,
                      cuerpos_academicos.grado,
                      cuerpos_academicos.estado,
                      cuerpos_academicos.anio_registro,
                      cuerpos_academicos.vigencia,
                      cuerpos_academicos.AREA
                      from area_academica
                      right join cuerpos_academicos on area_academica.ID_AREA_ACADEMICA = cuerpos_academicos.ID_AREA_ACADEMICA";
                      
                      if(isset($_POST['consulta'])) {

                        $q = $conexion->real_escape_string($_POST['consulta']);
                        $_SESSION['consulta'] = $q;

                        $sql="select 
                        cuerpos_academicos.id_cuerpo_academico,
                        area_academica.nombre_area_academica,
                        cuerpos_academicos.nombre_cuerpo_academico,
                        cuerpos_academicos.grado,
                        cuerpos_academicos.estado,
                        cuerpos_academicos.anio_registro,
                        cuerpos_academicos.vigencia,
                        cuerpos_academicos.AREA
                        from area_academica
                        right join cuerpos_academicos on area_academica.ID_AREA_ACADEMICA = cuerpos_academicos.ID_AREA_ACADEMICA
                        where (area_academica.nombre_area_academica like '%$q%'
                        or cuerpos_academicos.nombre_cuerpo_academico like '%$q%'
                        or cuerpos_academicos.grado like '%$q%'
                        or cuerpos_academicos.estado like '%$q%'
                        or cuerpos_academicos.anio_registro like '%$q%'
                        or cuerpos_academicos.vigencia like '%$q%'
                        or cuerpos_academicos.AREA like '%$q%')";
                        
                        if (isset($_POST['consulta_anio'])) {
                            /*variable goblal*/
                            $p = $_SESSION['consulta_anio'];

                            $sql="select 
                        cuerpos_academicos.id_cuerpo_academico,
                        area_academica.nombre_area_academica,
                        cuerpos_academicos.nombre_cuerpo_academico,
                        cuerpos_academicos.grado,
                        cuerpos_academicos.estado,
                        cuerpos_academicos.anio_registro,
                        cuerpos_academicos.vigencia,
                        cuerpos_academicos.AREA
                        from area_academica
                        right join cuerpos_academicos on area_academica.ID_AREA_ACADEMICA = cuerpos_academicos.ID_AREA_ACADEMICA
                        where (area_academica.nombre_area_academica like '%$q%'
                        or cuerpos_academicos.nombre_cuerpo_academico like '%$q%'
                        or cuerpos_academicos.grado like '%$q%'
                        or cuerpos_academicos.estado like '%$q%'
                        or cuerpos_academicos.anio_registro like '%$q%'
                        or cuerpos_academicos.vigencia like '%$q%'
                        or cuerpos_academicos.AREA like '%$q%')
                        and cuerpos_academicos.fecha_creado like '%$p%'";
                        }
                    }

                    /*Query para consultas del buscador*/

            if(isset($_POST['consulta_anio'])){
                $q = $conexion->real_escape_string($_POST['consulta_anio']);
                /*Variable global*/
                if($_POST['consulta_anio']!='Todos los registros'){
                $_SESSION['consulta_anio']=$q;

                $sql="select 
                      cuerpos_academicos.id_cuerpo_academico,
                      area_academica.nombre_area_academica,
                      cuerpos_academicos.nombre_cuerpo_academico,
                      cuerpos_academicos.grado,
                      cuerpos_academicos.estado,
                      cuerpos_academicos.anio_registro,
                      cuerpos_academicos.vigencia,
                      cuerpos_academicos.AREA
                      from area_academica
                      right join cuerpos_academicos on area_academica.ID_AREA_ACADEMICA = cuerpos_academicos.ID_AREA_ACADEMICA
                      where cuerpos_academicos.fecha_creado like '%$q%'";
                      
                    }else {
                        $sql="select 
                      cuerpos_academicos.id_cuerpo_academico,
                      area_academica.nombre_area_academica,
                      cuerpos_academicos.nombre_cuerpo_academico,
                      cuerpos_academicos.grado,
                      cuerpos_academicos.estado,
                      cuerpos_academicos.anio_registro,
                      cuerpos_academicos.vigencia,
                      cuerpos_academicos.AREA
                      from area_academica
                      right join cuerpos_academicos on area_academica.ID_AREA_ACADEMICA = cuerpos_academicos.ID_AREA_ACADEMICA
                      ";
    
                        unset($_SESSION['çonsulta_anio']);
                    }
                }

                $resultado = $conexion->query($sql);
            if ($resultado->num_rows>0){

                $salida.=' <table class="table table-sm table-hover table-condensed table-bordered table-striped mt-2" id="tabla-php">
                <tr>
                    <td class="text-center align-middle background-table">Area académica</td>
                    <td class="text-center align-middle background-table">Nombre de cuerpo académico</td>
                    <td class="text-center align-middle background-table">Grado</td>
                    <td class="text-center align-middle background-table">Estado</td>
                    <td class="text-center align-middle background-table">Año de registro</td>
                    <td class="text-center align-middle background-table">Fecha de vigencia</td>
                    <td class="text-center align-middle background-table">Área</td>
                    <td class="text-center align-middle background-table">Acciones</td>
                </tr>';

                 $result=mysqli_query($conexion,$sql);
                while($ver=mysqli_fetch_row($result)){

                    $datos=$ver[0]."||".
                           $ver[1]."||".
                           $ver[2]."||".
                           $ver[3]."||".
                           $ver[4]."||".
                           $ver[5]."||".
                           $ver[6]."||".
                           $ver[7];

               

                           $salida .= '<tr>
                    <td>'. $ver[1].'</td>
                    <td>'.$ver[2].'</td>
                    <td>'.$ver[3].'</td>
                    <td>'.$ver[4].'</td>
                    <td>'.$ver[5].'</td>
                    <td>'.$ver[6].'</td>
                    <td>'.$ver[7].'</td>
                    <td class="text-center align-middle">
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform(\'' . $datos . '\')"><i class="far fa-edit"></i>  Editar</button>
                        <button class="btn btn-sm btn-danger" onclick="preguntarSiNo(\'' . $ver[0] . '\')"><i class="fas fa-trash"></i>  Eliminar</button>
                    </td>
                </tr>';
                    
                }
                ?>
            </table>
            <?php
            } else {
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


}

$stmt->close();
$conexion->close();



?>