<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dentista_corona";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se envió un correo para verificar
if (isset($_POST['verificarCorreo'])) {
  $correo = $_POST['verificarCorreo'];

  // Consulta SQL preparada para verificar si el correo existe en la tabla de usuarios
  $sql = "SELECT correo FROM usuarios WHERE correo = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $correo);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Si se encontró el correo en la base de datos, devolver "exists"
    echo "exists";
  } else {
    // Si no se encontró el correo, devolver otro mensaje (opcional)
    echo "not_exists";
  }

  // Cerrar el statement
  $stmt->close();
} else {
  // Si no se envió ningún correo para verificar, devolver un mensaje de error
  echo "No se proporcionó un correo para verificar.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
