<?php
//cabeceras y que permita descargar desde el navegador
     header("Content-Type:application/xls");
     header("Content-Disposition: attachment; filename=Registro_Equipo_Maestros_ITCJ.xls"); //nombre del documento

/*Iniciacion de las variables globales de la sesion*/
     session_start();
     require_once "../conexion.php";


     $conexion = conexion();


?>
    <table>
         <tr>
              <h4>Reporte de Registro de Equipo de Maestros ITCJ</h4>
             <th class="text-center align-middle background-table">Nombre de Docente</th>
             <th class="text-center align-middle background-table">Categoria</th>
             <th class="text-center align-middle background-table">Grado de Estudios</th>
             <th class="text-center align-middle background-table">SNI</th>
             <th class="text-center align-middle background-table">Area de Especializacion</th>
             <th class="text-center align-middle background-table">Experiencia Profesional</th>
             <th class="text-center align-middle background-table">Experiencia Docente</th>

         </tr>
        <?php


        /*Verifica si la variable global fue definida*/
        if(isset($_SESSION['consulta'])){

            /*Se le pasa el valor de la variable global a $q*/
            $q = $_SESSION['consulta'];
            $sql = "select id_equipo_maestros_itcj,
                                    nombre_docente,
                                    categoria_hora,
                                    grado_estudios,
                                    sni,area_especializacion,
                                    experiencia_profesional,
                                    experiencia_docente 
                                    from equipo_maestros_itcj
                                    where nombre_docente like '%$q%' or grado_estudios like '%$q%'";

            /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta']);

        }

        /*Sino se cumple el if de arriba, se pasa a este.
        Verifica si la variable global fue definida*/
        elseif (isset($_SESSION['consulta_anio'])){
            /*Se le pasa el valor de la variable global a $q*/
            $q = $_SESSION['consulta_anio'];

            $sql = "select id_equipo_maestros_itcj,
                                    nombre_docente,
                                    categoria_hora,
                                    grado_estudios,
                                    sni,area_especializacion,
                                    experiencia_profesional,
                                    experiencia_docente 
                                    from equipo_maestros_itcj
                                    where fecha_creado like '%$q%'";
            /*Se destruye/quita el valor dentro de la variable global*/
            unset($_SESSION['consulta_anio']);
        }
        /*Sino se cumplio ninguno de arriba, se va a ejecutar esta instruccion que es la de por defecto. Es una query para ver todos los registros
        de la tabla.*/
        else{

            $sql="select id_equipo_maestros_itcj,
                            nombre_docente,
                            categoria_hora,
                            grado_estudios,
                            sni,
                            area_especializacion,
                            experiencia_profesional,
                            experiencia_docente 
                            from equipo_maestros_itcj";

        }


        $result=mysqli_query($conexion,$sql);
        while($buscar=mysqli_fetch_row($result)){

            $datos = $buscar[0]."||".
                $buscar[1]."||".
                $buscar[2]."||".
                $buscar[3]."||".
                $buscar[4]."||".
                $buscar[5]."||".
                $buscar[6]."||".
                $buscar[7];
            ?>
         <tr>
             <td><?php echo utf8_decode($buscar[1])?></td>
             <td><?php echo utf8_decode($buscar[2])?></td>
             <td><?php echo utf8_decode($buscar[3])?></td>
             <td><?php echo utf8_decode($buscar[4])?></td>
             <td><?php echo utf8_decode($buscar[5])?></td>
             <td><?php echo utf8_decode($buscar[6])?></td>
             <td><?php echo utf8_decode($buscar[7])?></td>
         </tr>
         <?php
         }
         ?>
    </table>