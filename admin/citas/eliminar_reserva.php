<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
$id_reserva = $_GET['id_reserva'];
include ('../../app/controllers/reservas/ver_reservas.php');
?>
<br>
<div class="container-fluid">
    <h3 class="mb-4"><i class="bi bi-x-circle"></i> <b>Desea Eliminar la cita reservada por: </b><?php echo $reserva['nombre'] . " " . $reserva['apellido']; ?>?</h3><br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title"> <b>¿Estás seguro de que deseas Eliminar esta cita?</b></h3>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Dueño:</label>
                            <input type="text" value="<?php echo $reserva['nombre'] . ' ' . $reserva['apellido']; ?>" class="form-control border-dark" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Correo:</label>
                            <input type="email" value="<?php echo $reserva['correo']; ?>" class="form-control border-dark" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Nombre de la Mascota:</label>
                            <input type="text" value="<?php echo $reserva['nombre_mascota']; ?>" class="form-control border-dark" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Tipo de Servicio:</label>
                            <input type="text" value="<?php echo $reserva['tipo_servicio']; ?>" class="form-control border-dark" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Fecha:</label>
                            <input type="text" value="<?php echo $reserva['fecha_cita']; ?>" class="form-control border-dark" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Hora:</label>
                            <input type="text" value="<?php echo $reserva['hora_cita']; ?>" class="form-control border-dark" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="text-right">
                        <form action="<?php echo $URL ?>/app/controllers/reservas/eliminar_reserva.php" method="post" id="formEliminarCita">
                            <input type="hidden" name="id_reserva" value="<?php echo $id_reserva; ?>">
                            <a href="<?php echo $URL;?>/admin/citas" class="btn btn-secondary" style="margin-right:10px;"><i class="fas fa-ban"></i> Volver</a>
                            <!-- CAMBIO AQUÍ: type="button" en vez de submit -->
                            <button type="button" class="btn btn-danger" id="btnEliminarCita">
                                <i class="bi bi-x-circle"></i> Eliminar la Cita
                            </button>
                        </form>
                    </div>
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
<script>
    const btn = document.getElementById("btnEliminarCita");
    btn.addEventListener("click", function () {
        Swal.fire({
            title: '¿Estás seguro? 🙀',
            text: "¡Esta acción eliminará la cita permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#469255',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                btn.disabled = true; // Evitar doble clic
                document.getElementById("formEliminarCita").submit();
            }
        });
    });
</script>