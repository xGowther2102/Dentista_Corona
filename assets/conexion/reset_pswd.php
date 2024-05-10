<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Requiere las bibliotecas de PHPMailer y la configuración
require '../../vendor/autoload.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
$config = include 'config.php';

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

// Lógica para restablecer la contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["correo"])) {
    // Recibir el correo electrónico enviado desde la solicitud AJAX
    $correo = $_POST["correo"];

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Generar token y fecha de expiración
        $token = bin2hex(random_bytes(20)); // Genera un token aleatorio
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Define la fecha de expiración (por ejemplo, 1 hora desde ahora)

        // Guardar token y fecha de expiración en la base de datos
        $sql_insert = "INSERT INTO reset_password (correo, token, expires_at) VALUES ('$correo', '$token', '$expiry')";
        if ($conn->query($sql_insert) === TRUE) {
            // Enviar correo electrónico con el enlace para restablecer la contraseña
            $mail = new PHPMailer(true);

            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = "smtp-mail.outlook.com";
                $mail->Port = "587";
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth   = true;
                $mail->CharSet = 'UTF-8';
                $mail->Username = $config['email'];
                $mail->Password = $config['password'];
                $mail->setFrom('consultorio.corona@outlook.com', 'Consultorio Dental CORONA');
                $mail->addAddress($correo);
                $mail->isHTML(true); // Indica que el correo tendrá formato HTML
                $mail->Subject = 'Restablecer cuenta';
                $mail->Body = '<html>
<body>
    <h1>Restablecer contraseña</h1>
    <p>Hola, has solicitado restablecer tu contraseña en Consultorio Dental CORONA.</p>
    <p>Para hacerlo, visita este enlace:</p>
    <p><a href="http://192.168.1.86/dentista_corona/assets/forgotpassword/cambiarPassword.php?correo=' . $correo . '&token=' . $token . '">Restablecer contraseña</a></p>
    <img src="cid:CORONA" height="100px" width="100px" alt="CORONA DENTAL">
    </body>
</html>';
                if ($mail->send()) {
                    // Enviar respuesta al cliente (solicitud AJAX)
                    echo "success";
                } else {
                    // Enviar respuesta al cliente (solicitud AJAX)
                    echo "error";
                }
            } catch (Exception $e) {
                // Enviar respuesta al cliente (solicitud AJAX)
                echo "error";
            }
        } else {
            // Enviar respuesta al cliente (solicitud AJAX)
            echo "error";
        }
    } else {
        // Enviar respuesta al cliente (solicitud AJAX)
        echo "not_exists";
    }
} else {
    // Enviar respuesta al cliente (solicitud AJAX)
    echo "error";
}

// Cerrar la conexión a la base de datos al finalizar
$conn->close();
