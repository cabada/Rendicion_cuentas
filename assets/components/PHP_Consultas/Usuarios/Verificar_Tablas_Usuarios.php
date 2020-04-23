<?php
function consultaTablas($conexion,$id_usuario){

$stmt = $conexion->prepare("select distinct roles.nombre_rol,
                                            tablas.tablas
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
                                        where usuarios.id_usuario=?");
$stmt->bind_param("i", $id_usuario);

return $stmt;
}

?>