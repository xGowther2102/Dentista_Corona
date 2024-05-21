<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['idTratamiento'];
    $nombre = $_POST['nombreTratamiento'];
    $duracion = $_POST['duracionTratamiento'];

    if (empty($id) || empty($nombre) || empty($duracion)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    $stmt = $conn->prepare("UPDATE tratamientos SET nombre = ?, duracion = ? WHERE id = ?");
    $stmt->bind_param("sii", $nombre, $duracion, $id);

    if ($stmt->execute()) {
        echo "Tratamiento actualizado exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
