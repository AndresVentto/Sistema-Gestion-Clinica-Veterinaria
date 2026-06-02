<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
$id_producto = $_GET['id_producto'];
include ('../../app/controllers/productos/ver_productos.php');
?>
<div class="container-fluid">
    <h2 class="mb-4"><b><i class="bi bi-trash3" style="color:#DC3545; "></i> Eliminar producto:</b> </h2><br>
    <div class="row justify-content-center">
        <div class="col-md-10"> <!-- Ancho medio centrado -->
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title"> <b> ¿Estas seguro de querer eliminar este articulo?</b></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Columna principal del formulario -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Código:</label>
                                        <input type="text" class="form-control border-dark" value="<?= $codigo; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Nombre del Producto:</label>
                                        <input type="text" name="nombre_producto" class="form-control border-dark" value="<?= $nombre_producto; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Descripción:</label>
                                <input class="form-control border-dark" name="descripcion" rows="2" value="<?= $descripcion; ?>" placeholder="Detalles del producto..." disabled>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Stock:</label>
                                        <input type="number" name="stock" class="form-control border-dark" value="<?= $stock; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Stock Min:</label>
                                        <input type="number" name="stock_minimo"  class="form-control border-dark" value="<?= $stock_minimo; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Stock Max:</label>
                                        <input type="number" name="stock_maximo"  class="form-control border-dark" value="<?= $stock_maximo; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Precio Compra:</label>
                                        <input type="number" name="precio_compra"  class="form-control border-dark" step="0.01" value="<?= $precio_compra; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Precio Venta:</label>
                                        <input type="number" name="precio_venta" class="form-control border-dark" step="0.01" value="<?= $precio_venta; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fecha de Ingreso:</label>
                                        <input type="date" name="fecha_ingreso" class="form-control border-dark" value="<?= $fecha_ingreso; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Fecha y Hora de Registro: </label>
                                        <input type="date-time" value="<?php echo $fyh_creacion;?>" name="fyh_creacion" class="form-control border-dark" disabled >
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Responsable del Registro:</label>
                                        <input type="text" name="responsable" class="form-control border-dark" value="<?= $nombre_usuario . ' - ' . $rol_usuario; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Columna lateral para imagen -->
                        <div class="col-md-3">
                            <div class="form-group text-center" style="padding: 7.3px;">
                                <img src="<?= $URL."/public/img/productos/".$imagen_producto; ?>" class="form-control border-dark" style="max-width: 90%; height: auto; margin-left:11px;" alt="imagen_producto">
                            </div>
                        </div>
                    </div>

                    <input type="text" name="id_usuario" value="<?= $id_usuario_sesion; ?>" hidden>
                    <hr>

                    <div class="text-right">
                        <form action="<?php echo $URL?>/app/controllers/productos/eliminar_producto.php" method="post" id="formEliminarProducto">
                            <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                            <a href="<?php echo $URL;?>/admin/productos" class="btn btn-secondary" style="margin-right:10px;"><i class="fas fa-ban"></i> Cancelar</a>
                            <button type="button" class="btn btn-danger" id="btnEliminarProducto">
                                <i class="bi bi-trash3"></i> Eliminar Producto
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
document.getElementById("btnEliminarProducto").addEventListener("click", function () {
    Swal.fire({
        title: '¿Estás seguro? 🙀',
        text: "¡Esta acción eliminará este producto permanentemente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#469255',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formEliminarProducto").submit(); // Envía el formulario
        }
    });
});
</script>