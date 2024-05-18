<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dentista_Corona";
$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Conexión fallida: " . mysqli_connect_error());
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $idPaciente  = $_POST['id'];

    // Consulta para obtener los detalles de la cita
    $sql = "SELECT * FROM citas WHERE paciente_id = $idPaciente";
    $resultado = mysqli_query($conn, $sql);
    $cita = mysqli_fetch_assoc($resultado);

    // Devolver los detalles de la cita como JSON
    echo json_encode($cita);
}

mysqli_close($conn);
?>
