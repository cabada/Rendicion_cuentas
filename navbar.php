<?php

require_once "assets/components/PHP_Consultas/Conexion.php";
require_once "assets/components/PHP_Consultas/Usuarios/Verificar_Rol_Usuario.php";
$conexion = conexion();
$conn = conexion();
session_start();
$id_usuario = $_SESSION["id_usuario"];
$stmt = consultaRol($conn,$id_usuario);
$stmt->execute();

$stmt->bind_result($resultado);

while($stmt->fetch()){

    $rol = 'Administrador';


   if ($rol == $resultado){

       ?>

       <nav class="navbar navbar-expand-lg navbar-dark navbar-page mb-3">
           <a class="navbar-brand" href="#"><img src="assets/images/icons/TecNM.png" alt="TecNM" class="icon-navbar"></a>
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav">
                   <li class="nav-item dropdown">
                       <a class="nav-link" href="inicio.html">Inicio<span class="sr-only">(current)</span></a>
                   </li>
                   <li class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="desplegable">Docentes</a>
                       <div class="dropdown-menu">
                           <a class="dropdown-item" href="registro-evaluacion-docente.html">Evaluación docente</a>
                           <a class="dropdown-item" href="registro-profesores-tiempo-completo-grado-academico.html">Profesores de tiempo completo por grado académico</a>
                           <a class="dropdown-item" href="registro-tiempo-parcial-profesores.html">Profesores de tiempo parcial por grado académico</a>
                           <a class="dropdown-item" href="registro-total-profesores.html">Total de profesores por grado académico</a>
                           <a class="dropdown-item" href="registro-listado-maestros-certificaciones.html">Listado de maestros con certificaciones</a>
                           <a class="dropdown-item" href="registro-docentes-reconocimiento-perfil-deseable.html">Docentes con reconocimiento de perfil deseable</a>
                           <a class="dropdown-item" href="registro-equipo-maestros-itcj.html">Equipo de maestros ITCJ</a>
                           <a class="dropdown-item" href="registro-equipo-apoyo-asesores.html">Equipo de asesores PDA</a>
                           <a class="dropdown-item" href="registro-anio-sabatico.html">Producto año sabático</a>
                       </div>
                   </li>
                   <li class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="desplegable">Cursos</a>
                       <div class="dropdown-menu">
                           <a class="dropdown-item" href="registro-periodo-docentes-capacitados.html">Asistencia de docentes capacitados</a>
                           <a class="dropdown-item" href="registro-cursos-formacion-docente.html">Cursos de formación docente y actualización profesional</a>
                           <a class="dropdown-item" href="registro-cantidad-docentes-moocs.html">Participación del personal docente en MOOC's</a>
                           <a class="dropdown-item" href="registro-cantidad-alumnos-moocs.html">Participación de estudiantes en MOOC's</a>
                       </div>
                   </li>
                   <li class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="desplegable">Programas educativos</a>
                       <div class="dropdown-menu">
                           <a class="dropdown-item" href="registro-programa-educativo.html">Estudiantes inscritos en programas reconocidos por su calidad</a>
                           <a class="dropdown-item" href="registro-total-alumnos-programa-posgrado.html">Total de alumnos por programa de posgrado</a>
                           <a class="dropdown-item" href="registro-proyectos-investigacion-posgrado-periodo.html">Proyectos de investigación</a>
                           <a class="dropdown-item" href="registro-cantidad-matriculas.html">Matrículas en el Instituto Tecnológico de Ciudad Juárez </a>
                           <a class="dropdown-item" href="registro-estudiantes-capacidades-diferentes.html">Estudiantes con capacidades diferentes</a>
                           <a class="dropdown-item" href="registro-permanencia.html">Porcentaje de permanencia</a>
                           <a class="dropdown-item" href="registro-coordinacion-educativa-y-tutorias.html">Actividades de coordinación de orientación educativa</a>
                           <a class="dropdown-item" href="registro-tutorias.html">Tutorías</a>
                           <a class="dropdown-item" href="registro-orientatec.html">OrientaTec</a>
                           <a class="dropdown-item" href="registro-programa-delfin.html">Lineas de investigación del verano delfín</a>
                           <a class="dropdown-item" href="registro-cuerpos-academicos.html">Cuerpos académicos nivel licenciatura</a>
                           <a class="dropdown-item" href="registro-cuerpos-academicos-posgrado.html">Cuerpos académicos nivel posgrado</a>
                           <div class="dropdown-divider"></div>
                           <div class="dropdown-menu"></div>
                           <a class="dropdown-item" href="#">Lineas de investigación</a>
                           <a class="dropdown-item" href="registro-lineas-investigacion-licenciaturas.html">Lineas de investigación nivel Licenciatura</a>
                           <a class="dropdown-item" href="registro-lineas-investigacion-posgrado.html">Lineas de investigación nivel Posgrado</a>
                       </div>
                   </li>
                   <li class="nav-item dropdown">
                       <a href="usuarios.html" class="nav-link" >Usuarios<span class="sr-only">(current)</span></a>
                   </li>
                   <li class="nav-item dropdown">
                       <a href="roles.html" class="nav-link">Roles y Permisos<span class="sr-only">(current)</span></a>
                   </li>

               </ul>
           </div>
           <div">
               <button type="button" class="btn align-content-end btn-outline-secondary" id="btn_cerrar_sesion"><a href="index.html" class="" style="color:white;text-decoration: none"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></button>
           </div>

       </nav>



        <?php


   }

   else{

       ?>

       <nav class="navbar navbar-expand-lg navbar-dark navbar-page mb-3">
           <a class="navbar-brand" href="#"><img src="assets/images/icons/TecNM.png" alt="TecNM" class="icon-navbar"></a>
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav">
                   <li class="nav-item dropdown">
                       <a class="nav-link" href="inicio.html">Inicio<span class="sr-only">(current)</span></a>
                   </li>
                   <li class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="desplegable">Docentes</a>
                       <div class="dropdown-menu">
                           <a class="dropdown-item" href="registro-evaluacion-docente.html">Evaluación docente</a>
                           <a class="dropdown-item" href="registro-profesores-tiempo-completo-grado-academico.html">Profesores de tiempo completo por grado académico</a>
                           <a class="dropdown-item" href="registro-tiempo-parcial-profesores.html">Profesores de tiempo parcial por grado académico</a>
                           <a class="dropdown-item" href="registro-total-profesores.html">Total de profesores por grado académico</a>
                           <a class="dropdown-item" href="registro-listado-maestros-certificaciones.html">Listado de maestros con certificaciones</a>
                           <a class="dropdown-item" href="registro-docentes-reconocimiento-perfil-deseable.html">Docentes con reconocimiento de perfil deseable</a>
                           <a class="dropdown-item" href="registro-equipo-maestros-itcj.html">Equipo de maestros ITCJ</a>
                           <a class="dropdown-item" href="registro-equipo-apoyo-asesores.html">Equipo de asesores PDA</a>
                           <a class="dropdown-item" href="registro-anio-sabatico.html">Producto año sabático</a>
                       </div>
                   </li>
                   <li class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="desplegable">Cursos</a>
                       <div class="dropdown-menu">
                           <a class="dropdown-item" href="registro-periodo-docentes-capacitados.html">Asistencia de docentes capacitados</a>
                           <a class="dropdown-item" href="registro-cursos-formacion-docente.html">Cursos de formación docente y actualización profesional</a>
                           <a class="dropdown-item" href="registro-cantidad-docentes-moocs.html">Participación del personal docente en MOOC's</a>
                           <a class="dropdown-item" href="registro-cantidad-alumnos-moocs.html">Participación de estudiantes en MOOC's</a>
                       </div>
                   </li>
                   <li class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="desplegable">Programas educativos</a>
                       <div class="dropdown-menu">
                           <a class="dropdown-item" href="registro-programa-educativo.html">Estudiantes inscritos en programas reconocidos por su calidad</a>
                           <a class="dropdown-item" href="registro-total-alumnos-programa-posgrado.html">Total de alumnos por programa de posgrado</a>
                           <a class="dropdown-item" href="registro-proyectos-investigacion-posgrado-periodo.html">Proyectos de investigación</a>
                           <a class="dropdown-item" href="registro-cantidad-matriculas.html">Matrículas en el Instituto Tecnológico de Ciudad Juárez </a>
                           <a class="dropdown-item" href="registro-estudiantes-capacidades-diferentes.html">Estudiantes con capacidades diferentes</a>
                           <a class="dropdown-item" href="registro-permanencia.html">Porcentaje de permanencia</a>
                           <a class="dropdown-item" href="registro-coordinacion-educativa-y-tutorias.html">Actividades de coordinación de orientación educativa</a>
                           <a class="dropdown-item" href="registro-tutorias.html">Tutorías</a>
                           <a class="dropdown-item" href="registro-orientatec.html">OrientaTec</a>
                           <a class="dropdown-item" href="registro-programa-delfin.html">Lineas de investigación del verano delfín</a>
                           <a class="dropdown-item" href="registro-cuerpos-academicos.html">Cuerpos académicos nivel licenciatura</a>
                           <a class="dropdown-item" href="registro-cuerpos-academicos-posgrado.html">Cuerpos académicos nivel posgrado</a>
                           <div class="dropdown-divider"></div>
                           <div class="dropdown-menu"></div>
                           <a class="dropdown-item" href="#">Lineas de investigación</a>
                           <a class="dropdown-item" href="registro-lineas-investigacion-licenciaturas.html">Lineas de investigación nivel Licenciatura</a>
                           <a class="dropdown-item" href="registro-lineas-investigacion-posgrado.html">Lineas de investigación nivel Posgrado</a>
                       </div>
                   </li>
               </ul>
               <div class="navbar-dark">
                   <button type="button" class="btn align-content-end btn-outline-secondary" id="btn_cerrar_sesion"><a href="index.html" href="assets/components/PHP_Consultas/Usuarios/Destroy_Session.php" class="" style="color:white;text-decoration: none"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></button>
               </div>
           </div>
       </nav>



       <?php


   }


}



