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
                // Contenido del correo con diseño mejorado
                $mail->isHTML(true);
                $mail->Body = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #222;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            .header {
                background-color: #1C3059;
                color: #fff;
                text-align: center;
                padding: 10px;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
            }
            .content {
                padding: 20px;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff;
                text-decoration: none;
                border-radius: 3px;
            }
            .button:hover {
                background-color: #1C3059;
                color: #fff;
            }
            .footer {
                margin-top: 20px;
                text-align: center;
                color: #222;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Restablecer Contraseña</h1>
                <img src="http://edwher57.freehostia.com/img/Logo_Big.png" height="100px" width="100px" alt="CORONA DENTAL">
            </div>
            <div class="content">
            <img src="http://edwher57.freehostia.com/img/email-reset.png" height="80px" width="80px" alt="Cambiar contraseña">
                <p>Hola, has solicitado restablecer tu contraseña en Consultorio Dental CORONA.</p>
                <p>Para hacerlo, visita este enlace:</p>
                <p><a class="button" href="http://192.168.1.86/dentista_corona/assets/forgotpassword/cambiarPassword.php?correo=' . $correo . '&token=' . $token . '">Restablecer Contraseña</a></p>
            </div>
            <div class="footer">
                <p>Si no solicitaste este cambio, por favor ignora este correo.</p>
                <p>Atentamente,<br>Consultorio Dental CORONA</p>
            </div>
        </div>
    </body>
    </html>
    ';

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
