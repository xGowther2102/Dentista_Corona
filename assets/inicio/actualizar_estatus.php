<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $date = isset($_POST['date']) ? $_POST['date'] : null;
    $time = isset($_POST['time']) ? $_POST['time'] : null;

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Dentista_Corona";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($status == 'PENDIENTE' && $date && $time) {
        $sql = "UPDATE citas SET estatus='PENDIENTE', fecha='$date', hora='$time' WHERE id=$id";
    } else {
        $sql = "UPDATE citas SET estatus='$status' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
