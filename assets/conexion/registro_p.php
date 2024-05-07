<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $user = $_POST['user'];
    $correo = $_POST['correo'];
    $password = $_POST['password']; // Asegúrate de implementar la lógica de almacenamiento seguro de contraseñas, como el uso de funciones hash como password_hash()

    // Aquí puedes realizar la validación de los datos, por ejemplo, verificar que no estén vacíos y cumplir con ciertas reglas de formato

    // Conectar a tu base de datos y guardar los datos
    // Ejemplo de conexión a una base de datos MySQL
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

    // Consulta SQL para insertar los datos del usuario
    $sql = "INSERT INTO usuarios (nombre, usuario, correo, password) VALUES ('$nombre', '$user', '$correo', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";

        // Cerrar la conexión a la base de datos
        $conn->close();

        // Esperar 2 segundos antes de redirigir
        sleep(2);

        // Redireccionar a otra página
        header('Location: ../../assets/login/usuario_registrado.php');
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error al registrar usuario: " . $conn->error;
        $conn->close(); // Cerrar la conexión a la base de datos
    }
}
?>
