<?php
define('APP_NAME', 'Sistema de Gestión de Citas Médicas para Clínica Veterinaria');
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'iujo_veterinaria');

// URL base del proyecto (ajusta según tu puerto real en local)
$URL = "http://localhost/www.iujo-vetclinica.com";

date_default_timezone_set("America/Caracas");
$fecha_hora = date('Y-m-d H:i:s');

/** @var PDO|null $pdo */
$pdo = null;

try {
    $servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR . ";port=3306";
    $pdo = new PDO($servidor, USUARIO, PASSWORD, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);
} catch (PDOException $e) {
    die("⚠️ Error de conexión a la base de datos en el puerto 3307: " . $e->getMessage());
}
