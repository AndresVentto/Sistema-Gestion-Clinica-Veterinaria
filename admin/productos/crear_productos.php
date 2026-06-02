<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/productos/listado_productos.php');
?>
<?php
$contador = 1;
foreach ($productos as $producto) {
    $contador = $contador + 1;
}
function ceros($numero) {
    $len = 0;
    $cantidad_ceros = 5;
    $aux = $numero;
    $pos = strlen($numero);
    $len = $cantidad_ceros - $pos;
    for ($i = 0; $i < $len; $i++ ){
        $aux = "0" . $aux; 
    }
    return $aux;
} 
?>
<br>
<div class="container-fluid">
    <h2 class="mb-4"><b><i class="fas fa-tags"></i> Registrar un nuevo producto:</b> </h2><br>
    <div class="row justify-content-center">
        <div class="col-md-11"> <!-- Ancho medio centrado -->
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Datos del producto:</b></h3>
                </div>
                <div class="card-body">
                    <form action="../../app/controllers/productos/crear_producto.php" method="post" enctype="multipart/form-data" style="padding: 10px;">
                        <div class="row">
                            <!-- Columna principal del formulario -->
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Código:</label>
                                            <input type="text" class="form-control border-success" value="P-<?= ceros($contador); ?>" disabled>
                                            <input type="text" name="codigo" class="form-control border-success" value="P-<?= ceros($contador); ?>" hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Nombre del Producto:</label>
                                            <input type="text" name="nombre_producto" class="form-control border-success" require>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Descripción:</label>
                                    <textarea class="form-control border-success" name="descripcion" rows="2" placeholder="Detalles del producto..."></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Stock:</label>
                                            <input type="number" name="stock" class="form-control border-success" require>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Stock Min:</label>
                                            <input type="number" name="stock_minimo"  class="form-control border-success" require>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Stock Max:</label>
                                            <input type="number" name="stock_maximo"  class="form-control border-success" require>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Precio Compra:</label>
                                            <input type="number" name="precio_compra"  class="form-control border-success" step="0.01" require>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Precio Venta:</label>
                                            <input type="number" name="precio_venta" class="form-control border-success" step="0.01" require>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Fecha de Ingreso:</label>
                                    <input type="date" name="fecha_ingreso" class="form-control border-success" require>
                                </div>
                            </div>
                            <!-- Columna lateral para imagen -->
                            <div class="col-md-3">
                                <div class="form-group text-center" style="padding: 7.3px;"><br>
                                    <label for="file" class="btn btn-success font-weight-normal" style="background-color: #469255; transition: 0.3s;">
                                        <i class="fas fa-upload"> </i> Seleccionar imagen
                                    </label>
                                    <input type="file" name="imagen"  id="file" style="display: none;" class="form-control border-success">
                                    <div id="list" class="mt-3"></div>
                                    <button type="button" id="cancelImage" class="btn btn-secondary mt-3" style="display: none; width: 100%;">Cancelar imagen</button>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="id_usuario" value="<?= $id_usuario_sesion; ?>" hidden>
                        <hr>
                        <div class="text-right">
                            <a href="<?= $URL ?>/admin/productos" class="btn btn-secondary mr-2">
                                <i class="fas fa-ban"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success" style="background-color:#469255;">
                                <i class="fas fa-cart-plus"></i> Agregar Producto
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
function arquivo(evt) {
    const files = evt.target.files;
    for (let i = 0; i < files.length; i++) {
        const f = files[i];
        if (!f.type.match('image.*')) {
            continue;
        }
        const reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                const imgHTML = `
                    <div class="text-center">
                        <img src="${e.target.result}" class="img-thumbnail" style="max-width: 85%; height: auto;" title="${theFile.name}">
                        <div class="mt-2"><strong>Imagen: </strong>${theFile.name}</div>
                    </div>
                `;
                document.getElementById("list").innerHTML = imgHTML;
                document.getElementById("cancelImage").style.display = "block";  // mustrar el botón de cancelar
            };
        })(f);
        reader.readAsDataURL(f);
    }
}
document.getElementById("file").addEventListener('change', arquivo, false);
// Función para cancelar la imagen seleccionada con manipulacion de DOM
document.getElementById("cancelImage").addEventListener('click', function() {
    document.getElementById("file").value = "";  // resetear el input del archivo
    document.getElementById("list").innerHTML = "";  // aqui se elimina la imagen mostrada
    document.getElementById("cancelImage").style.display = "none";  // y por default va a ocultar el botón de cancelar
});
</script>
