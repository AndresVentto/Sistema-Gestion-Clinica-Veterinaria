<?php
include('../../../app/config.php');
session_start();
$nombre = trim($_POST['nombre']);
$apellido  = trim($_POST['apellido']);
$cedula  = trim($_POST['cedula']);
$correo = trim($_POST['correo']);
$contrasenna = $_POST['contrasenna'];
$contrasenna_repetida = $_POST['contrasenna_repetida'];
$rol_usuario = "CLIENTE";
// 🔍 VALIDACIONES
// 1. Validar que los campos no estén vacíos
if (
    empty($nombre) || empty($apellido) || empty($cedula) || empty($correo) ||
    empty($contrasenna) || empty($contrasenna_repetida)
) {
    $_SESSION['mensaje'] = "Todos los campos son obligatorios. Por favor, completa el formulario.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Campos vacíos ❌';
    header('Location: '.$URL.'/login/registrarme.php');
    exit;
}
// 2. Validar nombre y apellido (solo letras y espacios)
if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $apellido)) {
    $_SESSION['mensaje'] = "El nombre y apellido solo deben contener letras.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Nombre o Apellido inválido ❌';
    header('Location: '.$URL.'/login/registrarme.php');
    exit;
}
// 3. Validar que la cédula contenga solo números y tenga entre 6 y 9 dígitos
if (!preg_match("/^\d{6,9}$/", $cedula)) {
    $_SESSION['mensaje'] = "La cédula debe contener entre 6 y 9 números.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Cédula inválida ❌';
    header('Location: '.$URL.'/login/registrarme.php');
    exit;
}
// 4. Validar correo electrónico
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['mensaje'] = "El correo electrónico no es válido.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Correo inválido ❌';
    header('Location: '.$URL.'/login/registrarme.php');
    exit;
}
// 5. Validar longitud mínima de la contraseña
if (strlen($contrasenna) < 8) {
    $_SESSION['mensaje'] = "La contraseña debe tener al menos 8 caracteres.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Contraseña insegura ❌';
    header('Location: '.$URL.'/login/registrarme.php');
    exit;
}
// 6. Validar que las contraseñas coincidan
if ($contrasenna !== $contrasenna_repetida) {
    $_SESSION['mensaje'] = "Las contraseñas deben ser iguales.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Contraseñas no coinciden ❌';
    header('Location: '.$URL.'/login/registrarme.php');
    exit;
}
// ✅ Validar si el usuario ya existe
$sql = "SELECT COUNT(*) FROM tbl_usuarios WHERE correo = :correo OR cedula = :cedula";
$query = $pdo->prepare($sql);
$query->bindParam(':correo', $correo);
$query->bindParam(':cedula', $cedula);
$query->execute();
$existe = $query->fetchColumn();
if ($existe > 0) {
    $_SESSION['mensaje'] = "La Cédula: <strong>$cedula</strong> o el Correo: <strong>$correo</strong> ya esta registrados. Verifica e intenta de nuevo.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Usuario Repetido 😿';
    header('Location: '.$URL.'/login/registrarme.php');
    exit;
}
// 🟩 Insertar nuevo usuario
$contrasenna_segura = password_hash($contrasenna, PASSWORD_DEFAULT);
$sentencia = $pdo->prepare("INSERT INTO tbl_usuarios 
    (nombre, apellido, cedula, correo, contrasenna, rol_usuario, fyh_creacion)
    VALUES (:nombre, :apellido, :cedula, :correo, :contrasenna, :rol_usuario, :fyh_creacion)");
$sentencia->bindParam(':nombre', $nombre);
$sentencia->bindParam(':apellido', $apellido);
$sentencia->bindParam(':cedula', $cedula);
$sentencia->bindParam(':correo', $correo);
$sentencia->bindParam(':contrasenna', $contrasenna_segura);
$sentencia->bindParam(':rol_usuario', $rol_usuario);
$sentencia->bindParam(':fyh_creacion', $fecha_hora);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "El registro fue completado correctamente.";
    $_SESSION['icono'] = 'success';
    $_SESSION['titulo'] = 'Registro Exitoso 😸';
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasenna'];
    $sql = "SELECT * FROM tbl_usuarios WHERE correo = '$correo' ";
    $query = $pdo->prepare($sql);
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
    $contador = 0;
    foreach ( $usuarios as $usuario) {
        $contador = $contador + 1;
        $contrasena_table = $usuario['contrasenna'];
    }
    $hash = $contrasena_table ;
    if ($contador > 0 && password_verify($contrasena, $hash)) {
        echo "✅ Bienvenido al sistema";
        session_start();
        $_SESSION['sesion_correo'] = $correo;
        header('Location: '.$URL.'/');
    } else {
        echo "❌ ERROR: NO SE PUDO REGISTRAR";
        header('Location: '.$URL.'/login/registrarme.php');
    }
} else {
    $_SESSION['mensaje'] = "No se pudo registrar el usuario. Intenta de nuevo.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Error ❌';
    header('Location: '.$URL.'/login/registrarme.php');
}
