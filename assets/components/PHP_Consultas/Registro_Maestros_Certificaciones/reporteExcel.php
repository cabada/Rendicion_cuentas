<?php
//cabeceras y que permita descargar desde el navegador
     header("Content-Type:application/xls");
     header("Content-Disposition: attachment; filename=Registro_Total_Alumnos_Programa_Posgrado.xls"); //nombre del documento

/*Iniciacion de las variables globales de la sesion*/
     session_start();
     require_once "../conexion.php";


     $conexion = conexion();


?>
    <table>
         <tr>
             <h4>Reporte de Registro de Maestros con Certificaciones</h4>
             <th class="text-center align-middle background-table">Nombre</th>
             <th class="text-center align-middle background-table">Área académica</th>
             <th class="text-center align-middle background-table">Disciplina</th>

         </tr>
        <?php


        /*Verifica si la variable global fue definida*/
        if(isset($_SESSION['consulta'])){
            /*Se le pasa el valor de la variable global a $q*/
            $q = $_SESSION['consulta'];
            $sql="select profesores.id_profesor,
                            profesores.nombre_completo,
                            area_academica.nombre_area_academica,
                            profesores.disciplina
                            from profesores
                            join area_academica
                            on area_academica.id_area_academica = profesores.id_area_academica
                            where profesores.id_categoria_profesores = 1
                            and (profesores.nombre_completo like '%$q%' or area_academica.nombre_area_academica like '%$q%')";

            /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta']);

        }

        /*Sino se cumple el if de arriba, se pasa a este.
        Verifica si la variable global fue definida*/
        elseif (isset($_SESSION['consulta_anio'])){
            /*Se le pasa el valor de la variable global a $q*/
            $q = $_SESSION['consulta_anio'];

            $sql="select profesores.id_profesor,
                            profesores.nombre_completo,
                            area_academica.nombre_area_academica,
                            profesores.disciplina
                            from profesores
                            join area_academica
                            on area_academica.id_area_academica = profesores.id_area_academica
                            where profesores.id_categoria_profesores = 1 and profesores.fecha_creado like '%$q%'";
            /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta_anio']);
        }
        /*Sino se cumplio ninguno de arriba, se va a ejecutar esta instruccion que es la de por defecto. Es una query para ver todos los registros
        de la tabla.*/
        else{

            $sql="select profesores.id_profesor,
                            profesores.nombre_completo,
                            area_academica.nombre_area_academica,
                            profesores.disciplina
                            from profesores
                            join area_academica
                            on area_academica.id_area_academica = profesores.id_area_academica
                            where profesores.id_categoria_profesores = 1";
            unset($_SESSION['consulta']);
            unset($_SESSION['consulta_anio']);

        }


        $result=mysqli_query($conexion,$sql);
        while($ver=mysqli_fetch_row($result)){

            $datos=$ver[0]."||".
                $ver[1]."||".
                $ver[2]."||".
                $ver[3];
            ?>
         <tr>
             <td><?php echo utf8_decode($ver[1])?></td>
             <td><?php echo utf8_decode($ver[2])?></td>
             <td><?php echo utf8_decode($ver[3])?></td>
         </tr>
         <?php
         }
         ?>
    </table>