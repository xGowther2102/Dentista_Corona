<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dentista_Corona";
$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fechaHora = $_POST['fechaHora'];
    
    // Convertir la fecha y hora a los formatos adecuados
    $fecha = date('Y-m-d', strtotime($fechaHora));
    $hora = date('H:i:s', strtotime($fechaHora));

    $sql = "UPDATE citas SET fecha = ?, hora = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $fecha, $hora, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>
