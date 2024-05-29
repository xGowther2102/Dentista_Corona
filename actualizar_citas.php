<?php
include 'conexion.php';

// Obtener los datos enviados en la solicitud
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
    $id = intval($data['id']); // Asegurarse de que el ID sea un entero
    $nombre = $conn->real_escape_string($data['nombre']);
    $apellido_paterno = $conn->real_escape_string($data['apellido_paterno']);
    $apellido_materno = $conn->real_escape_string($data['apellido_materno']);
    $antecedentes = $conn->real_escape_string($data['antecedentes']);
    $estatus = $conn->real_escape_string($data['estatus']);
    $tratamiento = $conn->real_escape_string($data['tratamiento']);
    $fecha = $conn->real_escape_string($data['fecha']);
    $hora = $conn->real_escape_string($data['hora']);

    // Preparar la consulta SQL para actualizar los datos de la cita
    $sql = "UPDATE citas c
            INNER JOIN pacientes p ON c.pacientes_id = p.id
            SET p.nombre = '$nombre',
                p.apellido_paterno = '$apellido_paterno',
                p.apellido_materno = '$apellido_materno',
                p.historial_medico = '$antecedentes',
                c.estatus = '$estatus',
                c.tratamiento = '$tratamiento',
                c.fecha = '$fecha',
                c.hora = '$hora'
            WHERE c.pacientes_id = $id";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Datos de cita no proporcionados']);
}
?>
