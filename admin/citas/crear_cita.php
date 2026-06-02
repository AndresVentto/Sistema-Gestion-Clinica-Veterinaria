<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
?>
<br>
<div class="container-fluid">
    <h2 class="mb-4"><i class="bi bi-calendar-plus" style="color:#28a745;"></i> <b>Registrar una nueva Cita:</b></h2>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Datos de la Cita:</b></h3>
                </div>
                <div class="card-body">
                    <form action="../../app/controllers/reservas/crear_cita.php" method="post" style="padding: 10px;">
                        
                        <!-- 🔎 Buscador de Cliente -->
                        <div class="form-group">
                            <label><b>Buscar Cliente:</b></label>
                            <input type="text" id="buscar_cliente" class="form-control border-success" placeholder="Ingrese nombre, apellido o correo..." autocomplete="off">
                            <div id="resultado_busqueda" class="list-group mt-1"></div>
                            <input type="hidden" name="id_usuario" id="id_usuario" required>
                        </div>

                        <!-- Nombre de Mascota y demás datos -->
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Nombre de la Mascota:</label>
                                <input type="text" name="nombre_mascota" class="form-control border-success" required>
                            </div>
                            <div class="col-md-6">
                                <label>Tipo de Servicio:</label>
                                <select name="tipo_servicio" class="form-control border-success" required>
                                    <option value="Consulta médica">Cita Médica</option>
                                    <option value="Vacunación">Vacunación</option>
                                    <option value="Esterilización">Esterilización</option>
                                    <option value="Peluquería">Peluquería</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label>Fecha de la Cita:</label>
                                <input type="date" name="fecha_cita" class="form-control border-success" required>
                            </div>
                            <div class="col-md-6">
                                <label>Hora de la Cita:</label>
                                <select name="hora_cita" class="form-control border-success" required>
                                    <?php
                                    $horarios = [
                                        '08:00 - 09:00','09:00 - 10:00','10:00 - 11:00','11:00 - 12:00',
                                        '14:00 - 15:00','15:00 - 16:00','16:00 - 17:00','17:00 - 18:00'
                                    ];
                                    foreach ($horarios as $h) {
                                        echo "<option value=\"$h\">$h</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <div class="text-right mt-4">
                            <a href="<?= $URL ?>/admin/citas" class="btn btn-secondary mr-2">
                                <i class="fas fa-ban"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success" style="background-color:#469255;">
                                <i class="fas fa-calendar-plus"></i> Registrar Cita
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

<script>
// AJAX para buscar cliente
document.getElementById('buscar_cliente').addEventListener('input', function () {
    const consulta = this.value;

    if (consulta.length >= 3) {
        fetch('../../app/controllers/usuarios/buscar_cliente.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'consulta=' + encodeURIComponent(consulta)
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('resultado_busqueda').innerHTML = html;
        });
    } else {
        document.getElementById('resultado_busqueda').innerHTML = '';
    }
});

function seleccionarCliente(id, nombre) {
    document.getElementById('buscar_cliente').value = nombre;
    document.getElementById('id_usuario').value = id;
    document.getElementById('resultado_busqueda').innerHTML = '';
}
</script>
