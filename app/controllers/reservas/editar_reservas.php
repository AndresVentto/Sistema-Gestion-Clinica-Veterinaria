<?php
include('../../../app/config.php');
session_start();

// Validar campos obligatorios
$campos_obligatorios = [
    'id_reserva', 'nombre_mascota', 'tipo_servicio',
    'fecha_cita', 'hora_cita'
];

foreach ($campos_obligatorios as $campo) {
    if (empty($_POST[$campo])) {
        $_SESSION['mensaje'] = "Por favor, completa todos los campos obligatorios.";
        $_SESSION['icono'] = 'error';
        $_SESSION['titulo'] = 'Campos Vacíos ❌';
        header('Location: ' . $URL . '/admin/citas/editar_reservas.php?id_reserva=' . $_POST['id_reserva']);
        exit();
    }
}

// Capturar variables
$id_reserva     = $_POST['id_reserva'];
$nombre_mascota = trim($_POST['nombre_mascota']);
$tipo_servicio  = $_POST['tipo_servicio'];
$fecha_cita     = $_POST['fecha_cita'];
$hora_cita      = $_POST['hora_cita'];

// Validar fecha
$fecha_timestamp = strtotime($fecha_cita);
$hoy_timestamp = strtotime(date('Y-m-d'));

if (!$fecha_timestamp) {
    $_SESSION['mensaje'] = "La fecha ingresada no es válida.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Fecha inválida 📅';
    header('Location: ' . $URL . '/admin/citas/editar_reservas.php?id_reserva=' . $id_reserva);
    exit();
}

if ($fecha_timestamp < $hoy_timestamp) {
    $_SESSION['mensaje'] = "No se puede reservar para una fecha pasada.";
    $_SESSION['icono'] = 'warning';
    $_SESSION['titulo'] = 'Fecha no permitida ⛔';
    header('Location: ' . $URL . '/admin/citas/editar_reservas.php?id_reserva=' . $id_reserva);
    exit();
}

// Validar hora
$horarios_validos = [
    '08:00 - 09:00', '09:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00',
    '14:00 - 15:00', '15:00 - 16:00', '16:00 - 17:00', '17:00 - 18:00'
];

if (!in_array($hora_cita, $horarios_validos)) {
    $_SESSION['mensaje'] = "El horario seleccionado no es válido.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Horario inválido 🕒';
    header('Location: ' . $URL . '/admin/citas/editar_reservas.php?id_reserva=' . $id_reserva);
    exit();
}

// Validar tipo de servicio
$servicios_validos = ['Consulta médica', 'Vacunación', 'Esterilización', 'Peluquería'];
if (!in_array($tipo_servicio, $servicios_validos)) {
    $_SESSION['mensaje'] = "El tipo de servicio seleccionado no es válido.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Servicio inválido 🚫';
    header('Location: ' . $URL . '/admin/citas/editar_reservas.php?id_reserva=' . $id_reserva);
    exit();
}

// Guardar en la base de datos
$sentencia = $pdo->prepare("UPDATE tbl_reservas SET 
    nombre_mascota = :nombre_mascota,
    tipo_servicio = :tipo_servicio,
    fecha_cita = :fecha_cita,
    hora_cita = :hora_cita,
    fyh_actualizacion = :fyh_actualizacion
WHERE id_reserva = :id_reserva");

$sentencia->bindParam(':nombre_mascota', $nombre_mascota);
$sentencia->bindParam(':tipo_servicio', $tipo_servicio);
$sentencia->bindParam(':fecha_cita', $fecha_cita);
$sentencia->bindParam(':hora_cita', $hora_cita);
$sentencia->bindParam(':fyh_actualizacion', $fecha_hora); // viene de config.php
$sentencia->bindParam(':id_reserva', $id_reserva);

if ($sentencia->execute()) {
    $_SESSION['mensaje'] = "La cita fue actualizada correctamente.";
    $_SESSION['icono'] = 'success';
    $_SESSION['titulo'] = '¡Reserva Editada! ✅';
    header('Location: ' . $URL . '/admin/citas/');
    exit();
} else {
    $_SESSION['mensaje'] = "Hubo un error al actualizar la reserva.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Error al Actualizar ❌';
    header('Location: ' . $URL . '/admin/citas/editar_reservas.php?id_reserva=' . $id_reserva);
    exit();
}
