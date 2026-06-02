<?php
include ('../app/config.php');
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Iniciar Sesión | <?php echo APP_NAME; ?></title>
        <link rel="shortcut icon" href="../public/img/logo.png" type="image/x-icon">
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
        <!-- iCheck Bootstrap -->
        <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- AdminLTE -->
        <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/dist/css/adminlte.min.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo $URL;?>/public/css/login.css">
    </head>
    <body class="hold-transition login-page">
        <br><br><br><br><br>
        <div class="login-box">
            <div class="login-logo">
                <a href="<?php echo $URL;?>/login/index.php" style="text-decoration: none;"><b>INICIAR SESIÓN</b></a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <div class="text-center">
                        <img src="<?php echo $URL;?>/public/img/logo-login.png" width="42%" alt="logo">
                    </div>
                    <p class="login-box-msg"><b>Ingresa tus datos</b></p>
                    <form action="<?php echo $URL;?>/app/controllers/login/controler_login.php" method="post">
                        <label for="correo" class="form-label"><b>Correo:</b></label>
                        <div class="input-group mb-3">
                            <input type="email" name="correo" id="correo" class="form-control border-success" required>
                            <span class="input-group-text border border-success bg-white">
                                <i class="fas fa-envelope" style="color:#469255;"></i>
                            </span>
                        </div>

                        <label for="loginPassword" class="form-label"><b>Contraseña:</b></label>
                        <div class="input-group mb-3">
                            <input type="password" id="loginPassword" name="contrasenna" class="form-control border-success" required>
                            <span class="input-group-text border border-success bg-white" onclick="togglePassword('loginPassword', this)" style="cursor:pointer;">
                                <i class="fas fa-eye" style="color:#469255;"></i>
                            </span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-ingresar w-50 me-2">Entrar</button><br>
                            <a href="<?php echo $URL;?>" class="btn btn-cancelar w-50">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br><br>
        <footer class=" mt-4">
            <div class="container text-center">
                <strong>&copy; <?php echo date("Y"); ?> <a href="<?php echo $URL;?>" class="text-success">IUJO-VET</a>.</strong>
                Todos los derechos reservados.<br>
                <small class="text-muted">Desarrollado por Andrés Vento, Rafael Liendo y Kevin Medina</small>
                <br><br>
            </div>
        </footer>
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
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    </body>
</html>
