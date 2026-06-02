<?php
include('../../../app/config.php');
session_start();

$campos_obligatorios = [
    'nombre_producto', 'stock', 'stock_minimo',
    'stock_maximo', 'precio_compra', 'precio_venta',
    'fecha_ingreso', 'id_producto'
];

foreach ($campos_obligatorios as $campo) {
    if (empty($_POST[$campo])) {
        $_SESSION['mensaje'] = "Todos los campos son obligatorios. Por favor, completa el formulario.";
        $_SESSION['icono'] = 'error';
        $_SESSION['titulo'] = 'Campos vacíos ❌';
        header('Location: ' . $URL . '/admin/productos/editar_productos.php?id_producto=' . $_POST['id_producto']);
        exit();
    }
}

// Variables
$id_producto = $_POST['id_producto'];
$nombre_producto = $_POST['nombre_producto'];
$descripcion = $_POST['descripcion'] ?? '';
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$fecha_ingreso_timestamp = strtotime($fecha_ingreso);
$fecha_limite = strtotime('-5 years');


// IMAGEN
if ($_FILES['imagen']['name'] != '') {
    // Validaciones
    $permitidos = ['image/jpeg', 'image/png', 'image/webp'];
    $tipo_imagen = $_FILES['imagen']['type'];
    $tamano_maximo = 4 * 1024 * 1024; // 4 MB
    if (!in_array($tipo_imagen, $permitidos)) {
        $_SESSION['mensaje'] = "Formato de imagen no permitido. Usa JPG, PNG o WEBP.";
        $_SESSION['icono'] = 'error';
        $_SESSION['titulo'] = 'Imagen inválida';
        header('Location: ' . $URL . '/admin/productos/editar_productos.php?id_producto=' . $id_producto);
        exit();
    }
    if ($_FILES['imagen']['size'] > $tamano_maximo) {
        $_SESSION['mensaje'] = "La imagen supera el tamaño máximo permitido de 4MB.";
        $_SESSION['icono'] = 'warning';
        $_SESSION['titulo'] = 'Imagen muy grande';
        header('Location: ' . $URL . '/admin/productos/editar_productos.php?id_producto=' . $id_producto);
        exit();
    }
    // Guardar imagen nueva
    $nombre_imagen = date('Y-m-d-H-i-s') . '-' . $_FILES['imagen']['name'];
    $location = "../../../public/img/productos/" . $nombre_imagen;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $location);

    // Elimina la imagen anterior si existe
    $ruta_imagen_anterior = "../../../public/img/productos/" . $_POST['imagen_actual'];
    if (file_exists($ruta_imagen_anterior) && $_POST['imagen_actual'] != '') {
        unlink($ruta_imagen_anterior);
    }
} else {
    // Si no se carga una nueva, se mantiene la imagen actual
    $nombre_imagen = $_POST['imagen_actual'];
}



// Validaciones de fecha
if ($fecha_ingreso_timestamp < $fecha_limite) {
    $_SESSION['mensaje'] = "La fecha de ingreso no puede ser anterior a 5 años desde hoy.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Fecha inválida ⏳';
    header('Location: ' . $URL . '/admin/productos/editar_productos.php?id_producto=' . $id_producto);
    exit();
}

if ($fecha_ingreso_timestamp > time()) {
    $_SESSION['mensaje'] = "La fecha de ingreso no puede ser una fecha futura.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Fecha inválida ⏳';
    header('Location: ' . $URL . '/admin/productos/editar_productos.php?id_producto=' . $id_producto);
    exit();
}

// Validaciones numéricas
if ($stock < 0 || $stock_minimo < 0 || $stock_maximo < 0 || $precio_compra < 0 || $precio_venta < 0) {
    $_SESSION['mensaje'] = "Los valores numéricos no pueden ser negativos.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Error de valores ❌';
    header('Location: ' . $URL . '/admin/productos/editar_productos.php?id_producto=' . $id_producto);
    exit();
}

// Reglas de negocio
if ($stock_minimo >= $stock_maximo) {
    $_SESSION['mensaje'] = "El stock mínimo debe ser menor al stock máximo.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Stock inválido';
    header('Location: ' . $URL . '/admin/productos/editar_productos.php?id_producto=' . $id_producto);
    exit();
}

if ($precio_venta <= $precio_compra) {
    $_SESSION['mensaje'] = "El precio de venta debe ser mayor al precio de compra.";
    $_SESSION['icono'] = 'warning';
    $_SESSION['titulo'] = 'Precios mal definidos 📈';
    header('Location: ' . $URL . '/admin/productos/editar_productos.php?id_producto=' . $id_producto);
    exit();
}

// Guardar en BD
$sentencia = $pdo->prepare("UPDATE tbl_productos SET
    nombre_producto = :nombre_producto,
    descripcion_producto = :descripcion,
    imagen_producto = :imagen,
    stock = :stock,
    stock_minimo = :stock_minimo,
    stock_maximo = :stock_maximo,
    precio_compra = :precio_compra,
    precio_venta = :precio_venta,
    fecha_ingreso = :fecha_ingreso,
    fyh_actualizacion = :fyh_actualizacion
WHERE id_producto = :id_producto");

$sentencia->bindParam(':nombre_producto', $nombre_producto);
$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':imagen', $nombre_imagen);
$sentencia->bindParam(':stock', $stock);
$sentencia->bindParam(':stock_minimo', $stock_minimo);
$sentencia->bindParam(':stock_maximo', $stock_maximo);
$sentencia->bindParam(':precio_compra', $precio_compra);
$sentencia->bindParam(':precio_venta', $precio_venta);
$sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam(':fyh_actualizacion', $fecha_hora); // Desde config.php
$sentencia->bindParam(':id_producto', $id_producto);

if ($sentencia->execute()) {
    $_SESSION['mensaje'] = "Los datos del producto se actualizaron correctamente.";
    $_SESSION['icono'] = 'success';
    $_SESSION['titulo'] = '¡Actualización Exitosa! ✅';
    header('Location: ' . $URL . '/admin/productos/');
    exit();
} else {
    $_SESSION['mensaje'] = "Ocurrió un error al actualizar. Intenta de nuevo.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = '¡Error al actualizar! ❌';
    header('Location: ' . $URL . '/admin/productos/editar_productos.php?id_producto=' . $id_producto);
    exit();
}
