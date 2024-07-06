<?php
// guardar_datos.php

// Recibir datos
$nombre = $_POST['nombre'];
$velocidad = $_POST['velocidad'];
$horario = $_POST['horario'];
$valoracion = $_POST['valoracion'];

// Aquí deberías implementar la lógica para guardar en tu base de datos
// Por ejemplo, usando MySQL o cualquier otra base de datos que prefieras

// Ejemplo de conexión a MySQL utilizando MySQLi
$servername = "sql8.freemysqlhosting.net";
$username = "sql8718276";
$password = "07120712aA!";
$dbname = "sql8718276";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar y ejecutar consulta SQL
$sql = "INSERT INTO puntos_de_carga (nombre, velocidad, horario, valoracion) VALUES ('$nombre', '$velocidad', '$horario', '$valoracion')";

if ($conn->query($sql) === TRUE) {
    echo "Datos guardados correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
