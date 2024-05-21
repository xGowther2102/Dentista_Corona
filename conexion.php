<?php
$servername = "localhost"; // Cambia esto por el nombre de tu servidor, generalmente es "localhost"
$username = "root";  // Cambia esto por tu nombre de usuario
$password = ""; // Cambia esto por tu contraseña
$dbname = "Dentista_Corona"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
