<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/reservas/listado_citas.php');
?>
    <div class="container-fluid">
        <h2 class="mb-4"> <i class="fas fa-clipboard-list"></i> <b> Citas: </b></h2><br>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card card-outline card-success" >
                    <div class="card-header" >
                        <h2 class="card-title"> <b>Citas registradas en el sistema:</b> </h3>
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
                                    <th style="text-align: center;">Dueño</th>
                                    <th style="text-align: center;">Nombre Mascota</th>
                                    <th style="text-align: center;">Servicio</th>
                                    <th style="text-align: center;">Fecha Cita</th>
                                    <th style="text-align: center;">Hora Cita</th>
                                    <th style="text-align: center;">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contador = 0;
                                foreach ($reservas as $reserva) {
                                    $contador = $contador + 1;
                                    $id_reserva = $reserva['id_reserva'];
                                ?>
                                <tr>
                                    <td style="text-align: center;" ><?= $reserva['id_reserva'];?></td>
                                    <td style="text-align: center;" ><?= $reserva['nombre_dueño'] . ' ' . $reserva['apellido_dueño']; ?></td>
                                    <td style="text-align: center;" ><?= $reserva['nombre_mascota'];?></td>
                                    <td style="text-align: center;"><?= $reserva['tipo_servicio'];?></td>
                                    <td style="text-align: center;"><?= $reserva['fecha_cita'];?></td>
                                    <td style="text-align: center;"><?= $reserva['hora_cita'];?></td>
                                    
                                    <td style="text-align: center;">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="ver_reserva.php?id_reserva=<?php echo $id_reserva; ?>" type="button" class="btn btn-success" style="background-color: #469255;"><i class="bi bi-eye"></i></a>
                                            <a href="editar_reservas.php?id_reserva=<?php echo $id_reserva; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                            <a href="eliminar_reserva.php?id_reserva=<?php echo $id_reserva; ?>" class="btn btn-danger"><i class="bi bi-x-circle"></i></a>
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
                "info": "Mostrando de _START_ a _END_ de _TOTAL_ de reservaciones",
                "infoEmpty": "Mostrando 0 a 0 de 0 reservas",
                "infoFiltered": "(Filtrado de _MAX_ total reservaciones)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ reservaciones por página",
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
