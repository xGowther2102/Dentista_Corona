<?php
// Datos de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "dentista_corona";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se han enviado los datos para cambiar la contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar la validez del token y del correo electrónico
    if (isset($_POST['correo']) && isset($_POST['token']) && isset($_POST['password'])) {
        $correo = $_POST['correo'];
        $token = $_POST['token'];
        $password = $_POST['password'];

        // Verificar si el correo existe en la base de datos
        $check_email_query = "SELECT correo FROM usuarios WHERE correo = '$correo'";
        $email_result = $conn->query($check_email_query);

        if ($email_result->num_rows > 0) {
            // El correo existe en la base de datos, proceder con el cambio de contraseña

            // Verificar si el token es válido y no ha expirado
            $sql = "SELECT * FROM reset_password WHERE correo = '$correo' AND token = '$token' AND expires_at > NOW()";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // El token es válido, actualizar la contraseña del usuario
                $update_sql = "UPDATE usuarios SET password = '$password' WHERE correo = '$correo'";
                if ($conn->query($update_sql) === TRUE) {
                    // Eliminar el token de la tabla de restablecimiento de contraseña
                    $delete_sql = "DELETE FROM reset_password WHERE correo = '$correo' AND token = '$token'";
                    $conn->query($delete_sql);

                    // Redireccionar a otra página después de 2 segundos
                    header('Refresh: 2; URL=./assets/forgotpassword/confirmar_contra.php');
                    exit(); // Asegura que el script se detenga después de la redirección
                } else {
                    echo "Error al actualizar la contraseña.";
                    exit();
                }
            } else {
                echo "El token para restablecer la contraseña no es válido o ha expirado.";
                exit();
            }
        } else {
            echo "El correo proporcionado no está registrado en nuestra base de datos. Verifica que sea el correo correcto.";
            exit();
        }
    }
}

// Cerrar la conexión a la base de datos al finalizar
$conn->close();
?>
