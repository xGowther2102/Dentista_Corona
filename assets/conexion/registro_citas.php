<?php
// Conexión a la base de datos (cambia los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$database = "dentista_corona";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$apellidoPaterno = $_POST['apellidoP'];
$apellidoMaterno = $_POST['apellidoM'];
$tratamiento = $_POST['tratamiento'];
$fechaHora = $_POST['date'];

// Preparar y ejecutar la consulta SQL para insertar los datos en la tabla de citas
$sql = "INSERT INTO citas (nombre, apellido_paterno, apellido_materno, tratamiento, fecha_hora)
VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', '$tratamiento', '$fechaHora')";

if ($conn->query($sql) === TRUE) {
    // Si la inserción fue exitosa, devolver un mensaje de éxito
    echo "success";
} else {
    // Si hubo un error en la inserción, devolver el mensaje de error
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();