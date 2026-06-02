<?php

include('../../../app/config.php');

$id_reserva = $_POST['id_reserva'];

// Verificar si llegó el ID de la reserva
if (empty($id_reserva)) {
    echo "No se recibió el ID de la reserva.";
    exit;
}

// Preparar la sentencia para eliminar
$sentencia = $pdo->prepare("DELETE FROM tbl_reservas WHERE id_reserva = :id_reserva");
$sentencia->bindParam(':id_reserva', $id_reserva);

if ($sentencia->execute()) {
    // Éxito
    session_start();
    $_SESSION['mensaje'] = "La cita fue cancelada correctamente.";
    $_SESSION['icono'] = 'success';
    $_SESSION['titulo'] = '¡Cita eliminada! 🗑️';
    header('Location: '.$URL.'/admin/citas');
} else {
    // Error
    $errorInfo = $sentencia->errorInfo();
    session_start();
    $_SESSION['mensaje'] = "No se pudo cancelar la cita: " . $errorInfo[2];
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Error ❌';
    header('Location: '.$URL.'/admin/citas');
}

?>