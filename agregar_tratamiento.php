<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombreTratamiento'];
    $duracion = $_POST['duracionTratamiento'];

    if (empty($nombre) || empty($duracion)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO tratamientos (nombre, duracion) VALUES (?, ?)");
    $stmt->bind_param("si", $nombre, $duracion);

    if ($stmt->execute()) {
        echo "Tratamiento agregado exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
