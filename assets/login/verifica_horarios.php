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

session_start();
if (isset($_SESSION['correo'])) {
    $correo = $_SESSION['correo'];
} else {
    header("Location: ../sesion.php"); // Corrige el encabezado de la redirección
    exit();
}

// Obtener el ID del usuario basado en el correo electrónico
$sql_usuario = "SELECT id FROM usuarios WHERE correo = '$correo'";
$result_usuario = $conn->query($sql_usuario);

if ($result_usuario->num_rows > 0) {
    $row_usuario = $result_usuario->fetch_assoc();
    $usuario_id = $row_usuario['id'];
} else {
    echo "Usuario no encontrado.";
    exit();
}


// Verificar si se recibió el usuario_id
if(isset($usuario_id)) {
    // Consulta para verificar si existen horarios guardados para el usuario
    $query = "SELECT COUNT(*) as total FROM horarios WHERE usuario_id = '$usuario_id'";
    $result = $conn->query($query);

    // Si hay al menos un horario guardado, devolver 'success', de lo contrario, devolver 'error'
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['total'] > 0) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error: No se pudo ejecutar la consulta';
    }
} else {
    // Si no se recibió el usuario_id, devolver un mensaje de error
    echo 'error: usuario_id no recibido';
}

$conn->close(); // Cierra la conexión a la base de datos
?>
