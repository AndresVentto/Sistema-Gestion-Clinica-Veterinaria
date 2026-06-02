<?php
include('../../../app/config.php');
session_start(); // ¡Esto debe ir arriba!

// Validar campos requeridos
$campos_obligatorios = ['codigo', 'nombre_producto', 'stock', 'stock_minimo', 'stock_maximo', 'precio_compra', 'precio_venta', 'fecha_ingreso', 'id_usuario'];

foreach ($campos_obligatorios as $campo) {
    if (empty($_POST[$campo])) {
        $_SESSION['mensaje'] = "Todos los campos son obligatorios. Por favor, completa el formulario.";
        $_SESSION['icono'] = 'error';
        $_SESSION['titulo'] = 'Campos vacíos ❌';
        header('Location: ' . $URL . '/admin/productos/crear_productos.php');
        exit();
    }
}

// Recibir variables
$codigo = $_POST['codigo'];
$nombre_producto = $_POST['nombre_producto'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$id_usuario = $_POST['id_usuario'];
 

// Validar que la fecha de ingreso no tenga más de 5 años
$fecha_ingreso_timestamp = strtotime($fecha_ingreso);
$fecha_limite = strtotime('-5 years');

if ($fecha_ingreso_timestamp < $fecha_limite) {
    $_SESSION['mensaje'] = "La fecha de ingreso no puede ser anterior a 5 años desde hoy.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Fecha inválida ⏳';
    header('Location: ' . $URL . '/admin/productos/crear_productos.php');
    exit();
}

if ($fecha_ingreso_timestamp > time()) {
    $_SESSION['mensaje'] = "La fecha de ingreso no puede ser una fecha futura.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Fecha inválida ⏳';
    header('Location: ' . $URL . '/admin/productos/crear_productos.php');
    exit();
}

// Validaciones numéricas
if ($stock < 0 || $stock_minimo < 0 || $stock_maximo < 0 || $precio_compra < 0 || $precio_venta < 0) {
    $_SESSION['mensaje'] = "Los valores numéricos no pueden ser negativos.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Error de valores ❌';
    header('Location: ' . $URL . '/admin/productos/crear_productos.php');
    exit();
}

// Lógica de negocio
if ($stock_minimo >= $stock_maximo) {
    $_SESSION['mensaje'] = "El stock mínimo debe ser menor al stock máximo.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Stock inválido';
    header('Location: ' . $URL . '/admin/productos/crear_productos.php');
    exit();
}

if ($precio_venta <= $precio_compra) {
    $_SESSION['mensaje'] = "El precio de venta debe ser mayor al precio de compra.";
    $_SESSION['icono'] = 'warning';
    $_SESSION['titulo'] = 'Precios mal definidos 📈';
    header('Location: ' . $URL . '/admin/productos/crear_productos.php');
    exit();
}

// Validación de imagen
$permitidos = ['image/jpeg', 'image/png', 'image/webp'];
if ($_FILES['imagen']['name'] != '') {
    $tipo_imagen = $_FILES['imagen']['type'];
    $tamano_imagen = $_FILES['imagen']['size'];

    // Validar formato de imagen
    if (!in_array($tipo_imagen, $permitidos)) {
        $_SESSION['mensaje'] = "Formato de imagen no permitido. Usa JPG, PNG o WEBP.";
        $_SESSION['icono'] = 'error';
        $_SESSION['titulo'] = 'Imagen inválida';
        header('Location: ' . $URL . '/admin/productos/crear_productos.php');
        exit();
    }

    // Validar tamaño de la imagen (máximo 4MB)
    $tamano_maximo = 4 * 1024 * 1024; // 4 megas en bytes
    if ($_FILES['imagen']['size'] > $tamano_maximo) {
        $_SESSION['mensaje'] = "La imagen supera el tamaño máximo permitido de 2MB.";
        $_SESSION['icono'] = 'warning';
        $_SESSION['titulo'] = 'Imagen muy grande';
        header('Location: ' . $URL . '/admin/productos/crear_productos.php');
        exit();
    }

    // Si pasa las validaciones, mover la imagen a la carpeta destino
    $nombre_imagen = date('Y-m-d-h-i-s') . $_FILES['imagen']['name'];
    $location = "../../../public/img/productos/" . $nombre_imagen;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $location);
} else {
    $nombre_imagen = ''; // Por si no se sube imagen
}

// Guardar en BD
$sentencia = $pdo->prepare("INSERT INTO tbl_productos 
    (codigo, nombre_producto, descripcion_producto, imagen_producto, stock, stock_minimo, stock_maximo, precio_compra, precio_venta, fecha_ingreso, fyh_creacion, fyh_actualizacion, id_usuario) 
    VALUES 
    (:codigo, :nombre_producto, :descripcion, :imagen, :stock, :stock_minimo, :stock_maximo, :precio_compra, :precio_venta, :fecha_ingreso, :fyh_creacion, :fyh_actualizacion, :id_usuario)");

$sentencia->bindParam(':codigo', $codigo);
$sentencia->bindParam(':nombre_producto', $nombre_producto);
$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':imagen', $nombre_imagen);
$sentencia->bindParam(':stock', $stock);
$sentencia->bindParam(':stock_minimo', $stock_minimo);
$sentencia->bindParam(':stock_maximo', $stock_maximo);
$sentencia->bindParam(':precio_compra', $precio_compra);
$sentencia->bindParam(':precio_venta', $precio_venta);
$sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam(':fyh_creacion', $fecha_hora);
$sentencia->bindParam(':fyh_actualizacion', $fecha_hora);
$sentencia->bindParam(':id_usuario', $id_usuario);

if ($sentencia->execute()) {
    $_SESSION['mensaje'] = "Se registró el producto correctamente.";
    $_SESSION['icono'] = 'success';
    $_SESSION['titulo'] = '¡Registro Exitoso! 😸';
    header('Location: ' . $URL . '/admin/productos/');
    exit();
} else {
    $_SESSION['mensaje'] = "No se pudo registrar.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Error ❌';
    header('Location: ' . $URL . '/admin/productos/crear_productos.php');
    exit();
}
?>