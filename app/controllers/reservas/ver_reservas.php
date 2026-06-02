<?php

$sql = "SELECT res.*, usu.nombre, usu.apellido, usu.rol_usuario, usu.correo 
FROM tbl_reservas AS res
INNER JOIN tbl_usuarios AS usu ON usu.id_usuario = res.id_usuario
WHERE res.id_reserva = :id_reserva";

$query = $pdo->prepare($sql);
$query->bindParam(':id_reserva', $id_reserva);
$query->execute();

$reserva = $query->fetch(PDO::FETCH_ASSOC);

if ($reserva) {
    // Puedes extraer valores si deseas usarlos directamente
    $nombre_mascota = $reserva['nombre_mascota'];
    $tipo_servicio = $reserva['tipo_servicio'];
    $fecha_cita = $reserva['fecha_cita'];
    $hora_cita = $reserva['hora_cita'];
    $fyh_creacion = $reserva['fyh_creacion'];
    $fyh_actualizacion = $reserva['fyh_actualizacion'];
    $id_usuario = $reserva['id_usuario'];
    $nombre_usuario = $reserva['nombre'] . ' ' . $reserva['apellido'];
    $correo = $reserva['correo'];
    $rol_usuario = $reserva['rol_usuario'];
} else {
    echo "Reserva no encontrada. ❌";
    exit;
}
?>
