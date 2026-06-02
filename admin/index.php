<?php
include ('../app/config.php');
include ('../admin/layout/parte1.php');
include ('../app/controllers/usuarios/listado_usuarios.php');
include ('../app/controllers/productos/listado_productos.php');
include ('../app/controllers/reservas/listado_citas.php');
?>


<br>
<h2 style="margin-left: 20px;">
    👋🏼¡Hola, <b><?= $nombre_usuario_sesion; ?></b>! Bienvenid@ a tu Sistema de Gestión IUJO-VET
    <img src="<?= $URL; ?>/public/img/logo-login.png" alt="Logo" style="width: 40px; position: relative; top: -5px;">
</h2>
<hr>
<div class="container-fluid">
    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Usuarios</h3>
                <?php
                $contador_de_usuarios = 0;

                foreach ($usuarios as $usuario){
                    $contador_de_usuarios = $contador_de_usuarios + 1;
                }
                ?>
                <h4><?=$contador_de_usuarios;?></h4>

              </div>
              <div class="icon">
                <i class="bi bi-person-lines-fill"></i>
              </div>
              <a href="<?php echo $URL?>/admin/usuarios" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="background-color: rgb(255, 222, 60); color: #000;">
              <div class="inner">
                <h3>Productos</h3>
                <?php
                $contador_de_productos = 0;

                foreach ($productos as $producto){
                    $contador_de_productos = $contador_de_productos + 1;
                }
                ?>
                <h4><?=$contador_de_productos;?></h4>

              </div>
              <div class="icon">
                <i class="bi bi-person-lines-fill"></i>
              </div>
              <a href="<?php echo $URL?>/admin/productos" class="small-box-footer" style=" color: #000;">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Citas</h3>
                <?php
                $contador_de_reservas = 0;

                foreach ($reservas as $reserva){
                    $contador_de_reservas = $contador_de_reservas + 1;
                }
                ?>
                <h4><?=$contador_de_reservas;?></h4>
              </div>
              <div class="icon">
                <i class="bi bi-calendar2-date"></i>
              </div>
              <a href="<?php echo $URL?>/admin/citas" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>65</h3>
                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
</div>







<?php
include ('../admin/layout/parte2.php');
?>


