<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $dias = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];

    // Conectar a la base de datos
    $conn = new mysqli($servername = "localhost", "root", "", "Dentista_Corona");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    foreach ($dias as $dia) {
        $hora_inicio = $_POST['hora_inicio_' . $dia];
        $hora_fin = $_POST['hora_fin_' . $dia];

        $sql = "INSERT INTO horarios (usuario_id, dia_semana, hora_inicio, hora_fin) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isss', $usuario_id, $dia, $hora_inicio, $hora_fin);

        if ($stmt->execute() === TRUE) {
            echo "Horario de $dia registrado con éxito.<br>";
        } else {
            echo "Error al registrar el horario de $dia: " . $stmt->error . "<br>";
        }

        $stmt->close();
    }

    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
