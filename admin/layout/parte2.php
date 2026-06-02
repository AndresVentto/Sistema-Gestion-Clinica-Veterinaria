               
                </div>
            </div>
            <footer class="main-footer">
                <!-- A la derecha -->
                <div class="float-right d-none d-sm-inline">
                    Sistema de Gestión de Citas Medicas para Clinica Veterinaria.
                </div>
                <!-- A la izquierda -->
                <strong>&copy; <?php echo date("Y"); ?> <a href="<?php echo $URL;?>" style="color:#469255;">IUJO-VET</a>.</strong> Todos los derechos reservados por Andrés Vento | Rafael Liendo | Kevin Medina.
            </footer>
        </div>
        <!-- ./wrapper -->
        <!-- REQUIRED SCRIPTS -->
        <script>
            function togglePassword(id, el) {
                const input = document.getElementById(id);
                const icon = el.querySelector('i');
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            }
        </script>
        <script>
            document.getElementById("btnEliminarUsuario").addEventListener("click", function () {
                Swal.fire({
                    title: "¿Estás seguro? 🙀",
                    text: "¡Esta acción eliminará al usuario permanentemente!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#469255",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("formEliminar").submit();
                    }
                });
            });
            document.getElementById("btnEliminarProducto").addEventListener("click", function () {
                Swal.fire({
                    title: '¿Estás seguro? 🙀',
                    text: "¡Esta acción eliminará a este producto permanentemente!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#469255',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest("form").submit(); // Enviar el formulario si se confirma
                    }
                });
            });
            document.getElementById("btnEliminarCita").addEventListener("click", function (e) {
                    e.preventDefault();  // Prevenir el envío inmediato del formulario
                    Swal.fire({
                        title: '¿Estás seguro? 🙀',
                        text: "¡Esta acción eliminará la cita permanentemente!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#469255',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si el usuario confirma, entonces se envía el formulario
                            this.closest("form").submit();
                        }
                    });
                });
        </script>
        <!-- Bootstrap 4 -->
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo $URL;?>/public/templates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    </body>
</html>