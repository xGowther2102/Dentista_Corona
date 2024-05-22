<?php
// Verificar si se ha enviado un ID válido
if(isset($_POST['id']) && !empty($_POST['id'])) {
    // Conectar a la base de datos (reemplaza los valores según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Dentista_Corona";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Escapar el ID para evitar inyección de SQL
    $id = $conn->real_escape_string($_POST['id']);

    // Consulta SQL para obtener los datos del paciente
    $sql = "SELECT nombre, apellido_paterno, apellido_materno, email FROM pacientes WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener los datos del paciente como un array asociativo
        $row = $result->fetch_assoc();
        
        // Devolver los datos como JSON para ser procesados por AJAX en JavaScript
        echo json_encode($row);
    } else {
        // Si no se encontraron resultados, devolver un mensaje de error
        echo "No se encontraron resultados para el ID proporcionado.";
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Si no se proporcionó un ID válido, devolver un mensaje de error
    echo "ID no válido.";
}
?>
