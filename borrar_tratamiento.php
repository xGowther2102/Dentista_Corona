<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    if (empty($id)) {
        echo "ID del tratamiento es obligatorio.";
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM tratamientos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Tratamiento borrado exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
