
<?php
session_start();
include('../../../app/config.php');

$fecha = $_GET['fecha'];

$query = $pdo->prepare("SELECT hora_cita FROM tbl_reservas WHERE fecha_cita = :fecha");
$query->bindParam(':fecha', $fecha);
$query->execute();
$datos = $query->fetchAll(PDO::FETCH_ASSOC);

$horario = ['08:00 - 09:00', '09:00 - 10:00', '10:00 - 11:00', '11:00 - 12:00', '14:00 - 15:00', '15:00 - 16:00', '16:00 - 17:00', '17:00 - 18:00'];
$botonesOcupados = [];

foreach ($datos as $dato) {
    $hora_cita = $dato['hora_cita'];
    foreach ($horario as $index => $hora) {
        if ($hora === $hora_cita) {
            $botonesOcupados[] = "btn_h" . ($index + 1);
        }
    }
}

echo json_encode($botonesOcupados);