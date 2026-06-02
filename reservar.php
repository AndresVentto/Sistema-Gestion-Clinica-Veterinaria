<?php
session_start();
include('app/config.php');
include('admin/layout/alertas.php');

$correo_sesion = $_SESSION['sesion_correo'] ?? "";
if (!empty($correo_sesion)) {
    $sql = "SELECT * FROM tbl_usuarios WHERE correo = :correo";
    $query = $pdo->prepare($sql);
    $query->bindParam(':correo', $correo_sesion);
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        $id_usuario_sesion = $usuario['id_usuario'];
        $nombre_usuario_sesion = $usuario['nombre'];
        $apellido_usuario_sesion = $usuario['apellido'];
        $rol_usuario_sesion = $usuario['rol_usuario'];
    }
}
?>
<!DOCTYPE html>
<html lang='es'>
    <head>
        <meta charset='utf-8' />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="./public/img/logo.png" type="image/x-icon">
        <title>IUJO Vet - Sistema de Gestión Veterinaria</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="./public/js/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .fc td, .fc th {
                border: 1px solid #666 !important;
            }
            .fc .fc-daygrid-day-number,
            .fc .fc-col-header-cell-cushion {
                color: #469255 !important;
                font-weight: bold;
            }
            .fc-daygrid-day:hover {
                background-color:rgba(88, 186, 108, 0.73);
                cursor: pointer;
            }
            .fc .fc-day-today {
                background-color: rgba(70, 146, 85, 0.3);
            }
            .fc {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                font-size: 1rem;
            }
            #calendar {
                max-width: 90%;
                max-height: 650px;
                overflow-y: auto;
                margin: 0 auto;
                padding: 10px;
            }
            #btn_h1:hover, #btn_h2:hover, #btn_h3:hover, #btn_h4:hover,
            #btn_h5:hover, #btn_h6:hover, #btn_h7:hover, #btn_h8:hover {
                background-color: #377346 !important;
                cursor: pointer;
            }
            .modal.fade .modal-dialog {
                transform: translateY(50px);
                opacity: 0;
                transition: all 0.4s ease-out;
            }
            .modal.fade.show .modal-dialog {
                transform: translateY(0);
                opacity: 1;
            }
            .fc-event {
                background-color:rgb(64, 142, 84);
                border-radius: 5px;
                font-size: 14px;
                color: black;
                padding: 5px;
            }
            .fc-event i {
                margin-right: 5px;
            }
        </style>
    </head>
    <body>

        <header class="navbar navbar-expand-lg fixed-top shadow px-50" style="padding-top: 0.1rem; padding-bottom: 0.1rem; background-color: #469255;">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center text-white fw-bold fs-3 ms-5" href="<?php echo $URL?>/index.php">
                    <img src="./public/img/logo.png" alt="logo" width="60" class="me-2">
                    IUJO-Vet
                </a>
                <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item px-2">
                            <a class="nav-link text-white fs-5" href="<?php echo $URL;?>/index.php">🏠 Inicio</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link text-white fs-5" href="<?php echo $URL;?>/index.php#sobre-nosotros">🐾 Sobre Nosotros</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link text-white fs-5" href="<?php echo $URL;?>/index.php#productos">🛒 Productos</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center gap-1 me-5">
                        <div class="dropdown">
                            <a href="#" class="text-white text-decoration-none d-flex align-items-center gap-2 dropdown-toggle" id="dropdownLogin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                                <span class="fw-semibold">
                                    <?php echo empty($correo_sesion) ? 'Ingresar' : 'Hola, ' . $nombre_usuario_sesion ; ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownLogin">
                                <?php if (empty($correo_sesion)) { ?>
                                    <li><a class="dropdown-item" href="<?php echo $URL;?>/login">Iniciar Sesión</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?php echo $URL;?>/login/registrarme.php">Registrarme</a></li>
                                <?php } else { ?>
                                    <li><a class="dropdown-item" href="<?php echo $URL;?>/app/controllers/login/cerrar_sesion.php">Cerrar sesión</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <script>
            var a;
            var correo_sesion = <?= json_encode($correo_sesion); ?>;

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'es',
                    editable: true,
                    selectable: true,
                    allDaySlot: false,
                    events: 'app/controllers/reservas/cargar_reserva.php',
                    eventClick: function(info) {
                        Swal.fire({
                            title: info.event.title,
                            text: " "  + info.event.extendedProps.descripcion,
                            icon: 'info',
                            confirmButtonColor: '#469255',
                            confirmButtonText: 'Cerrar'
                        });
                    },
                    dateClick: function(info) {
                        a = info.dateStr;
                        var numeroDia = new Date(a).getDay();
                        var dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];


                        if(correo_sesion == ""){
                            $('#modal_sesion').modal("show");
                        } else {
                            if (numeroDia == 0 || numeroDia == 6) {
                                Swal.fire({
                                    title: "🐾 Día no disponible",
                                    text: "Los fines de semana estamos descansando. Agenda tu cita de lunes a viernes.",
                                    imageUrl: './public/img/gif_gato.gif',
                                    imageHeight: 153,
                                    confirmButtonColor: "#469255",
                                    confirmButtonText: "¡Entendido!"
                                });
                            } else {
                                $('#modal_reservar').modal("show");
                                $('#dia_semana').html(dias[numeroDia]+ ",  " + a);

                                var url = "app/controllers/reservas/verificar_horario.php";
                                $.getJSON(url, { fecha: a }, function(botonesOcupados) {
                                    for (let i = 1; i <= 8; i++) {
                                        $('#btn_h' + i)
                                            .prop('disabled', false)
                                            .removeAttr('style')
                                            .attr('style', 'background-color: #469255; color: white; border: none;')
                                            .removeAttr('title');
                                    }
                                    botonesOcupados.forEach(function(id) {
                                        $('#' + id)
                                            .prop('disabled', true)
                                            .removeAttr('style')
                                            .css({
                                                "background-color": "#ccc",
                                                "color": "#111",
                                                "border": "1px solid #222",
                                                "cursor": "not-allowed"
                                            })
                                            .attr('title', 'Este horario ya está reservado');
                                    });
                                });
                            }
                        }
                    }
                });
                calendar.render();
            });
        </script>
        <br><br>
        <br><br>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <br><br>
                        <h1 style="text-align: center;"><b>Agendar</b> <b style="color: #469255;">Cita 📆</b></h1>
                        <br>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </section>
        <br><br>
        <br><br>
        <!-- Modal SESIÓN -->
        <div class="modal fade" id="modal_sesion" tabindex="-1" aria-labelledby="modalSesionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg border-0 rounded-4" style="max-width: 665px; margin: auto;">
                    <!-- Encabezado -->
                    <div class="modal-header text-white" style="background-color: rgb(5, 101, 156); border-top-left-radius: 1rem; border-top-right-radius: 1rem; border-bottom: solid 2px black;">
                        <h2 class="modal-title fs-5" id="modalSesionLabel">
                            ⚠️ Inicia sesión o regístrate
                        </h2>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <!-- Cuerpo -->
                    <div class="modal-body py-3 text-center">
                        <p class="fs-6 mb-4 text-nowrap">Para agendar una cita necesitas tener una cuenta en nuestro sistema.</p>
                        <p class="text-dark mb-0">Inicia sesión o regístrate a continuación.</p>
                    </div>
                    <!-- Botones -->
                    <div class="modal-footer justify-content-center gap-2 pb-3">
                        <a href="<?php echo $URL;?>/login" class="btn btn-primary px-3 rounded-pill" style="background-color: rgb(5, 101, 156);">
                            <i class="fas fa-sign-in-alt me-1"></i> Iniciar Sesión
                        </a>
                        <a href="<?php echo $URL;?>/login/registrarme.php" class="btn btn-outline-dark px-3 rounded-pill">
                            <i class="fas fa-user-plus me-1"></i> Registrarme
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal HORARIOS -->
        <div class="modal fade" id="modal_reservar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Header personalizado -->
                    <div class="modal-header" style="background-color: #469255;">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                            Agendar cita para el día <b class="text-body"><span id="dia_semana"></span></b>
                        </h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <!-- DIV CON EL ID -->
                            <div id="respuesta_horario"></div>

                            <!-- TURNO MAÑANA -->
                            <div class="col-md-6 border-end border-1 border-secondary">
                                <h5 class="fw-bold" >Turno de la Mañana:</h5>
                                <div class="d-grid gap-2 mt-4 px-4">
                                    
                                    <button class="btn btn-success" data-bs-dismiss="modal" id="btn_h1" style="background-color: #469255;" type="button">08:00 - 90:00 </button>
                                    <button class="btn btn-success" data-bs-dismiss="modal" id="btn_h2" style="background-color: #469255;" type="button">09:00 - 10:00 </button>
                                    <button class="btn btn-success" data-bs-dismiss="modal" id="btn_h3" style="background-color: #469255;" type="button">10:00 - 11:00 </button>
                                    <button class="btn btn-success" data-bs-dismiss="modal" id="btn_h4" style="background-color: #469255;" type="button">11:00 - 12:00 </button>
                                </div>
                            </div>
                            <!-- TURNO TARDE -->
                            <div class="col-md-6">
                                <h5 class="fw-bold" >Turno de la Tarde:</h5>
                                <div class="d-grid gap-2 mt-4 px-4">
                                    <button class="btn btn-success" data-bs-dismiss="modal" id="btn_h5" style="background-color: #469255;" type="button">14:00 - 15:00 </button>
                                    <button class="btn btn-success" data-bs-dismiss="modal" id="btn_h6" style="background-color: #469255;" type="button">15:00 - 16:00 </button>
                                    <button class="btn btn-success" data-bs-dismiss="modal" id="btn_h7" style="background-color: #469255;" type="button">16:00 - 17:00 </button>
                                    <button class="btn btn-success" data-bs-dismiss="modal" id="btn_h8" style="background-color: #469255;" type="button">17:00 - 18:00 </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <!-- Modal FORMULARIO -->
        <div class="modal fade" id="modal_formulario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Header personalizado -->
                    <div class="modal-header" style="background-color: #469255;">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">
                            Agendar cita para el día <b class="text-body"><span id="dia_semana"></span></b>
                        </h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="<?php echo $URL;?>/app/controllers/reservas/controller_reservas.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>Dueño de la Mascota:</b> </label>
                                        <input type="text" class="form-control border-success" value="<?php echo $nombre_usuario_sesion . " " . $apellido_usuario_sesion ;?>" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label><b>Correo Electrónico:</b> </label>
                                        <input type="text" class="form-control border-success" value="<?php echo $correo_sesion; ?>" disabled>
                                        <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion ;?>" hidden>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>Fecha de Reservación:</b></label>
                                        <input type="text" class="form-control border-success" id="fecha_reservacion" disabled>
                                        <input type="text" name="fecha_cita" class="form-control border-success" id="fecha_reservacion2" hidden>
                                    </div>
                                    <div class="col-md-6">
                                        <label><b>Horario Asignado:</b></label>
                                        <input type="text" class="form-control border-success" id="hora_reservacion" disabled>
                                        <input type="text" name="hora_cita" class="form-control border-success" id="hora_reservacion2" hidden>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><b>Nombre de la Mascota:</b></label>
                                        <input type="text" name="nombre_mascota" class="form-control border-success" >
                                    </div>
                                    <div class="col-md-6">
                                        <label><b>Servicio de la Cita:</b></label>
                                        <select name="tipo_servicio" class="form-control border-success">
                                            <option value="Consulta médica">Cita Médica</option>
                                            <option value="Vacunación">Vacunación</option>
                                            <option value="Esterilización">Esterilización</option>
                                            <option value="Peluquería">Peluquería</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn text-white" style="background-color: #469255;">Confirmar la Cita</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- Script para identificar horario y registrar la cita -->
        <script>
            // Horario 1
            $('#btn_h1').click(function (){
                $('#modal_formulario').modal("show");
                $('#fecha_reservacion').val(a);
                $('#fecha_reservacion2').val(a);
                var h1 = "08:00 - 09:00";
                $('#hora_reservacion').val(h1);
                $('#hora_reservacion2').val(h1);
            });
            // Horario 2
            $('#btn_h2').click(function (){
                $('#modal_formulario').modal("show");
                $('#fecha_reservacion').val(a);
                $('#fecha_reservacion2').val(a);
                var h2 = "09:00 - 10:00";
                $('#hora_reservacion').val(h2);
                $('#hora_reservacion2').val(h2);
            });
            // Horario 3
            $('#btn_h3').click(function (){
                $('#modal_formulario').modal("show");
                $('#fecha_reservacion').val(a);
                $('#fecha_reservacion2').val(a);
                var h3 = "10:00 - 11:00";
                $('#hora_reservacion').val(h3);
                $('#hora_reservacion2').val(h3);
            });
            // Horario 4
            $('#btn_h4').click(function (){
                $('#modal_formulario').modal("show");
                $('#fecha_reservacion').val(a);
                $('#fecha_reservacion2').val(a);
                var h4 = "11:00 - 12:00";
                $('#hora_reservacion').val(h4);
                $('#hora_reservacion2').val(h4);
            });
            // Horario 5
            $('#btn_h5').click(function (){
                $('#modal_formulario').modal("show");
                $('#fecha_reservacion').val(a);
                $('#fecha_reservacion2').val(a);
                var h5 = "14:00 - 15:00";
                $('#hora_reservacion').val(h5);
                $('#hora_reservacion2').val(h5);
            });
            // Horario 6
            $('#btn_h6').click(function (){
                $('#modal_formulario').modal("show");
                $('#fecha_reservacion').val(a);
                $('#fecha_reservacion2').val(a);
                var h6 = "15:00 - 16:00";
                $('#hora_reservacion').val(h6);
                $('#hora_reservacion2').val(h6);
            });
            // Horario 7
            $('#btn_h7').click(function (){
                $('#modal_formulario').modal("show");
                $('#fecha_reservacion').val(a);
                $('#fecha_reservacion2').val(a);
                var h7 = "16:00 - 17:00";
                $('#hora_reservacion').val(h7);
                $('#hora_reservacion2').val(h7);
            });
            // Horario 8
            $('#btn_h8').click(function (){
                $('#modal_formulario').modal("show");
                $('#fecha_reservacion').val(a);
                $('#fecha_reservacion2').val(a);
                var h8 = "17:00 - 18:00";
                $('#hora_reservacion').val(h8);
                $('#hora_reservacion2').val(h8);
            });
        </script>
<?php
include ('layout/parte2_clientes.php');
?>

