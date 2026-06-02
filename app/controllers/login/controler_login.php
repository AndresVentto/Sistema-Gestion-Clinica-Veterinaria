<?php

include('../../config.php');

$correo = $_POST['correo'];
$contrasena = $_POST['contrasenna'];

$sql = "SELECT * FROM tbl_usuarios WHERE correo = :correo";
$query = $pdo->prepare($sql);
$query->bindParam(':correo', $correo, PDO::PARAM_STR);
$query->execute();
$usuario = $query->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($contrasena, $usuario['contrasenna'])) {
    session_start();
    $_SESSION['sesion_correo'] = $correo;
    $_SESSION['rol_usuario'] = $usuario['rol_usuario'];

    // Redirección según el rol exacto de la BD
    if ($usuario['rol_usuario'] === 'CLIENTE') {
        header('Location: ' . $URL . '/reservar.php');

    } elseif ($usuario['rol_usuario'] === 'ADMINISTRADOR') {
        header('Location: '.$URL.'/admin/index.php');

    } else {
        // Rol desconocido
        $_SESSION['mensaje'] = 'Rol de usuario no reconocido.';
        $_SESSION['icono'] = 'warning';
        $_SESSION['titulo'] = 'Error de acceso';
        header('Location: '.$URL.'/reservar.php');
    }

    exit;
    
} else {
    session_start();
    $_SESSION['mensaje'] = 'Usuario o contraseña incorrectos.';
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Acceso denegado';
    header('Location: ' . $URL . '/login/index.php');
    exit;
}


