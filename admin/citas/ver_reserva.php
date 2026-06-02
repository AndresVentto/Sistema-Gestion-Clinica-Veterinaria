<?php
include('../../app/config.php');
include('../../admin/layout/parte1.php');

// Obtener ID de reserva
$id_reserva = $_GET['id_reserva'] ?? null;

if (!$id_reserva) {
    echo "<h4 class='text-danger'>No se ha especificado una reserva.</h4>";
    exit();
}

// Consulta con JOIN para obtener detalles
$sql = "SELECT r.*, u.nombre, u.apellido, u.correo
        FROM tbl_reservas r
        INNER JOIN tbl_usuarios u ON r.id_usuario = u.id_usuario
        WHERE r.id_reserva = :id_reserva";

$query = $pdo->prepare($sql);
$query->bindParam(':id_reserva', $id_reserva);
$query->execute();
$reserva = $query->fetch(PDO::FETCH_ASSOC);

if (!$reserva) {
    echo "<h4 class='text-danger'>Reserva no encontrada.</h4>";
    exit();
}
?>

<div class="container mt-5">
    <div class="col-md-10 offset-md-1">
        <div class="card card-outline card-success shadow">
            <div class="card-header">
                <h3 class="card-title">
                    <b><i class="fas fa-calendar-check" style="color: #469255;"></i> Detalles de la Reserva #<?= $reserva['id_reserva']; ?></b>
                </h3>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-user" style="color: #469255;"></i> Dueño de la Mascota:</label>
                            <input type="text" class="form-control border-success" value="<?= $reserva['nombre'] . ' ' . $reserva['apellido']; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-envelope" style="color: #469255;"></i> Correo Electrónico:</label>
                            <input type="text" class="form-control border-success" value="<?= $reserva['correo']; ?>" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-dog" style="color: #469255;"></i> Nombre de la Mascota:</label>
                            <input type="text" class="form-control border-success" value="<?= $reserva['nombre_mascota']; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-briefcase-medical" style="color: #469255;"></i> Servicio:</label>
                            <input type="text" class="form-control border-success" value="<?= $reserva['tipo_servicio']; ?>" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-calendar-alt" style="color: #469255;"></i> Fecha de la Cita:</label>
                            <input type="text" class="form-control border-success" value="<?= $reserva['fecha_cita']; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-clock" style="color: #469255;"></i> Hora de la Cita:</label>
                            <input type="text" class="form-control border-success" value="<?= $reserva['hora_cita']; ?>" disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-calendar-plus" style="color: #469255;"></i> Fecha y Hora de Registro:</label>
                            <input type="text" class="form-control border-success" value="<?= $reserva['fyh_creacion']; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-calendar-day" style="color: #469255;"></i> Última Actualización:</label>
                            <input type="text" class="form-control border-success" value="<?= $reserva['fyh_actualizacion']; ?>" disabled>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="text-right">
                    <div class="col-md-12">
                        <a href="<?php echo $URL;?>/admin/citas" class="btn btn-secondary" style="margin-right:10px;"><i class="bi bi-arrow-return-left"></i>  Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('../../admin/layout/parte2.php'); ?>
