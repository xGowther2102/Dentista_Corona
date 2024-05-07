<?php
// Conectar a tu base de datos
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "dentista_corona";

// Crear conexión
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar la existencia de un usuario por nombre de usuario
if (isset($_POST['verificarUsuario'])) {
    $user = $_POST['verificarUsuario'];
    $sql_user = "SELECT * FROM usuarios WHERE usuario = '$user'";
    $result_user = $conn->query($sql_user);
    if ($result_user->num_rows > 0) {
        echo "exists"; // El usuario ya existe
        exit; // Detener el script después de enviar la respuesta
    } else {
        echo "notexists"; // El usuario no existe
        exit; // Detener el script después de enviar la respuesta
    }
}

// Verificar la existencia de un correo electrónico
if (isset($_POST['verificarCorreo'])) {
    $correo = $_POST['verificarCorreo'];
    $sql_correo = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $result_correo = $conn->query($sql_correo);
    if ($result_correo->num_rows > 0) {
        echo "exists"; // El correo ya está registrado
        exit; // Detener el script después de enviar la respuesta
    } else {
        echo "notexists"; // El correo no está registrado
        exit; // Detener el script después de enviar la respuesta
    }
}


// Cerrar la conexión a la base de datos
$conn->close();
?>
