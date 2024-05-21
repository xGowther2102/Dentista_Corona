<?php
// Verificar si se enviaron datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $fecha = $_POST['fecha'];
    $diaActual = $_POST['diaActual'];
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Dentista_Corona";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

   // Preparar la consulta SQL con marcadores de posición
$sql = "INSERT INTO horarios (fecha, dia_semana, hora_inicio, hora_fin) VALUES (?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);

// Vincular los parámetros
$stmt->bind_param("ssss", $fecha, $diaActual, $horaInicio, $horaFin);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error: ' . $conn->error; // Devuelve el mensaje de error específico de MySQL
}

// Cerrar la declaración
$stmt->close();

}
?>
