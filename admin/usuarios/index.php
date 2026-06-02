<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/usuarios/listado_usuarios.php');?>
    <div class="container-fluid">
        <h1 class="mb-4"><i class="bi bi-person-vcard"></i> <b>Lista de Usuarios: </b></h1><br>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card card-outline card-success" >
                    <div class="card-header" >
                        <h2 class="card-title"> <b>Usuarios Registrados:</b> </h3>
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
                                    <th style="text-align: center;">Nro </th>
                                    <th style="text-align: center;">Nombre </th>
                                    <th style="text-align: center;">Apellido </th>
                                    <th style="text-align: center;">Cédula </th>
                                    <th style="text-align: center;">Correo Electrónico </th>
                                    <th style="text-align: center;">Rol de Usuario</th>
                                    <th style="text-align: center;">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $contador = 0;
                                foreach ($usuarios as $usuario) { 
                                    $contador = $contador + 1; 
                                    $id_usuario = $usuario['id_usuario'];
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $contador;?></td>
                                        <td style="text-align: center;"><?php echo $usuario['nombre'];?></td>
                                        <td style="text-align: center;"><?php echo $usuario['apellido'];?></td>
                                        <td style="text-align: center;"><?php echo $usuario['cedula'];?></td>
                                        <td><?php echo $usuario['correo'];?></td>
                                        <td style="text-align: center;"><?php echo $usuario['rol_usuario'];?></td>
                                        <td style="text-align: center;">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="ver_usuario.php?id_usuario=<?php echo $id_usuario; ?>" type="button" class="btn btn-success" style="background-color: #469255;"> <i class="bi bi-eye"></i> Ver </a>
                                                <a href="editar_usuario.php?id_usuario=<?php echo $id_usuario; ?>" type="button" class="btn btn-warning"> <i class="bi bi-pencil-square"></i> Editar </a>
                                                <a href="eliminar_usuario.php?id_usuario=<?php echo $id_usuario; ?>" type="button" class="btn btn-danger"> <i class="bi bi-trash3"></i> Eliminar </a>
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
                "info": "Mostrando de _START_ a _END_ de _TOTAL_ de Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ usuarios por página",
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
