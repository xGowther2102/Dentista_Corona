<?php
// Conexión a la base de datos (reemplaza los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Dentista_Corona";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener los horarios de los pacientes
$sql = "SELECT * FROM horarios";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Inicializar un array para almacenar los horarios
    $horarios = array();

    // Iterar sobre los resultados y agregarlos al array
    while($row = $result->fetch_assoc()) {
        $horarios[] = $row;
    }

    // Codificar el array como JSON y devolverlo como respuesta
    header('Content-Type: application/json');
    echo json_encode($horarios);
} else {
    // Si no hay resultados, devolver un array vacío como JSON
    header('Content-Type: application/json');
    echo json_encode([]);
}

// Cerrar conexión
$conn->close();
?>
