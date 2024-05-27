<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'Dentista_Corona');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$tratamiento = $_POST['tratamiento'];

echo "Nombre: $nombre<br>";
echo "Email: $email<br>";
echo "Fecha: $fecha<br>";
echo "Hora: $hora<br>";
echo "Tratamiento: $tratamiento<br>";

// Verifica que la hora seleccionada esté disponible
$sql = "SELECT * FROM citas WHERE fecha = '$fecha' AND hora = '$hora'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(['message' => 'Esta hora ya está ocupada.']);
} else {
    // Consulta para obtener el ID del paciente
    $id_query = "SELECT id FROM pacientes WHERE email = '$email'";
    $id_result = $conn->query($id_query);

    if ($id_result && $id_result->num_rows > 0) {
        // Si se encontró el ID del paciente
        $row = $id_result->fetch_assoc();
        $paciente_id = $row['id'];

        echo "ID del Paciente: $paciente_id<br>";

        // Inserta la cita en la base de datos utilizando parámetros preparados
        $stmt = $conn->prepare("INSERT INTO citas (pacientes_id, fecha, hora, estatus, tratamiento) VALUES (?, ?, ?, 'PENDIENTE', ?)");

        if (!$stmt) {
            // Manejo de error en la preparación de la consulta
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        $stmt->bind_param("isss", $paciente_id, $fecha, $hora, $tratamiento); // Cambio en la cadena de formato

        if ($stmt->execute()) {
            $response = "Cita agendada con éxito.";
        } else {
            // Manejo de error en la ejecución de la consulta
            $response = "Error al agendar la cita: " . $conn->error;
        }

        $stmt->close();
    } else {
        $response = "No se encontró el paciente con el correo electrónico proporcionado.";
    }
}

$conn->close();

echo $response;
?>
