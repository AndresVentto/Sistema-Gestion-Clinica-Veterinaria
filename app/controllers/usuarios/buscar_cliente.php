<?php
include('../../config.php'); // ✅ Asegúrate que esta ruta sea correcta según tu estructura

if (!isset($_POST['consulta'])) {
    exit("Consulta vacía");
}

$consulta = trim($_POST['consulta']);

$sql = "SELECT id_usuario, nombre, apellido, correo 
        FROM tbl_usuarios 
        WHERE rol_usuario = 'CLIENTE' AND (
            nombre LIKE :consulta OR 
            apellido LIKE :consulta OR 
            correo LIKE :consulta)
        LIMIT 5";

$query = $pdo->prepare($sql);
$consulta_like = "%$consulta%";
$query->bindParam(':consulta', $consulta_like);
$query->execute();

$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

if ($resultados) {
    foreach ($resultados as $cliente) {
        $id = $cliente['id_usuario'];
        $nombre_completo = $cliente['nombre'] . ' ' . $cliente['apellido'] . " (" . $cliente['correo'] . ")";
        $nombre_completo_escapado = htmlspecialchars($nombre_completo, ENT_QUOTES, 'UTF-8');
        echo '<button type="button" class="list-group-item list-group-item-action" onclick="seleccionarCliente(' . $id . ', \'' . $nombre_completo_escapado . '\')">';
        echo $nombre_completo_escapado;
        echo '</button>';
    }
} else {
    echo '<div class="list-group-item">No se encontraron resultados.</div>';
}
