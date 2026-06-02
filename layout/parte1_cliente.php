<?php


include ('../app/config.php');

session_start();

$correo_sesion = $_SESSION['sesion_correo'] ?? "";

if (!empty($correo_sesion)) {
    // Usuario logueado
    $sql = "SELECT * FROM tbl_usuarios WHERE correo = :correo";
    $query = $pdo->prepare($sql);
    $query->bindParam(':correo', $correo_sesion);
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        $id_usuario_sesion = $usuario['id_usuario'];
        $nombre_usuario_sesion = $usuario['nombre'];
        $rol_usuario_sesion = $usuario['rol_usuario'];
    }
}


?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registro Clientes | <?php echo APP_NAME; ?></title>
        <link rel="shortcut icon" href="<?php echo $URL;?>/public/img/logo.png" type="image/x-icon">
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <!-- SWEET ALERT ALERTAS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            /* Asegurarse de que el body ocupe toda la altura disponible */
            body, html {
                height: 100%;
                margin: 0;
                display: flex;
                flex-direction: column;
            }

            /* Reducir el padding del navbar */
            header.navbar {
                padding-top: 0.1rem; /* Ajusta a tu preferencia */
                padding-bottom: 0.1rem; /* Ajusta a tu preferencia */
            }

            /* Reducir el padding en los elementos del menú */
            .navbar-nav .nav-item {
                padding-left: 0.5rem; /* Ajusta según necesidad */
                padding-right: 0.5rem; /* Ajusta según necesidad */
            }

            /* Reducir la fuente de los ítems en el menú */
            .navbar-nav .nav-link {
                font-size: 1rem; /* Puedes reducir el tamaño si es necesario */
            }

            /* Mejorar el estilo del footer y asegurar que esté al final */
            footer {
                padding: 20px 0;
                background-color: #f8f9fa;
                font-size: 0.9rem;
                margin-top: auto; /* Esto asegura que el footer esté siempre al final */
                width: 100%;
            }

            footer a {
                color: #469255;
            }

            footer a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body class="hold-transition login-page">

        <!-- Navbar -->
        <header class="navbar navbar-expand-lg fixed-top shadow px-4" style="background-color: #469255;">
            <div class="container-fluid">
                <!-- Logo a la izquierda -->
                <a class="navbar-brand d-flex align-items-center text-white fw-bold fs-3 ms-5" href="<?php echo $URL?>/index.php">
                    <img src="<?php echo $URL;?>/public/img/logo.png" alt="logo" width="60" class="me-2">
                    IUJO-Vet
                </a>

                <!-- Botón hamburguesa para móviles -->
                <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido del navbar -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- Menú centrado -->
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-center">
                        <li class="nav-item px-3">
                            <a class="nav-link text-white fs-5" href="<?php echo $URL?>/index.php">🏠 Inicio</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link text-white fs-5" href="<?php echo $URL?>/index.php#nosotros">🐾 Sobre Nosotros</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link text-white fs-5" href="<?php echo $URL?>/index.php#productos">🛒 Productos</a>
                        </li>

                        <li class="nav-item px-3">
                            <a class="nav-link text-white fs-5" href="<?php echo $URL?>/reservar.php">📆 Agendar Cita</a>
                        </li>
                    </ul>

                    <!-- Correo del usuario a la derecha -->
                    <span class="navbar-text text-white me-5 d-none d-lg-block">
                        <?php if (empty($correo_sesion)) { ?>
                            <!-- Si el usuario no ha iniciado sesión -->
                            <a href="<?php echo $URL?>/login" class="text-white" style="text-decoration: none;"><i class="fa-solid fa-user" ></i> Iniciar Sesión</a>
                        <?php } else { ?>
                            <!-- Si el usuario ya está logueado -->
                            <span>Bienvenido, <?= $nombre_usuario_sesion; ?>!</span> 
                            <a href="<?php echo $URL;?>/app/controllers/login/cerrar_sesion.php" class="text-white ms-3">Cerrar sesión</a>
                        <?php } ?>
                    </span>
                </div>
            </div>
        </header>

