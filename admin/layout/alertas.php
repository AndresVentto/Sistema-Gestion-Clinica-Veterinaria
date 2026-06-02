<?php
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    $icono = $_SESSION['icono'];
    $titulo = $_SESSION['titulo'];

    // Elimina variables para que no se repitan luego
    unset($_SESSION['mensaje']);
    unset($_SESSION['icono']);
    unset($_SESSION['titulo']);
?>
    <script>
        // Espera a que la página cargue completamente
        window.addEventListener("load", function () {
            console.log("✅ Alertas cargadas correctamente");
            Swal.fire({
                icon: <?= json_encode($icono) ?>,
                title: <?= json_encode($titulo) ?>,
                html: <?= json_encode($mensaje) ?>,
                confirmButtonColor: "#469255",
                confirmButtonText: "Entendido"
            });
        });
    </script>
<?php
}
?>