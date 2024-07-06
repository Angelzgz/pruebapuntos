<?php
// Configuración de la base de datos
define('DB_SERVER', 'sql8.freemysqlhosting.net');
define('DB_USERNAME', 'sql8718276');
define('DB_PASSWORD', '07120712aA!');
define('DB_NAME', 'sql8718276');

// Conectar a la base de datos MySQL
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
