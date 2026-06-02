<?php

include('../layout/parte1_cliente.php');

?>


        <!-- Contenido de la página -->
        <div class="container">
            <br><br><br>
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-md-7 col-lg-6">
                    <div class="card shadow-lg border-4 rounded-4" style="box-shadow: 0 12px 20px rgba(0, 0, 0, 0.25);">
                        <div class="card-header text-white text-center" style="background-color: #469255; border-top-left-radius: 1rem; border-top-right-radius: 1rem; padding-top:10px; padding-bottom:10px;">
                            <h3 class="mb-0"><i class="fas fa-user-plus me-2"></i>¡Regístrate Aquí! </h3>
                        </div>
                        <center>
                            <b style="padding-top: 12px; display: inline-block;">Revisa bien tus datos</b>
                        </center>
                        <div class="card-body px-4 py-4">
                            <form action="<?php echo $URL;?>/app/controllers/login/controler_registro.php" method="post">

                            <div class="row gx-4 gy-4">
                                    <!-- Nombre -->
                                    <div class="col-md-6"> 
                                        <label for="nombre" class="form-label"><i class="fas fa-user me-2 text-success"></i>Nombre:</label>
                                        <input type="text" class="form-control border-success" name="nombre" id="nombre" >
                                    </div>

                                    <!-- Apellido -->
                                    <div class="col-md-6">
                                        <label for="apellido" class="form-label"><i class="fas fa-user-tag me-2 text-success"></i>Apellido:</label>
                                        <input type="text" class="form-control border-success" name="apellido" id="apellido" >
                                    </div>

                                    <!-- Cédula -->
                                    <div class="col-md-6">
                                        <label for="cedula" class="form-label"><i class="fas fa-id-card me-2 text-success"></i>Cédula:</label>
                                        <input type="number" class="form-control border-success" name="cedula" id="cedula">
                                    </div>

                                    <!-- Correo -->
                                    <div class="col-md-6">
                                        <label for="correo" class="form-label"><i class="fas fa-envelope me-2 text-success"></i>Correo Electrónico:</label>
                                        <input type="email" class="form-control border-success" name="correo" id="correo" placeholder="ejemplo@email.com">
                                    </div>

                                    <!-- Contraseña -->
                                    <div class="col-md-6">
                                        <label for="password" class="form-label"><i class="fas fa-lock me-2 text-success"></i>Contraseña:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control border-success" name="contrasenna" id="password">
                                            <span class="input-group-text border-success bg-white" onclick="togglePassword('password', this)" style="cursor:pointer;">
                                                <i class="fas fa-eye text-success"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Confirmar contraseña -->
                                    <div class="col-md-6">
                                        <label for="confirmar" class="form-label"><i class="fas fa-lock me-2 text-success"></i>Confirmar Contraseña:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control border-success" name="contrasenna_repetida" id="confirmar">
                                            <span class="input-group-text border-success bg-white" onclick="togglePassword('confirmar', this)" style="cursor:pointer;">
                                                <i class="fas fa-eye text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Botón -->
                                <div class="d-grid">
                                    <button type="submit" class="btn text-white btn rounded-pill" style="background-color: #469255;">
                                        <i class="fas fa-user-plus me-2"></i>Registrarme
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="text-center text-muted small pb-3">
                            ¿Ya tienes cuenta? <a href="<?php echo $URL;?>/login" class="text-success fw-semibold">Inicia sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Footer -->
        <footer class="bg-white mt-4">
            <div class="container text-center">
                <strong>&copy; <?php echo date("Y"); ?> <a href="<?php echo $URL;?>" class="text-success">IUJO-VET</a>.</strong>
                Todos los derechos reservados.<br>
                <small class="text-muted">Desarrollado por Andrés Vento, Rafael Liendo y Kevin Medina</small>
                <br>
            </div>
        </footer>

        <!-- Scripts -->
        <script>
            function togglePassword(id, el) {
                const input = document.getElementById(id);
                const icon = el.querySelector('i');
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.replace("fa-eye", "fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.replace("fa-eye-slash", "fa-eye");
                }
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    </body>
</html>

<?php 
// include ('../admin/layout/parte2.php');
include ('../admin/layout/alertas.php'); 
?>