?>

<script>
    $(document).ready(function () {
        $('#btn_cerrar_sesion').click(function () {

            $.ajax({
                url: "assets/components/PHP_Consultas/Usuarios/Destroy_Session.php",
                success: function(){

                }

            });


        });


    });



</script>





<!-- <nav class="navbar navbar-expand-lg navbar-light mt-3">
    <a class="navbar-brand"><img src="assets/images/icons/tecnologico-icon.png" alt="" id="tecnologico-icon"></a>
    <button class="navbar-toggler" data-target="#header-nav" data-toggle="collapse" type="button">
        <span class="navbar-toogle-icon"><i class="fas fa-list-ul"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="header-nav">
        <ul class="navbar-nav ml-auto">
            <li class="ml-2">
                <a class="nav-link text-dark" href="inicio.html">Inicio</a>
            </li>
            <li class="nav-item dropdown ml-2">
                <a href="#" class="nav-link dropdown-toggle text-dark" data-toggle="dropdown" data-target="desplegable">Docentes</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="registro-evaluacion-docente.html">Evaluación docente</a>
                    <a class="dropdown-item" href="registro-profesores-tiempo-completo-grado-academico.html">Profesores de tiempo completo por grado académico</a>
                    <a class="dropdown-item" href="#">Profesores de tiempo parcial por grado académico</a>
                    <a class="dropdown-item" href="#">Total de profesores por grado académico</a>
                    <a class="dropdown-item" href="#">Listado de maestros con certificaciones</a>
                    <a class="dropdown-item" href="#">Docentes con reconocimiento de perfil deseable</a>
                    <a class="dropdown-item" href="registro-equipo-maestros-itcj.html">Equipo de maestros ITCJ</a>
                    <a class="dropdown-item" href="registro-equipo-apoyo-asesores.html">Equipo de asesores PDA</a>
                    <a class="dropdown-item" href="registro-anio-sabatico.html">Producto año sabático</a>
                </div>
            </li>

            <li class="nav-item dropdown ml-2">
                <a href="#" class="nav-link dropdown-toggle text-dark" data-toggle="dropdown" data-target="desplegable">Cursos</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="registro-periodo-docentes-capacitados.html">Asistencia de docentes capacitados</a>
                    <a class="dropdown-item" href="#">Cursos de formación docente y actualización profesional</a>
                    <a class="dropdown-item" href="registro-cantidad-docentes-moocs.html">Participación del personal docente en MOOC's</a>
                    <a class="dropdown-item" href="registro-cantidad-alumnos-moocs.html">Participación de estudiantes en MOOC's</a>
                </div>
            </li>

            <li class="nav-item dropdown ml-2">
                <a href="#" class="nav-link dropdown-toggle text-dark" data-toggle="dropdown" data-target="desplegable">Programas educativos</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="registro-programa-educativo.html">Estudiantes inscritos en programas reconocidos por su calidad</a>
                    <a class="dropdown-item" href="registro-total-alumnos-programa-posgrado.html">Total de alumnos por programa de posgrado</a>
                    <a class="dropdown-item" href="registro-proyectos-investigacion-posgrado-periodo.html">Proyectos de investigación</a>
                    <a class="dropdown-item" href="registro-cuerpos-academicos-posgrado.html">Cuerpos académicos (Posgrado)</a>
                    <a class="dropdown-item" href="registro-cantidad-matriculas.html">Matrícula nivel licenciatura</a>
                    <a class="dropdown-item" href="registro-estudiantes-capacidades-diferentes.html">Estudiantes con capacidades diferentes</a>
                    <a class="dropdown-item" href="registro-permanencia.html">Porcentaje de permanencia</a>
                    <a class="dropdown-item" href="registro-coordinacion-educativa-y-tutorias.html">Actividades de coordinación de orientación educativa</a>
                    <a class="dropdown-item" href="registro-tutorias.html">Tutorías</a>
                    <a class="dropdown-item" href="registro-orientatec.html">OrientaTec</a>
                    <a class="dropdown-item" href="registro-programa-delfin.html">Lineas de investigación del verano delfín</a>
                    <a class="dropdown-item" href="registro-cuerpos-academicos.html">Cuerpos académicos nivel licenciatura</a>
                    <a class="dropdown-item" href="registro-cuerpos-academicos-posgrado.html">Cuerpos académicos nivel posgrado</a>
                    <a class="dropdown-item" href="registro-especialidad-carreras.html">Oferta Academica (Carreras)</a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-menu"></div>
                    <a class="dropdown-item" href="#">Lineas de investigación</a>
                    <a class="dropdown-item" href="registro-lineas-investigacion-licenciaturas.html">Lineas de investigación nivel Licenciatura</a>
                    <a class="dropdown-item" href="registro-lineas-investigacion-posgrado.html">Lineas de investigación nivel Posgrado</a>
                </div>
            </li>
            <li class="nav-item ml-2">
                <a href="index.html" class="btn btn-page-theme d-block d-sm-inline-block mt-3 mt-sm-0"><i class="fas fa-user"></i> Cerrar sesión</a>
            </li>
        </ul>
    </div>
</nav> -->