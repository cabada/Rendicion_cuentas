<?php

function consultaRol($conexion,$id_usuario){

    $stmt = $conexion->prepare("select distinct
                                            roles.nombre_rol
                                        from usuarios
                                        join roles
                                        on roles.id_rol = usuarios.id_rol_usuario
                                        where usuarios.id_usuario=?");
    $stmt->bind_param("i", $id_usuario);

    return $stmt;



}
