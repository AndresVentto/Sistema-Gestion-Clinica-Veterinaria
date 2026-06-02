<?php
include('../../config.php');
session_start();

// Verificamos si hay sesión activa
$correo_sesion = $_SESSION['sesion_correo'] ?? "";
if (!$correo_sesion) {
    echo json_encode([]);
    exit;
}

// Obtenemos el ID del usuario actual
$sql_user = "SELECT id_usuario FROM tbl_usuarios WHERE correo = :correo";
$stmt_user = $pdo->prepare($sql_user);
$stmt_user->bindParam(':correo', $correo_sesion);
$stmt_user->execute();
$usuario = $stmt_user->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo json_encode([]);
    exit;
}

$id_usuario = $usuario['id_usuario'];

// Consultamos las reservas del usuario
$sql = "SELECT nombre_mascota, tipo_servicio, fecha_cita, hora_cita 
        FROM tbl_reservas 
        WHERE id_usuario = :id_usuario";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario);
$stmt->execute();
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Armamos los eventos para el calendario
$eventos = [];

foreach ($reservas as $reserva) {
    $start = $reserva['fecha_cita'] . 'T' . substr($reserva['hora_cita'], 0, 5) . ':00';

    $eventos[] = [
        'title' => "{$reserva['nombre_mascota']} - {$reserva['tipo_servicio']}",
        'start' => $start,
        'end'   => $start, // Mismo inicio y fin, citas fijas
        'color' => '#469255',
        'extendedProps' => [
            'descripcion' => "Servicio: {$reserva['tipo_servicio']}"
        ]
    ];
}

// Devolvemos los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($eventos);
?>
