<?php
include('../../../app/config.php');
session_start();

// Validar campos obligatorios
$campos_obligatorios = ['id_usuario', 'nombre_mascota', 'tipo_servicio', 'fecha_cita', 'hora_cita'];
foreach ($campos_obligatorios as $campo) {
    if (empty($_POST[$campo])) {
        $_SESSION['mensaje'] = "Todos los campos son obligatorios.";
        $_SESSION['icono'] = 'error';
        $_SESSION['titulo'] = 'Campos Vacíos ❌';
        header('Location: ' . $URL . '/admin/citas/crear_cita.php');
        exit();
    }
}

// Capturar y validar valores
$id_usuario = $_POST['id_usuario'];
$nombre_mascota = $_POST['nombre_mascota'];
$tipo_servicio = $_POST['tipo_servicio'];
$fecha_cita = $_POST['fecha_cita'];
$hora_cita = $_POST['hora_cita'];

// Validar formato de fecha
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_cita)) {
    $_SESSION['mensaje'] = "Formato de fecha inválido.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Fecha Inválida ❌';
    header('Location: ' . $URL . '/admin/citas/crear_cita.php');
    exit();
}

// Validar que la fecha no sea en el pasado
$fecha_actual = date('Y-m-d');
if ($fecha_cita < $fecha_actual) {
    $_SESSION['mensaje'] = "No puedes agendar una cita en una fecha pasada.";
    $_SESSION['icono'] = 'warning';
    $_SESSION['titulo'] = 'Fecha Inválida ⚠️';
    header('Location: ' . $URL . '/admin/citas/crear_cita.php');
    exit();
}

// Validar disponibilidad de la cita
$verificar = $pdo->prepare("SELECT COUNT(*) FROM tbl_reservas WHERE fecha_cita = :fecha AND hora_cita = :hora");
$verificar->bindParam(':fecha', $fecha_cita);
$verificar->bindParam(':hora', $hora_cita);
$verificar->execute();
if ($verificar->fetchColumn() > 0) {
    $_SESSION['mensaje'] = "Ya existe una cita en ese horario.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Horario Ocupado ❌';
    header('Location: ' . $URL . '/admin/citas/crear_cita.php');
    exit();
}

// Insertar la nueva reserva
$insertar = $pdo->prepare("INSERT INTO tbl_reservas 
    (id_usuario, nombre_mascota, tipo_servicio, fecha_cita, hora_cita, fyh_creacion) 
    VALUES (:id_usuario, :nombre_mascota, :tipo_servicio, :fecha_cita, :hora_cita, :fyh_creacion)");

$insertar->bindParam(':id_usuario', $id_usuario);
$insertar->bindParam(':nombre_mascota', $nombre_mascota);
$insertar->bindParam(':tipo_servicio', $tipo_servicio);
$insertar->bindParam(':fecha_cita', $fecha_cita);
$insertar->bindParam(':hora_cita', $hora_cita);
$insertar->bindParam(':fyh_creacion', $fecha_hora); // viene de config.php

if ($insertar->execute()) {
    $_SESSION['mensaje'] = "La cita fue registrada correctamente.";
    $_SESSION['icono'] = 'success';
    $_SESSION['titulo'] = '¡Cita Registrada! ✅';
    header('Location: ' . $URL . '/admin/citas/');
    exit();
} else {
    $_SESSION['mensaje'] = "Hubo un error al registrar la cita.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = 'Error al Registrar ❌';
    header('Location: ' . $URL . '/admin/citas/crear_cita.php');
    exit();
}
?>
