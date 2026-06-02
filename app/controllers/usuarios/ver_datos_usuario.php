<?php

$sql = "SELECT * FROM tbl_usuarios WHERE id_usuario = :id_usuario";
$query = $pdo->prepare($sql);
$query->execute(['id_usuario' => $id_usuario]);

$usuario = $query->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    $nombre = $usuario['nombre'];
    $apellido = $usuario['apellido'];
    $cedula = $usuario['cedula'];
    $correo  = $usuario['correo'];
    $rol_usuario = $usuario['rol_usuario'];
    $fyh_creacion = $usuario['fyh_creacion'];
} else {
    echo "Usuario no encontrado. ❌";
    exit;
}

?>