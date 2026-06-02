<?php

include('../../../app/config.php');

$id_usuario = $_POST['id_usuario'];

$sentencia = $pdo->prepare("DELETE FROM tbl_usuarios WHERE id_usuario = :id_usuario");
$sentencia->bindParam(':id_usuario', $id_usuario);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "El usuario fue eliminado correctamente.";
    $_SESSION['icono'] = 'success';
    $_SESSION['titulo'] = '¡Eliminado! 🗑️';
    header('Location: '.$URL.'/admin/usuarios');
    exit();
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo eliminar el usuario.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Error ❌';
    header('Location: '.$URL.'/admin/usuarios');
    exit();
}