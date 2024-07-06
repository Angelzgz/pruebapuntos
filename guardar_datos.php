<?php
// guardar_datos.php
<?php
// guardar_datos.php

// Recibir los datos del POST
$nombre = $_POST['nombre'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$velocidad = $_POST['velocidad'];
$horario = $_POST['horario'];
$valoracion = $_POST['valoracion'];

// Validar los datos (ejemplo básico, deberías validar y sanitizar adecuadamente)
if (empty($nombre) || empty($latitud) || empty($longitud) || empty($velocidad) || empty($horario) || empty($valoracion)) {
    http_response_code(400); // Bad Request
    exit('Error: Todos los campos son obligatorios.');
}

// Aquí deberías realizar la conexión a tu base de datos y guardar los datos

// Ejemplo de conexión usando PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=tu_base_de_datos', 'usuario', 'contraseña');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ejemplo de consulta para insertar los datos en la tabla 'puntos_carga'
    $sql = "INSERT INTO puntos_carga (nombre, latitud, longitud, velocidad, horario, valoracion) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $latitud, $longitud, $velocidad, $horario, $valoracion]);

    // Cerrar conexión
    $pdo = null;

    // Respuesta de éxito
    http_response_code(200); // OK
    exit('Datos guardados correctamente.');

} catch (PDOException $e) {
    // Error en la conexión o al ejecutar la consulta
    http_response_code(500); // Internal Server Error
    exit('Error al guardar los datos en la base de datos: ' . $e->getMessage());
}
?>


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
