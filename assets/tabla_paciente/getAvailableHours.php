<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'dentista_corona');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$fecha = $_GET['fecha']; // Utilizamos $_GET en lugar de $_POST
$dia_semana = date('w', strtotime($fecha)); // 0 (para domingo) hasta 6 (para sábado)

// Mapear día de la semana en español
$dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
$dia_semana_nombre = $dias[$dia_semana];

// Obtén las horas laborales según la configuración del administrador
$sql = "SELECT hora_inicio, hora_fin FROM horarios WHERE dia_semana = '$dia_semana_nombre'";
$result = $conn->query($sql);

$horas_disponibles = [];
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hora_inicio = new DateTime($row['hora_inicio']);
    $hora_fin = new DateTime($row['hora_fin']);

    // Genera todas las horas dentro del rango laboral
    while ($hora_inicio < $hora_fin) {
        $hora_actual = $hora_inicio->format('H:i');

        // Verifica si la hora actual está ocupada
        $sql = "SELECT COUNT(*) as total FROM citas WHERE fecha = '$fecha' AND hora = '$hora_actual'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ($row['total'] == 0) {
            // Si la hora no está ocupada, se agrega a las horas disponibles
            $horas_disponibles[] = $hora_actual;
        }

        // Avanza a la siguiente hora
        $hora_inicio->modify("+1 hour");
    }
}

// Devuelve las horas disponibles como JSON
header('Content-Type: application/json'); // Establece la cabecera para indicar que se envía JSON
echo json_encode($horas_disponibles);

$conn->close();
?>
