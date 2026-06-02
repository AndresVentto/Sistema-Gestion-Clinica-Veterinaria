<?php

session_start();
if(isset($_SESSION['sesion_correo'])){
    // echo "Ha pasado por el Login";
    $correo_sesion = $_SESSION['sesion_correo'];
    $sql = "SELECT * FROM tbl_usuarios WHERE correo = '$correo_sesion' ";
    $query = $pdo->prepare($sql);
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        $id_usuario_sesion = $usuario['id_usuario'];
        $nombre_usuario_sesion = $usuario['nombre'];
        $rol_usuario_sesion = $usuario['rol_usuario'];
    }


} else {
    // echo "NO ha pasado por el login";
    header('Location: '.$URL.'/login');
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administración | <?php echo APP_NAME;?></title>
        <link rel="shortcut icon" href="<?php echo $URL;?>/public/img/logo-login.png" type="image/x-icon">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

        <!-- jQuery -->
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>

        <!-- SWEET ALERT ALERTAS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

        <style>
            .card.card-outline {
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
                border-radius: 12px;
            }
            .brand-image {
                width: 120px; /* Ajusta el tamaño según lo que desees */
                height: auto;
                object-fit: contain;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark" style="background-color:#469255;">

                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="<?php echo $URL;?>/admin" class="nav-link active"> ADMINISTRACIÓN | <?php echo APP_NAME;?></a>
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-success elevation-4" >
                <!-- Brand Logo -->
                <a href="<?php echo $URL;?>/admin" class="brand-link">
                    <img src="<?php echo $URL;?>/public/img/logo-login.png" alt="Logo" class="brand-image ">
                    <span class="brand-text font-weight-bold">IUJO - VET</span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info">
                            <a href="#" class="d-block">
                                Usuario: <?= $rol_usuario_sesion; ?>
                            </a>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                            <!-- USUARIOS -->
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active" style="background-color:#469255;">
                                    <i class="nav-icon fas fa-users"></i> Usuarios <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL;?>/admin/usuarios" class="nav-link">
                                            <i class="fas fa-list-ul"></i> Lista de Usuarios
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL;?>/admin/usuarios/crear_usuario.php" class="nav-link">
                                            <i class="fas fa-user-plus"></i> Nuevo Usuario
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- PRODUCTOS -->
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active" style="background-color:#469255;">
                                    <i class="nav-icon fas fa-box-open"> </i> Productos <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL;?>/admin/productos" class="nav-link">
                                            <i class="fas fa-warehouse"> </i> Inventario
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL;?>/admin/productos/crear_productos.php" class="nav-link">
                                            <i class="fas fa-tags"></i> Agregar Producto
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- CITAS -->
                            <li class="nav-item menu">
                                <a href="#" class="nav-link active" style="background-color:#469255;">
                                    <i class="fas fa-clipboard-list"> </i> Citas <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?php echo $URL;?>/admin/citas" class="nav-link">
                                            <i class="fas fa-list-ul"> </i> Reservaciones
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo $URL;?>/admin/citas/crear_cita.php" class="nav-link">
                                            <i class="fas fa-file-invoice"> </i> Reservar Nueva Cita
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <br>
                            <li class="nav-item menu">
                                <a href="<?php echo $URL;?>/app/controllers/login/cerrar_sesion.php" class="nav-link active bg-danger" >
                                    <i class="fas fa-door-open"></i>
                                    <p>
                                        Cerrar Sesión
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- /.sidebar -->
            </aside>


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">

                    </div>
                </div>
                <div class="content">