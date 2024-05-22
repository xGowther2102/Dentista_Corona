<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Dentista_Corona";
$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Conexión fallida: " . mysqli_connect_error());
}
$sql = "SELECT id, nombre, apellido_paterno, apellido_materno, telefono, email, TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) AS edad, historial_medico, sexo
FROM pacientes WHERE id = id";
$resultado = mysqli_query($conn, $sql);
?>