<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

$id_producto = $_GET['id_producto'];
include ('../../app/controllers/productos/ver_productos.php');
?>

<br>
<div class="container-fluid">
    <h2 class="mb-4"><i class="bi bi-pencil-square" style="color:#ffc107; "></i> <b>Actualizar el producto:</b> <?php echo " ". $nombre_producto;?></h2><br>
    <div class="row justify-content-center">
        <div class="col-md-11"> <!-- Ancho medio centrado -->
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title"><b>Datos del producto:</b></h3>
                </div>
                <div class="card-body">
                    <form action="../../app/controllers/productos/editar_producto.php" method="post" enctype="multipart/form-data" style="padding: 10px;">
                        <div class="row">
                            <!-- Columna principal del formulario -->
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Código:</label>
                                            <input type="text" class="form-control border-secondary" value="<?= $codigo; ?>" disabled>
                                            <input type="text" name="codigo" class="form-control border-secondary" value="<?= $codigo; ?>" hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Nombre del Producto:</label>
                                            <input type="text" name="nombre_producto" class="form-control border-secondary" value="<?= $nombre_producto ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Descripción:</label>
                                    <input class="form-control border-secondary" name="descripcion" placeholder="Detalles del producto..." value="<?= $descripcion; ?>">
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Stock:</label>
                                            <input type="number" name="stock" class="form-control border-secondary" value="<?= $stock; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Stock Min:</label>
                                            <input type="number" name="stock_minimo" class="form-control border-secondary" value="<?= $stock_minimo; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Stock Max:</label>
                                            <input type="number" name="stock_maximo" class="form-control border-secondary" value="<?= $stock_maximo; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Precio Compra:</label>
                                            <input type="number" name="precio_compra" class="form-control border-secondary" value="<?= $precio_compra; ?>" step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Precio Venta:</label>
                                            <input type="number" name="precio_venta" class="form-control border-secondary" value="<?= $precio_venta; ?>" step="0.01" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Fecha de Ingreso:</label>
                                    <input type="date" name="fecha_ingreso" class="form-control border-secondary" value="<?= $fecha_ingreso; ?>" required>
                                </div>
                            </div>

                            <!-- Columna lateral para imagen -->
                            <div class="col-md-3">
                                <div class="form-group text-center" style="padding: 7.3px;"><br>

                                    <!-- Botón estilizado para seleccionar imagen -->
                                    <label for="file" class="btn btn-warning font-weight-normal">
                                        <i class="fas fa-upload"></i> Cambiar imagen
                                    </label>

                                    <!-- Imagen actual con ID para poder ocultarla con JS -->
                                    <img id="imagen_actual" src="<?= $URL."/public/img/productos/".$imagen_producto; ?>" 
                                        class="border-secondary" alt="imagen_producto" 
                                        style="max-width: 90%; height: auto; margin-left:11px;">

                                    <!-- Input de archivo (oculto pero funcional) -->
                                    <input type="file" name="imagen" id="file" style="display: none;" accept="image/*">

                                    <!-- Aquí se previsualiza la nueva imagen -->
                                    <div id="list" class="mt-3"></div>

                                    <!-- Botón para cancelar selección -->
                                    <button type="button" id="cancelImage" class="btn btn-secondary mt-3" style="display: none; width: 100%;">
                                        Cancelar
                                    </button>

                                    <!-- Campo oculto para enviar la imagen actual -->
                                    <input type="hidden" name="imagen_actual" value="<?= $imagen_producto; ?>">
                                </div>
                            </div>
                        </div> <!-- fin del .row -->
                        <!-- Campo oculto -->
                        <input type="hidden" name="id_usuario" value="<?= $id_usuario_sesion; ?>">
                        <input type="hidden" name="id_producto" value="<?= $id_producto; ?>">
                        <!-- Botones alineados abajo y a la derecha -->
                        <hr>
                        <div class="text-right mt-3">
                            <a href="<?= $URL ?>/admin/productos" class="btn btn-secondary mr-2">
                                <i class="fas fa-ban"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning" >
                                <i class="fas fa-cart-plus"></i> Actualizar Producto
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
    document.getElementById("file").addEventListener('change', function(evt) {
        const files = evt.target.files;
        if (files.length === 0) return;

        const file = files[0];

        if (!file.type.match('image.*')) {
            alert("Por favor selecciona un archivo de imagen válido.");
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const imgHTML = `
                <div class="text-center">
                    <img src="${e.target.result}" class="img-thumbnail" style="max-width: 85%; height: auto;" title="${file.name}">
                    <div class="mt-2"><strong>Imagen: </strong>${file.name}</div>
                </div>
            `;
            document.getElementById("list").innerHTML = imgHTML;
            document.getElementById("cancelImage").style.display = "block";
            const imgActual = document.getElementById("imagen_actual");
            if (imgActual) {
                imgActual.style.display = "none"; // Ocultar imagen original
            }
        };
        reader.readAsDataURL(file);
    });

    document.getElementById("cancelImage").addEventListener('click', function() {
        document.getElementById("file").value = ""; // Limpiar input file
        document.getElementById("list").innerHTML = ""; // Quitar previsualización
        this.style.display = "none"; // Ocultar botón de cancelar
        const imgActual = document.getElementById("imagen_actual");
        if (imgActual) {
            imgActual.style.display = "block"; // Mostrar imagen original de nuevo
        }
    });
</script>

