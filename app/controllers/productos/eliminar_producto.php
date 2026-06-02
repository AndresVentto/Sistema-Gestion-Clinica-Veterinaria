<?php

include('../../../app/config.php');

$id_producto = $_POST['id_producto'];

// Depuración: Verifica que el ID del producto está llegando correctamente
if (empty($id_producto)) {
    echo "No se recibió el ID del producto.";
    exit;
}

// Preparar la sentencia para eliminar
$sentencia = $pdo->prepare("DELETE FROM tbl_productos WHERE id_producto = :id_producto");
$sentencia->bindParam(':id_producto', $id_producto);

if ($sentencia->execute()) {
    // Éxito
    session_start();
    $_SESSION['mensaje'] = "El producto fue eliminado correctamente.";
    $_SESSION['icono'] = 'success';
    $_SESSION['titulo'] = '¡Eliminado! 🗑️';
    header('Location: '.$URL.'/admin/productos');
} else {
    // Error: Agregar manejo de errores
    $errorInfo = $sentencia->errorInfo();  // Captura el error de la consulta
    session_start();
    $_SESSION['mensaje'] = "No se pudo eliminar el producto: " . $errorInfo[2];  // Mostrar el error SQL
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Error ❌';
    header('Location: '.$URL.'/admin/productos');
}
?>
