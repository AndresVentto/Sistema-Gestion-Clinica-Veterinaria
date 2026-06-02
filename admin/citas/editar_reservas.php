<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

$id_reserva = $_GET['id_reserva'];
include('../../app/controllers/reservas/ver_reservas.php');
?>
<br>
<div class="container-fluid">
    <h2 class="mb-4"><i class="bi bi-pencil-square" style="color:#ffc107;"></i> <b>Editar la Reserva:</b> #<?= $reserva['id_reserva']; ?></h2>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title"><b>Datos de la Reserva:</b></h3>
                </div>
                <div class="card-body">
                    <form action="../../app/controllers/reservas/editar_reservas.php" method="post" style="padding: 10px;">
                        <div class="row mt-3">
                            <!-- Muestra el nombre del dueño (solo lectura) -->
                            <div class="col-md-6">
                                <label>Nombre del Dueño:</label>
                                <input type="text" class="form-control border-dark" value="<?= $reserva['nombre']; ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label>Apellido del Dueño:</label>
                                <input type="text" class="form-control border-dark" value="<?= $reserva['apellido']; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Correo Electrónico:</label>
                                <input type="email" name="correo" class="form-control border-dark" value="<?= $reserva['correo']; ?>" disabled>
                            </div>
                            <div class="col-md-6">
                                <label>Nombre de la Mascota:</label>
                                <input type="text" name="nombre_mascota" class="form-control border-dark" value="<?= $reserva['nombre_mascota']; ?>" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label><b>Servicio de la Cita:</b></label>
                                <select name="tipo_servicio" class="form-control border-dark" required>
                                    <?php
                                    $servicios = [
                                        'Consulta médica' => 'Cita Médica',
                                        'Vacunación' => 'Vacunación',
                                        'Esterilización' => 'Esterilización',
                                        'Peluquería' => 'Peluquería'
                                    ];
                                    foreach ($servicios as $valor => $texto) {
                                        $selected = ($reserva['tipo_servicio'] === $valor) ? 'selected' : '';
                                        echo "<option value=\"$valor\" $selected>$texto</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Fecha de la Cita:</label>
                                <input type="date" name="fecha_cita" class="form-control border-dark" value="<?= $reserva['fecha_cita']; ?>" required>
                            </div>
                            <div class="col-md-3">
                                <label>Hora de la Cita:</label>
                                <select name="hora_cita" class="form-control border-dark" required>
                                    <?php
                                    $horarios = [
                                        '08:00 - 09:00',
                                        '09:00 - 10:00',
                                        '10:00 - 11:00',
                                        '11:00 - 12:00',
                                        '14:00 - 15:00',
                                        '15:00 - 16:00',
                                        '16:00 - 17:00',
                                        '17:00 - 18:00',
                                    ];
                                    foreach ($horarios as $hora) {
                                        $selected = ($reserva['hora_cita'] === $hora) ? 'selected' : '';
                                        echo "<option value=\"$hora\" $selected>$hora</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- Ocultos -->
                        <input type="hidden" name="id_reserva" value="<?= $reserva['id_reserva']; ?>">
                        <input type="hidden" name="id_usuario" value="<?= $id_usuario_sesion; ?>">
                        <hr>
                        <div class="text-end mt-3">
                            <a href="<?= $URL; ?>/admin/citas" class="btn btn-secondary me-2">
                                <i class="fas fa-ban"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Actualizar Reserva
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<?php 
include ('../../admin/layout/parte2.php');
include ('../../admin/layout/alertas.php'); 
?>
