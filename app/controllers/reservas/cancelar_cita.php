<?php

include('../../../app/config.php');

$id_reserva = $_POST['id_reserva'];

$sentencia = $pdo->prepare("DELETE FROM tbl_reservas WHERE id_reserva = :id_reserva");
$sentencia->bindParam(':id_reserva', $id_reserva);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "La reserva fue eliminada correctamente.";
    $_SESSION['icono'] = 'success';
    $_SESSION['titulo'] = '¡Eliminada! 🗑️';
    header('Location: '.$URL.'/admin/citas');
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo eliminar la reserva.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Error ❌';
    header('Location: '.$URL.'/admin/citas');
}
?>
