<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Dentista_Corona";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$alert_message = "";
$alert_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $tratamiento_id = $_POST['tratamiento_id'];
    $duracion = $_POST['duracion'];

    // Comprobar disponibilidad
    $sql = "SELECT * FROM citas WHERE fecha='$fecha' AND hora='$hora'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $alert_message = "La hora seleccionada ya está reservada.";
        $alert_type = "error";
    } else {
        $sql = "INSERT INTO citas (fecha, hora, tratamiento_id, duracion)
                VALUES ('$fecha', '$hora', $tratamiento_id, $duracion)";

        if ($conn->query($sql) === TRUE) {
            $alert_message = "Nueva cita creada exitosamente";
            $alert_type = "success";
        } else {
            $alert_message = "Error: " . $sql . "<br>" . $conn->error;
            $alert_type = "error";
        }
    }
}

$conn->close();

header("Location: citas.php");
exit();
?>
