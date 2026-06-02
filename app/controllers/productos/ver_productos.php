<?php

$sql = "SELECT produc.*, usuarios.nombre, usuarios.apellido, usuarios.rol_usuario
FROM tbl_productos AS produc 
INNER JOIN tbl_usuarios AS usuarios 
    ON usuarios.id_usuario = produc.id_usuario 
WHERE produc.id_producto = :id_producto";

$query = $pdo->prepare($sql);
$query->bindParam(':id_producto', $id_producto);
$query->execute();

$producto = $query->fetch(PDO::FETCH_ASSOC);

if ($producto) {
    $codigo = $producto['codigo'];
    $nombre_producto = $producto['nombre_producto'];
    $descripcion = $producto['descripcion_producto'];
    $stock = $producto['stock'];
    $stock_minimo = $producto['stock_minimo'];
    $stock_maximo = $producto['stock_maximo'];
    $precio_compra = $producto['precio_compra'];
    $precio_venta = $producto['precio_venta'];
    $fecha_ingreso = $producto['fecha_ingreso'];
    $fyh_creacion = $producto['fyh_creacion'];
    $imagen_producto = $producto['imagen_producto'];
    $id_usuario = $producto['id_usuario'];
    $nombre_usuario = $producto['nombre'] . ' ' . $producto['apellido'];
    $rol_usuario = $producto['rol_usuario'];

} else {
    // Por si no se encuentra ningún producto
    echo "Usuario no encontrado. ❌";
    exit;
}
?>