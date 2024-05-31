<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dentista_Corona";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Suponiendo que tienes el usuario_id del usuario actual almacenado en la variable $usuario_id
$usuario_id = 1; // Ejemplo, reemplaza esto con el ID del usuario actual

$sql = "SELECT p.nombre AS nombre_paciente, p.apellido_paterno, p.apellido_materno, c.tratamiento, c.fecha, c.hora, c.estatus
        FROM pacientes p
        INNER JOIN citas c ON p.id = c.pacientes_id
        WHERE c.usuario_id = $usuario_id";

$resultado = mysqli_query($conn, $sql);
?>
