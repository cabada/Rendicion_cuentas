<?php
function consultaPermisos($conexion,$id_usuario,$tabla,$permiso){

    $stmt = $conexion->prepare("select distinct tablas.tablas
                                        from usuarios
                                        join roles
                                        on roles.id_rol = usuarios.id_rol_usuario
                                        join rol_operacion
                                        on roles.id_rol = rol_operacion.id_rol
                                        join operaciones
                                        on operaciones.id_operaciones = rol_operacion.id_operacion
                                        join modulo
                                        on modulo.id_modulo = operaciones.id_modulo
                                        join tablas
                                        on tablas.id_tabla = modulo.id_tabla
                                        where usuarios.id_usuario=? and tablas.tablas=? and operaciones.nombre_operacion=?");
    $stmt->bind_param("iss", $id_usuario,$tabla,$permiso);

    return $stmt;
}

?>
