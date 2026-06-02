<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
$id_producto = $_GET['id_producto'];
include ('../../app/controllers/productos/ver_productos.php');
?>

<div class="container-fluid">
    <h2 class="mb-4"><b><i class="fas fa-tags"></i> Producto:</b> </h2><br>
    <div class="row justify-content-center">
        <div class="col-md-11"> <!-- Ancho medio centrado -->
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Datos del producto:</b></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Columna principal del formulario -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Código:</label>
                                        <input type="text" class="form-control border-success" value="<?= $codigo; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Nombre del Producto:</label>
                                        <input type="text" name="nombre_producto" class="form-control border-success" value="<?= $nombre_producto; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Descripción:</label>
                                <input class="form-control border-success" name="descripcion" rows="2" value="<?= $descripcion; ?>" placeholder="Detalles del producto..." disabled>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Stock:</label>
                                        <input type="number" name="stock" class="form-control border-success" value="<?= $stock; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Stock Míni:</label>
                                        <input type="number" name="stock_minimo"  class="form-control border-success" value="<?= $stock_minimo; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Stock Máxi:</label>
                                        <input type="number" name="stock_maximo"  class="form-control border-success" value="<?= $stock_maximo; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Precio Compra:</label>
                                        <input type="number" name="precio_compra"  class="form-control border-success" step="0.01" value="<?= $precio_compra; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Precio Venta:</label>
                                        <input type="number" name="precio_venta" class="form-control border-success" step="0.01" value="<?= $precio_venta; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fecha de Ingreso:</label>
                                        <input type="date" name="fecha_ingreso" class="form-control border-success" value="<?= $fecha_ingreso; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Fecha y Hora de Registro: </label>
                                        <input type="date-time" value="<?php echo $fyh_creacion;?>" name="fyh_creacion" class="form-control border-success" disabled >
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Responsable del Registro:</label>
                                        <input type="text" name="responsable" class="form-control border-success" value="<?= $nombre_usuario . ' - ' . $rol_usuario; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Columna lateral para imagen -->
                        <div class="col-md-3">
                            <div class="form-group text-center" style="padding: 7.3px;"><br>
                                <img src="<?= $URL."/public/img/productos/".$imagen_producto; ?>" class="form-control border-success" style="max-width: 90%; height: auto; margin-left:11px;" alt="imagen_producto">
                            </div>
                        </div>
                    </div>
                    <input type="text" name="id_usuario" value="<?= $id_usuario_sesion; ?>" hidden>
                    <hr>
                    <div class="text-right">
                        <div class="col-md-12">
                            <a href="<?php echo $URL;?>/admin/productos/index.php" class="btn btn-secondary" style="margin-right:10px;"><i class="bi bi-arrow-return-left"></i>  Volver</a>
                        </div>
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

