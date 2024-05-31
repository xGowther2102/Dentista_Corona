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
session_start();
if (isset($_SESSION['correo'])) {
    $correo = $_SESSION['correo'];
} else {
    header("../sesion.php");
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
echo $usuario_id;
// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$apellidoPaterno = $_POST['apellidoP'];
$apellidoMaterno = $_POST['apellidoM'];
$tratamiento = $_POST['tratamiento'];
$fechaHora = $_POST['date'];
$duracion = $_POST['duracion'];

// Preparar y ejecutar la consulta SQL para insertar los datos en la tabla de citas
$sql = "INSERT INTO citas (nombre, apellido_paterno, apellido_materno, tratamiento, fecha_hora, duracion, usuario_id)
VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', '$tratamiento', '$fechaHora', '$usuario_id')";

if ($conn->query($sql) === TRUE) {
    // Si la inserción fue exitosa, devolver un mensaje de éxito
    echo "success";
} else {
    // Si hubo un error en la inserción, devolver el mensaje de error
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();