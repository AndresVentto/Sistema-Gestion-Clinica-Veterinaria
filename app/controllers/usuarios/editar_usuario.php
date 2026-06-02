<?php
include('../../../app/config.php');
session_start(); // Solo una vez

// Captura de datos
$id_usuario = $_POST['id_usuario'];
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$cedula = trim($_POST['cedula']);
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : ''; // Por si no se envía
$contrasenna = $_POST['contrasenna'];
$contrasenna_repetida = $_POST['contrasenna_repetida'];
$rol_usuario = trim($_POST['rol_usuario']);

// Validaciones
if (empty($nombre) || empty($apellido) || empty($cedula) || empty($rol_usuario)) {
    $_SESSION['mensaje'] = "Todos los campos obligatorios deben estar llenos.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Campos vacíos ❌';
    header('Location: '.$URL.'/admin/usuarios/editar_usuario.php?id_usuario='.$id_usuario);
    exit();
}

if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $apellido)) {
    $_SESSION['mensaje'] = "El nombre y apellido solo deben contener letras.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Nombre ó Apellido inválido ❌';
    header('Location: '.$URL.'/admin/usuarios/editar_usuario.php?id_usuario='.$id_usuario);
    exit();
}

if (!preg_match("/^[0-9]+$/", $cedula)) {
    $_SESSION['mensaje'] = "La cédula debe contener solo números.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Cédula inválida ❌';
    header('Location: '.$URL.'/admin/usuarios/editar_usuario.php?id_usuario='.$id_usuario);
    exit();
}

if (strlen($cedula) < 6 || strlen($cedula) > 9) {
    $_SESSION['mensaje'] = "La cédula debe tener entre 6 y 9 dígitos.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Cédula inválida ❌';
    header('Location: '.$URL.'/admin/usuarios/editar_usuario.php?id_usuario='.$id_usuario);
    exit();
}

// Lógica: ¿Editar contraseña o no?
$actualizar_contrasenna = false;

if (!empty($contrasenna)) {
    if ($contrasenna !== $contrasenna_repetida) {
        $_SESSION['mensaje'] = "Las contraseñas deben ser iguales.";
        $_SESSION['icono'] = 'error';
        $_SESSION['titulo'] = 'Contraseñas distintas ❌';
        header('Location: '.$URL.'/admin/usuarios/editar_usuario.php?id_usuario='.$id_usuario);
        exit();
    }

    if (strlen($contrasenna) < 8) {
        $_SESSION['mensaje'] = "La contraseña debe tener al menos 8 caracteres.";
        $_SESSION['icono'] = 'error';
        $_SESSION['titulo'] = 'Contraseña insegura ❌';
        header('Location: '.$URL.'/admin/usuarios/editar_usuario.php?id_usuario='.$id_usuario);
        exit();
    }

    $contrasenna_hash = password_hash($contrasenna, PASSWORD_DEFAULT);
    $actualizar_contrasenna = true;
}

// Actualizar en base de datos
if ($actualizar_contrasenna) {
    $sql = "UPDATE tbl_usuarios SET 
        nombre=:nombre,
        apellido=:apellido,
        cedula=:cedula,
        contrasenna=:contrasenna,
        rol_usuario=:rol_usuario,
        fyh_actualizacion=:fyh_actualizacion
        WHERE id_usuario=:id_usuario";
} else {
    $sql = "UPDATE tbl_usuarios SET 
        nombre=:nombre,
        apellido=:apellido,
        cedula=:cedula,
        rol_usuario=:rol_usuario,
        fyh_actualizacion=:fyh_actualizacion
        WHERE id_usuario=:id_usuario";
}

$sentencia = $pdo->prepare($sql);
$sentencia->bindParam(':nombre', $nombre);
$sentencia->bindParam(':apellido', $apellido);
$sentencia->bindParam(':cedula', $cedula);
$sentencia->bindParam(':rol_usuario', $rol_usuario);
$sentencia->bindParam(':fyh_actualizacion', $fecha_hora);
$sentencia->bindParam(':id_usuario', $id_usuario);

if ($actualizar_contrasenna) {
    $sentencia->bindParam(':contrasenna', $contrasenna_hash);
}

if ($sentencia->execute()) {
    $_SESSION['mensaje'] = "Los datos del usuario se actualizaron correctamente.";
    $_SESSION['icono'] = 'success';
    $_SESSION['titulo'] = '¡Actualización Exitosa! ✅';
    header('Location: '.$URL.'/admin/usuarios/');
} else {
    $_SESSION['mensaje'] = "Ocurrió un error al actualizar. Intenta de nuevo.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = '¡Error al actualizar! ❌';
    header('Location: '.$URL.'/admin/usuarios/editar_usuario.php?id_usuario='.$id_usuario);
}
?>
