<?php
header('Content-Type: application/json');
include 'conexion.php';

// Obtén el contenido JSON del cuerpo de la solicitud
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['id'])) {
    $id = intval($input['id']);

    // Elimina la cita basada en el ID
    $sql = "DELETE FROM citas WHERE pacientes_id = $id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al eliminar la cita: ' . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'ID de cita no proporcionado']);
}
?>
