<?php
// Permitir solicitudes desde cualquier origen (solo para desarrollo local)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Verificar si la solicitud es OPTIONS y responder con éxito
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir y decodificar los datos JSON enviados por Axios desde el frontend
    $data = json_decode(file_get_contents("php://input"), true);

    // Extraer los datos del cuerpo de la solicitud
    $latitud = $data['latitud'];
    $longitud = $data['longitud'];
    $nombre = $data['nombre'];
    $velocidad = $data['velocidad'];
    $horario = $data['horario'];
    $valoracion = $data['valoracion'];

    // Conectar a tu base de datos MySQL
    $servername = "sql8.freemysqlhosting.net";
    $username = "sql8718276";
    $password = "07120712aA!";
    $dbname = "sql8718276";

    // Crear una conexión utilizando MySQLi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Escapar los datos para evitar inyecciones SQL (opcional, pero recomendado)
    $latitud = mysqli_real_escape_string($conn, $latitud);
    $longitud = mysqli_real_escape_string($conn, $longitud);
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $velocidad = mysqli_real_escape_string($conn, $velocidad);
    $horario = mysqli_real_escape_string($conn, $horario);
    $valoracion = mysqli_real_escape_string($conn, $valoracion);

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO puntos_carga (latitud, longitud, nombre, velocidad, horario, valoracion)
            VALUES ('$latitud', '$longitud', '$nombre', '$velocidad', '$horario', '$valoracion')";

    if ($conn->query($sql) === TRUE) {
        // Si la inserción fue exitosa, enviar una respuesta de éxito
        echo "Datos guardados correctamente";
    } else {
        // Si hubo un error en la inserción, enviar un mensaje de error
        echo "Error al guardar los datos: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no es una solicitud POST, responder con un mensaje de error
    echo "Acceso denegado";
}
?>


