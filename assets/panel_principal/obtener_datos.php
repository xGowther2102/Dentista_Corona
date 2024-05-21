<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dentista_Corona";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $idPaciente = intval($_POST['id']); // Sanitizar entrada

    // Consulta preparada para obtener los detalles de la cita
    $stmt = $conn->prepare("SELECT p.id, p.nombre, p.apellido_paterno, p.apellido_materno, p.historial_medico AS antecedentes, c.fecha_hora, c.estatus, c.tratamiento
FROM citas c INNER JOIN pacientes p ON c.paciente_id = ?;
    ");
    $stmt->bind_param("i", $idPaciente);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $cita = $resultado->fetch_assoc();
        header('Content-Type: application/json');
        echo json_encode($cita);
    } else {
        echo json_encode(["error" => "No se encontró la cita"]);
    }

    $stmt->close();
}

mysqli_close($conn);
?>
