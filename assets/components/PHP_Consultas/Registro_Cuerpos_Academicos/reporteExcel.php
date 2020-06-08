<?php
//cabeceras y que permita descargar desde el navegador
header("Content-Type:application/xls");
header("Content-Disposition: attachment; filename=Reporte de Registro de Coordinacion Educativa.xls"); //nombre del documento

//variables de sesion
session_start();
require_once "../conexion.php";
$conexion = conexion();

$sentencia = ("select id_actividad,nombre_actividad,PERIODO_ENE_JUN,PERIODO_AGO_DIC
                            from coordinacion_educativa_y_tutorias");
$query = mysqli_query($conexion,$sentencia);
?>

                     <table>
                         <tr>
                             <h4>Registro de cuerpos académicos</h4>
                             <th class="text-center align-middle background-table">Area académica</th>
                             <th class="text-center align-middle background-table">Nombre de cuerpo académico</th>
                             <th class="text-center align-middle background-table">Grado</th>
                             <th class="text-center align-middle background-table">Estado</th>
                             <th class="text-center align-middle background-table">Año de registro</th>
                             <th class="text-center align-middle background-table">Fecha de vigencia</th>
                             <th class="text-center align-middle background-table">Área</th>
                         </tr>
                <?php

                /*Verifica si la variable global fue definida*/
                if(isset($_SESSION['consulta'])) {
                    /*Se le pasa el valor de la variable global a $q*/
                    $q = $_SESSION['consulta'];  //query para buscador
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
                    

                if (isset($_SESSION['consulta_anio'])) {
                    /*Se le pasa el valor de la variable global a $q*/
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
                unset($_SESSION['consulta']);
                unset($_SESSION['consulta_anio']);
            }
           
                elseif (isset($_SESSION['consulta_anio'])) {
                /*Se le pasa el valor de la variable global a $q*/
                $q = $_SESSION['consulta_anio'];
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
                /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta_anio']);
                }

                else {
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
                      unset($_SESSION['consulta']);
                      unset($_SESSION['consulta_anio']);  
                    }

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

        ?>
        <tr>
            <td><?php echo $ver[1]?></td>
            <td><?php echo $ver[2]?></td>
            <td><?php echo $ver[3]?></td>
            <td><?php echo $ver[4]?></td>
            <td><?php echo $ver[5]?></td>
            <td><?php echo $ver[6]?></td>
            <td><?php echo utf8_decode($ver[7])?></td>
        </tr>
        <?php
    }
    ?>
</table>

