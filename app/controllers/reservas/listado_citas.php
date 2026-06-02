<?php

$sql = "SELECT 
            r.id_reserva,
            r.nombre_mascota,
            r.tipo_servicio,
            r.fecha_cita,
            r.hora_cita,
            u.nombre AS nombre_dueño,
            u.apellido AS apellido_dueño
        FROM tbl_reservas r
        INNER JOIN tbl_usuarios u ON r.id_usuario = u.id_usuario
        ORDER BY r.fecha_cita DESC, r.hora_cita DESC";

$query = $pdo->prepare($sql);
$query->execute();
$reservas = $query->fetchAll(PDO::FETCH_ASSOC);

?>