<?php
include ('app/config.php');
include ('app/controllers/productos/listado_productos.php');
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/img/logo.png" type="image/x-icon">
    <title>IUJO Vet - Sistema de Gestión Veterinaria</title>
    <!-- Link de Iconos Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <!-- Link de Archivo Personalizado de CSS -->
    <link rel="stylesheet" href="./public/css/style.css">
    <!-- SWEET ALERT ALERTAS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
</head>
<body>
    <!-- HEADER -->
    <header class="header">
        <a href="#inicio" class="logo">
            <img src="./public/img/logo.png" alt="logo" width="60px">
            <span>IUJO-Vet</span>
        </a>
        <nav class="navbar">
            <a href="#inicio">🏠 Inicio</a>
            <a href="#sobre-nosotros">🐾 Sobre Nosotros</a>
            <a href="#productos">🛒 Productos</a>
            <a href="<?php echo $URL?>/reservar.php">📆 Agendar Cita</a>
        </nav>

        <?php if (empty($correo_sesion)) { ?>
            <div class="icons">
                <div class="login-dropdown" id="login-btn">
                    <i class="fas fa-user"></i>
                    <span>Ingresar</span>
                </div>
                <div class="fas fa-bars" id="menu-btn"></div>
            </div>
            <form action="" class="login-link" id="login-form">
                <a href="<?php echo $URL?>/login">Iniciar Sesión</a>
                <hr>
                <a href="<?php echo $URL?>/login/registrarme.php">Registrarme</a>
            </form>
        <?php } else { ?>
            <div class="icons">
                <div class="login-dropdown" id="login-btn">
                    <span>Hola, <?= $nombre_usuario_sesion; ?></span><i class="fas fa-user-check"></i>
                </div>
                <div class="fas fa-bars" id="menu-btn"></div>
            </div>
            <form action="" class="login-link" id="login-form">
                <a href="<?php echo $URL;?>/app/controllers/login/cerrar_sesion.php">Cerrar sesión</a>
            </form>
        <?php } ?>
    </header>
        <!-- SECCIÓN DE INICIO -->
        <section class="inicio" id="inicio">
            <div class="content">
                <h2><span>¿Perro o Gato?</span></h2>
                <p class="parrafo">¡Bienvenido!  Sigue nuestra guía para saber las necesidades de tu mascota.</p>
                <a href="<?php echo $URL?>/reservar.php" class="btn"> Reservar Cita 📆</a> 
                <a href="#productos" class="btn"> Ver Productos 👀</a>
            </div>
            <!-- <img src="./public/img/wave.png" class="olaa" alt="olaa"> -->
            <img src="./public/img/wave.png" alt="olaa" class="olaa">
            
        </section>
        <!-- SECCIÓN DE SOBRE NOSOTROS-->
         <section class="sobre-nosotros" id="sobre-nosotros">
            <div class="imagen">
                <img src="./public/img/sobre-nosotros.png" alt="imagen de sobre nosotros">
            </div>
            <div class="content">
                <h3><span>IUJO-Vet:</span> Donde tu clínica funciona mejor</h3>
                <p>Somos IUJO-Vet, un sistema diseñado para facilitar la gestión de clínicas veterinarias, ayudando tanto al personal como a los dueños de mascotas a mantener el control de sus citas, productos y servicios.
                    Nuestra misión es ofrecer una herramienta sencilla, eficiente y accesible que mejore la experiencia agendar citas veterinaria para todos.</p>
                <a href="<?php echo $URL?>/reservar.php" class="btn">Consulta Online <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </section>
        <!-- baner de comida de mascotas-->
        <div class="comida-perro" id="comida-perro">
            <div class="imagen">
                <img src="./public/img/medicina-baner.png" alt="comida de perro">
            </div>
            <div class="content">
                <h3><span>Citas Medicas</span> consulta con profesionales</h3>
                <p>
                        Sorprende a tu perrito con comida natural: más sabor, más salud y cero conservantes.  
                        En IUJO-Vet, nos preocupamos por el bienestar integral de tu mascota.  
                        Nuestra selección está elaborada con ingredientes frescos, sin químicos ni harinas procesadas.  
                        Ideal para perros de todas las edades que merecen lo mejor.  
                        Además, puedes consultar con nuestros profesionales veterinarios para elegir la dieta más adecuada.
                </p>
                <div class="precios">$5.00 - $10.00 a BCV</div>
                <a href="#productos"><img src="./public/img/huesito.png" alt="Compra ahora comida para perros Air Dried"></a>
            </div>
        </div>
        <!-- baner de comida de mascotas-->
        <div class="comida-gato" id="comida-gato">
            <div class="content">
                <h3><span>Nutrición Natural</span> para gatos exigentes</h3>
                <p>
                    Agenda fácilmente tus consultas con veterinarios certificados.  
                    En IUJO-Vet, brindamos un sistema confiable para que el cuidado de tu mascota esté siempre al día.  
                    Olvídate del papel y los olvidos: con nuestro sistema podrás programar, modificar y recibir recordatorios automáticos.  
                    Porque la salud de tu peludo también merece organización y cariño.
                </p>
                <div class="precios">5.00$ - 10.00$ a BCV</div>
                <a href="#productos"><img src="./public/img/pescadito.png" alt="comida gato"></a>
            </div>
            <div class="imagen">
                <img src="./public/img/comida-gato.png" alt="productos">
            </div>
        </div>
        <!-- SECCIÓN DE PRODUCTOS-->
        <section class="productos" id="productos">
            <h1 class="titulo"> Nuestros <span> Productos </span> </h1>
            <div class="box-container">
            <?php
            foreach ($productos as $producto) {
                ?>

                <div class="box">
                    <div class="image">
                        <img src="<?= $URL."/public/img/productos/".$producto['imagen_producto']; ?>"alt="Producto 1" style="width: 80%;">
                    </div>
                    <div class="content">
                        <h1><?= $producto['nombre_producto']?></h1>
                        <div class="precio"><?= $producto['precio_venta']?>.00$ </div>
                    </div>
                </div>

            <?php
            }
            ?>
            </div>
        </section>
        <!-- SECCIÓN DE SERVICIÓS -->
        <section class="servicios" id="servicios">
            <h1 class="titulo"> Servicios que Prestamos </h1>
            <div class="box-container">
                <div class="box"> 
                    <i class="fas fa-stethoscope"></i>
                    <h3>Citas Médicas</h3>
                    <a href="#" class="btn">Ver más</a>
                </div>
                <div class="box"> 
                    <i class="fas fa-pills"></i>
                    <h3>Venta de Medicamentos</h3>
                    <a href="#" class="btn">Ver más</a>
                </div>
                <div class="box"> 
                    <i class="fas fa-drumstick-bite"></i>
                    <h3>Venta de Croquetas Saludable</h3>
                    <a href="#" class="btn">Ver más</a>
                </div>
                <div class="box">
                    <i class="fas fa-dog"></i>
                    <h3>Peluquería Canina</h3>
                    <a href="#" class="btn">Ver más</a>
                </div>
                <div class="box">
                    <i class="fas fa-syringe"></i>
                    <h3>Vacunas</h3>
                    <a href="#" class="btn">Ver más</a>
                </div>
                <div class="box"> 
                    <i class="fas fa-bone"></i>
                    <h3>Juguetes</h3>
                    <a href="#" class="btn">Ver más</a>
                </div>
            </div>
        </section>
        <footer class="footer">
            <img src="./public/img/wave-_1_.png" alt="ola top">
            <div class="redes">
                <a href="#" class="btn"> <i class="fab fa-facebook-f"></i> Facebook </a>
                <a href="#" class="btn"> <i class="fab fa-instagram"></i> Instagram </a>
                <a href="#" class="btn"> <i class="fab fa-linkedin"></i> LinkedIn </a>
                <a href="#" class="btn"> <i class="fab fa-twitter"></i> Twitter </a>
                <a href="#" class="btn"> <i class="fab fa-pinterest"></i> Pinterest </a>
            </div>
            <div class="creditos"> Creado por <span> El Grupo #3 | Andrés Vento | Rafael Liendo | Kevin Medina |</span>  © Todos los derechos reservados jajaj 2025 </div>
        </footer>
        <!-- Link de Archivo Personalizado de JS-->
        <script src="./public/js/script.js"></script>
    </body>
</html>

<?php 

include('admin/layout/alertas.php');
?>