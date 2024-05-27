<?php
include 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['pacientes_id']) && isset($data['estatus'])) {
    $id = intval($data['pacientes_id']);
    $estatus = $data['estatus'];

    // Log para verificar los datos recibidos
    error_log("Datos recibidos - ID: $id, Estatus: $estatus");

    $sql = "UPDATE citas SET estatus = ? WHERE pacientes_id = ?";
    $stmt = $conn->prepare($sql);

    // Log para verificar la consulta preparada
    if ($stmt === false) {
        error_log("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("si", $estatus, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "No se encontró la cita con el ID especificado o no hubo cambios."]);
        }
    } else {
        error_log("Error en la ejecución de la consulta: " . $stmt->error);
        echo json_encode(["success" => false, "message" => "Error en la ejecución de la consulta."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Datos incompletos."]);
}

$conn->close();
?>
