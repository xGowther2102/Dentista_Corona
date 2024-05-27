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

$dia_semana = $_POST['dia_semana'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fin = $_POST['hora_fin'];
$descanso_inicio = $_POST['descanso_inicio'] ? $_POST['descanso_inicio'] : NULL;
$descanso_fin = $_POST['descanso_fin'] ? $_POST['descanso_fin'] : NULL;

$sql = "INSERT INTO horarios (dia_semana, hora_inicio, hora_fin, descanso_inicio, descanso_fin) VALUES ('$dia_semana', '$hora_inicio', '$hora_fin', '$descanso_inicio', '$descanso_fin')";

if ($conn->query($sql) === TRUE) {
    echo "Horarios guardados correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
