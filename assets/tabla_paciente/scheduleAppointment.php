<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'consultorio_dental');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

// Verifica que la hora seleccionada esté disponible
$sql = "SELECT * FROM citas WHERE fecha = '$fecha' AND hora = '$hora'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(['message' => 'Esta hora ya está ocupada.']);
} else {
    // Inserta la cita en la base de datos
    $sql = "INSERT INTO citas (usuario_id, fecha, hora) VALUES ((SELECT id FROM usuarios WHERE email = '$email'), '$fecha', '$hora')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['message' => 'Cita agendada con éxito.']);
    } else {
        echo json_encode(['message' => 'Error al agendar la cita.']);
    }
}

$conn->close();
?>
