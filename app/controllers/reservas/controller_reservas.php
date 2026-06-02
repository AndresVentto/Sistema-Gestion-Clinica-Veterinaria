<?php
session_start();
include('../../../app/config.php');

// Validar campos requeridos
if (
    empty($_POST['id_usuario']) || 
    empty($_POST['nombre_mascota']) || 
    empty($_POST['tipo_servicio']) || 
    empty($_POST['fecha_cita']) || 
    empty($_POST['hora_cita'])
) {
    $_SESSION['mensaje'] = "Todos los campos son obligatorios.";
    $_SESSION['icono'] = 'warning';
    $_SESSION['titulo'] = '⚠️ Campos incompletos';
    header('Location: ' . $URL . '/reservar.php');
    exit();
}

$id_usuario = $_POST['id_usuario'];
$nombre_mascota = trim($_POST['nombre_mascota']);
$tipo_servicio = $_POST['tipo_servicio'];
$fecha_cita = $_POST['fecha_cita'];
$hora_cita = $_POST['hora_cita'];

$title = $tipo_servicio;
$start = $fecha_cita;
$end = $fecha_cita;
$color = "#469255";
$fecha_hora = date("Y-m-d H:i:s");

// Validar formato de fecha
if (!DateTime::createFromFormat('Y-m-d', $fecha_cita)) {
    $_SESSION['mensaje'] = "Formato de fecha inválido.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = '❌ Error de fecha';
    header('Location: ' . $URL . '/reservar.php');
    exit();
}

// No permitir fechas pasadas
if (strtotime($fecha_cita) < strtotime(date("Y-m-d"))) {
    $_SESSION['mensaje'] = "No puedes agendar citas en fechas pasadas.";
    $_SESSION['icono'] = 'warning';
    $_SESSION['titulo'] = '🕓 Fecha inválida';
    header('Location: ' . $URL . '/reservar.php');
    exit();
}

// Validar nombre de mascota
if (strlen($nombre_mascota) < 2 || strlen($nombre_mascota) > 100) {
    $_SESSION['mensaje'] = "El nombre de la mascota debe tener entre 2 y 100 caracteres.";
    $_SESSION['icono'] = 'warning';
    $_SESSION['titulo'] = '🐾 Nombre inválido';
    header('Location: ' . $URL . '/reservar.php');
    exit();
}

// Validar si ya existe una cita para ese usuario en esa fecha y hora
$consulta = $pdo->prepare("SELECT COUNT(*) FROM tbl_reservas WHERE id_usuario = :id_usuario AND fecha_cita = :fecha_cita AND hora_cita = :hora_cita");
$consulta->bindParam(':id_usuario', $id_usuario);
$consulta->bindParam(':fecha_cita', $fecha_cita);
$consulta->bindParam(':hora_cita', $hora_cita);
$consulta->execute();
$existe = $consulta->fetchColumn();

if ($existe > 0) {
    $_SESSION['mensaje'] = "Ya tienes una cita registrada para esa fecha y hora.";
    $_SESSION['icono'] = 'info';
    $_SESSION['titulo'] = '⛔ Cita duplicada';
    header('Location: ' . $URL . '/reservar.php');
    exit();
}

// Insertar cita
$sentencia = $pdo->prepare("INSERT INTO tbl_reservas 
(id_usuario, nombre_mascota, tipo_servicio, fecha_cita, hora_cita, title, start, end, color, fyh_creacion, fyh_actualizacion) 
VALUES 
(:id_usuario, :nombre_mascota, :tipo_servicio, :fecha_cita, :hora_cita, :title, :start, :end, :color, :fyh_creacion, :fyh_actualizacion)");

$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->bindParam(':nombre_mascota', $nombre_mascota);
$sentencia->bindParam(':tipo_servicio', $tipo_servicio);
$sentencia->bindParam(':fecha_cita', $fecha_cita);
$sentencia->bindParam(':hora_cita', $hora_cita);
$sentencia->bindParam(':title', $title);
$sentencia->bindParam(':start', $start);
$sentencia->bindParam(':end', $end);
$sentencia->bindParam(':color', $color);
$sentencia->bindParam(':fyh_creacion', $fecha_hora);
$sentencia->bindParam(':fyh_actualizacion', $fecha_hora);

if ($sentencia->execute()) {
    $_SESSION['mensaje'] = "La cita para <strong>$nombre_mascota</strong> fue registrada correctamente para el <strong>$fecha_cita a las $hora_cita</strong>.";
    $_SESSION['icono'] = 'success';
    $_SESSION['titulo'] = '¡Cita registrada con éxito! 🐶🐱';
    header('Location: ' . $URL . '/reservar.php');
    exit();
} else {
    $_SESSION['mensaje'] = "Ocurrió un error al intentar registrar la cita. Intenta de nuevo.";
    $_SESSION['icono'] = 'error';
    $_SESSION['titulo'] = '😿 Ups, algo salió mal';
    header('Location: ' . $URL . '/reservar.php');
    exit();
}
