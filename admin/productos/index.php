<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/productos/listado_productos.php');
?>
    <div class="container-fluid">
        <h2 class="mb-4"> <i class="fas fa-warehouse"> </i> <b> Inventario: </b></h2><br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-outline card-success" >
                    <div class="card-header" >
                        <h2 class="card-title"> <b>Productos Registrados:</b> </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th style="text-align: center;">N°</th>
                                    <th style="text-align: center;">Codigo</th>
                                    <th style="text-align: center;">Nombre Producto</th>
                                    <th style="text-align: center;">Imagen</th>
                                    <!-- <th style="text-align: center;">Stock</th> -->
                                    <th style="text-align: center;">P.Compra</th>
                                    <th style="text-align: center;">P.Venta</th>
                                    <th style="text-align: center;" title="Fecha de Ingreso">F.Ingreso</th>
                                    <th style="text-align: center;">ACCIONES</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contador = 0;
                                foreach ($productos as $producto) {
                                    $contador = $contador + 1;
                                    $id_producto = $producto['id_producto'];
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?= $contador;?></td>
                                    <td ><?= $producto['codigo'];?></td>
                                    <td ><?= $producto['nombre_producto'];?></td>
                                    <td >
                                        <img src="<?= $URL."/public/img/productos/".$producto['imagen_producto'];?>" width="100px" alt="imagen del producto">
                                    </td>
                                    <!-- <td style="text-align: center;"><?= $producto['stock'];?></td> -->
                                    <td style="text-align: center;"><?= $producto['precio_compra'];?></td>
                                    <td style="text-align: center;"><?= $producto['precio_venta'];?></td>
                                    <td style="text-align: center;"><?= $producto['fecha_ingreso'];?></td>
                                    
                                    <td style="text-align: center;">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="ver_productos.php?id_producto=<?php echo $id_producto; ?>" type="button" class="btn btn-success" style="background-color: #469255;"><i class="bi bi-eye"></i></a>
                                            <a href="editar_productos.php?id_producto=<?php echo $id_producto; ?>" type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                            <a href="eliminar_productos.php?id_producto=<?php echo $id_producto; ?>" type="button" class="btn btn-danger"><i class="bi bi-trash3"></i></a>
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
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
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando de _START_ a _END_ de _TOTAL_ de Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ productos por página",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": [
                {
                    extend: "collection",
                    text: "Reportes",
                    orientation: "landscape",
                    buttons: [
                        { text: "Copiar", extend: "copy" },
                        { extend: "pdf" },
                        { extend: "csv" },
                        { extend: "excel" },
                        { text: "Imprimir", extend: "print" }
                    ]
                },
                {
                    extend: "colvis",
                    text: "Visor de Columnas",
                    collectionLayout: "fixed three-column"
                }
            ],

            // 💡 Aquí viene la magia: colorear paginación al renderizar
            "drawCallback": function () {
                $('.dataTables_paginate .paginate_button').css({
                    'background-color': '#fff',
                    'border': '1px solid #469255',
                    'color': '#469255',
                    'margin': '2px',
                    'border-radius': '5px'
                });

                $('.dataTables_paginate .paginate_button.current').css({
                    'background-color': '#469255',
                    'color': '#fff',
                    'border': '1px solid #469255'
                });

                $('.dataTables_paginate .paginate_button:hover').css({
                    'background-color': '#3b7c4a',
                    'color': '#fff',
                    'border': '1px solid #3b7c4a'
                });
            }
        }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
    });
</script>
