<?php

include('../../../app/config.php');

$nombre = $_POST['nombre'];
$apellido  = $_POST['apellido'];
$cedula  = $_POST['cedula'];
$correo = $_POST['correo'];
$contrasenna = $_POST['contrasenna'];
$contrasenna_repetida = $_POST['contrasenna_repetida'];
$rol_usuario = $_POST['rol_usuario'];

// 🔍 VALIDACIONES
session_start(); // 🔓 Necesario para usar $_SESSION

// 1. Validar que los campos no estén vacíos
if (
    empty($nombre) || empty($apellido) || empty($cedula) || empty($correo) ||
    empty($contrasenna) || empty($contrasenna_repetida) || empty($rol_usuario)
) {
    $_SESSION['mensaje'] = "Todos los campos son obligatorios. Por favor, completa el formulario.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Campos vacíos ❌';
    header('Location: '.$URL.'/admin/usuarios/crear_usuario.php');
    exit();
}

// 2. Validar nombre y apellido (solo letras y espacios)
if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $apellido)) {
    $_SESSION['mensaje'] = "El nombre y apellido solo deben contener letras.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Nombre ó Apellido inválido ❌';
    header('Location: '.$URL.'/admin/usuarios/crear_usuario.php');
    exit();
}

// 3. Validar que la cédula contenga solo números
if (!preg_match("/^[0-9]+$/", $cedula)) {
    $_SESSION['mensaje'] = "La cédula debe contener solo números.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Cédula inválida ❌';
    header('Location: '.$URL.'/admin/usuarios/crear_usuario.php');
    exit();
}

// 3.5. Validar que la cédula tenga entre 6 y 9 dígitos
if (strlen($cedula) < 6 || strlen($cedula) > 9) {
    $_SESSION['mensaje'] = "La cédula solo debe contener entre 6 y 9 dígitos.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Cédula inválida ❌';
    header('Location: '.$URL.'/admin/usuarios/crear_usuario.php');
    exit();
}

// 4. Validar correo electrónico
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['mensaje'] = "El correo electrónico no es válido.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Correo inválido ❌';
    header('Location: '.$URL.'/admin/usuarios/crear_usuario.php');
    exit();
}

// 5. Validar longitud mínima de la contraseña
if (strlen($contrasenna) < 8) {
    $_SESSION['mensaje'] = "La contraseña debe tener al menos 8 caracteres.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Contraseña insegura ❌';
    header('Location: '.$URL.'/admin/usuarios/crear_usuario.php');
    exit();
}

// ✅ Si pasa todas las validaciones, verificar si el usuario ya existe

$contador = 0;

$sql = "SELECT * FROM tbl_usuarios WHERE correo = '$correo' OR cedula = '$cedula' ";
$query = $pdo->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $contador++;
}

if ($contador > 0) {
    $_SESSION['mensaje'] = "Cédula: <strong>$cedula</strong> o Correo: <strong>$correo</strong> ya registrados. Verifica e intenta de nuevo.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Usuario Repetido 😿';
    header('Location: '.$URL.'/admin/usuarios/crear_usuario.php');
    exit();
} else {
    // echo "Este Usuario es Nuevo";
    if ($contrasenna == $contrasenna_repetida) {
        $contrasenna = password_hash($contrasenna, PASSWORD_DEFAULT);

        $sentencia = $pdo->prepare("INSERT INTO tbl_usuarios
            (nombre, apellido, cedula, correo, contrasenna, rol_usuario, fyh_creacion)
            VALUES(:nombre, :apellido, :cedula, :correo, :contrasenna, :rol_usuario, :fyh_creacion)");

        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':apellido', $apellido);
        $sentencia->bindParam(':cedula', $cedula);
        $sentencia->bindParam(':correo', $correo);
        $sentencia->bindParam(':contrasenna', $contrasenna);
        $sentencia->bindParam(':rol_usuario', $rol_usuario);
        $sentencia->bindParam(':fyh_creacion', $fecha_hora);

        if ($sentencia->execute()) {
            $_SESSION['mensaje'] = "El registro fue completado correctamente.";
            $_SESSION['icono'] = 'success';
            $_SESSION['titulo'] = 'Registro Exitoso! 😸';
            header('Location: '.$URL.'/admin/usuarios');
            exit();
        } else {
            $_SESSION['mensaje'] = "No se pudo registrar.";
            $_SESSION['icono'] = 'error';
            $_SESSION['titulo'] = 'Error ❌';
            header('Location: '.$URL.'/admin/usuarios/crear_usuario.php');
            exit();
        }
    } else {
        $_SESSION['mensaje'] = "Las contraseñas deben ser iguales.";
        $_SESSION['icono'] = 'error';
        $_SESSION['titulo'] = 'Error ❌';
        header('Location: '.$URL.'/admin/usuarios/crear_usuario.php');
        exit();
    }
}
