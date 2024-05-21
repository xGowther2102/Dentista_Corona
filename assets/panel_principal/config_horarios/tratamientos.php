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
    $action = $_POST['action'];

    if ($action === 'create') {
        $nombre = $_POST['nombre'];
        $duracion = $_POST['duracion'];

        $sql = "INSERT INTO tratamientos (nombre, duracion) VALUES ('$nombre', $duracion)";

        if ($conn->query($sql) === TRUE) {
            $alert_message = "Nuevo tratamiento creado exitosamente";
            $alert_type = "success";
        } else {
            $alert_message = "Error: " . $sql . "<br>" . $conn->error;
            $alert_type = "error";
        }
    }
}

$conn->close();

header("Location: index.php");
exit();
?>
