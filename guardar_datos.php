<?php
// guardar_datos.php

// Recibir datos
$nombre = $_POST['nombre'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$velocidad = $_POST['velocidad'];
$horario = $_POST['horario'];
$valoracion = $_POST['valoracion'];

// Conexión a la base de datos (ejemplo utilizando PDO)
$servername = "sql8.freemysqlhosting.net";
$username = "sql8718276";
$password = "07120712aA!";
$dbname = "sql8718276";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar consulta SQL
    $stmt = $conn->prepare("INSERT INTO puntos_de_carga (nombre, latitud, longitud, velocidad, horario, valoracion) 
                            VALUES (:nombre, :latitud, :longitud, :velocidad, :horario, :valoracion)");

    // Bind parameters
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':latitud', $latitud);
    $stmt->bindParam(':longitud', $longitud);
    $stmt->bindParam(':velocidad', $velocidad);
    $stmt->bindParam(':horario', $horario);
    $stmt->bindParam(':valoracion', $valoracion);

    // Ejecutar consulta
    $stmt->execute();

    echo "Datos guardados correctamente";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
