<title>Correo Enviado</title>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



require '../../vendor/autoload.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';


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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir el correo electrónico enviado desde el formulario
    $correo = $_POST["correo"];

    // Generar token y fecha de expiración
    $token = bin2hex(random_bytes(20)); // Genera un token aleatorio
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Define la fecha de expiración (por ejemplo, 1 hora desde ahora)

    // Guardar token y fecha de expiración en la base de datos
    $sql = "INSERT INTO reset_password (correo, token, expires_at) VALUES ('$correo', '$token', '$expiry')";
    if ($conn->query($sql) === TRUE) {
        // Enviar correo electrónico con el enlace para restablecer la contraseña
        $mail = new PHPMailer(true);

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            //to view proper logging details for success and error messages
            //$mail->SMTPDebug = 2;
            $mail->Host = "smtp-mail.outlook.com";
            $mail->Port = "587";
            /*tls true*/
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth   = true;
            $mail->CharSet = 'UTF-8';
            $mail->Username = 'consultorio.corona@outlook.com';
            $mail->Password = "Corona135";
            $mail->setFrom('consultorio.corona@outlook.com', 'Consultorio Dental CORONA');
            $mail->addAddress($correo);
            $rutaImagen = 'https://edwher57.freehostia.com/IMAGENES/CORONA.jpeg';
            $correo = $correo; // Email para el ejemplo
            $token_link = $token; // Token para el ejemplo
            $linkCorto = "http://192.168.1.86/dentista_corona/assets/forgotpassword/cambiarPassword.php?correo=$correo&token=$token_link";
            $mail->isHTML(true); // Indica que el correo tendrá formato HTML
            // Lee el contenido de la imagen en forma de cadena
            // $contenidoImagen = file_get_contents($rutaImagen);
            // Convierte la imagen en base64
            //$imagenBase64 = base64_encode($contenidoImagen);
            // Añade la imagen incrustada al correo
            //$mail->addStringEmbeddedImage($imagenBase64, 'CORONA', 'CORONA.jpeg', 'base64', 'jpeg');
            $mail->Subject = 'Restablecer cuenta';
            $mail->Body = '<html>
    <body>
        <h1>Restablecer contraseña</h1>
        <div>
        </div>
        <p>Hola, has solicitado restablecer tu contraseña en Consultorio Dental CORONA.</p>
        <p>Para hacerlo, visita este enlace:</p>
        <p><a href="http://192.168.1.86/dentista_corona/assets/forgotpassword/cambiarPassword.php?correo=' . $correo . '&token=' . $token_link . '">Restablecer contraseña</a></p>
        <img src="cid:CORONA" height="100px" width="100px" alt="CORONA DENTAL">
        </body>
</html>';
            if ($mail->send()) {
                echo '
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Éxito</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                </head>
                <body>
                    <div class="container mt-5">
                    <div class="alert alert-success" role="alert">
                    <strong>¡Correo enviado!</strong> Se ha enviado un correo con instrucciones para restablecer tu contraseña a la dirección: <em>' . $correo . '</em>. Por favor, verifica tu bandeja de entrada y también la carpeta de spam o correo no deseado si no ves el correo en tu bandeja de entrada.
                  </div>;
                    </div>
                    <script>
                        setTimeout(function(){
                            window.location.href = "../../../Dentista_Corona/iniciar_sesion.php"; // Cambia "pagina_inicio.php" por tu página de inicio
                        }, 400000); // Redirecciona después de 3 segundos (3000 milisegundos)
                    </script>
                </body>
                </html>
                ';
            } else {
                echo '
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Éxito</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                </head>
                <body>
                    <div class="container mt-5">
                    <div class="alert alert-danger" role="alert">
                    <strong>Error al enviar el correo.</strong> Ha ocurrido un error al intentar enviar el correo electrónico. Por favor, inténtalo de nuevo más tarde.
                  </div>
                    </div>
                    <script>
                        setTimeout(function(){
                            window.location.href = "../../../Dentista_Corona/iniciar_sesion.php"; // Cambia "pagina_inicio.php" por tu página de inicio
                        }, 300000); // Redirecciona después de 3 segundos (3000 milisegundos)
                    </script>
                </body>
                </html>
                ';
            }
        } catch (Exception $e) {
            echo 'Hubo un error al enviar el correo: ', $mail->ErrorInfo;
        }
    } else {
        echo "Error al guardar el token en la base de datos.";
    }
}

// Verificar la validez del token y la fecha de expiración
if (isset($_GET['correo']) && isset($_GET['token'])) {
    $correo = $_GET['correo'];
    $token = $_GET['token'];

    $sql = "SELECT * FROM reset_password WHERE correo = '$correo' AND token = '$token' AND expires_at > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El token es válido y no ha expirado
        // Redirigir al usuario a una página para cambiar la contraseña
        header("Location: ../../../Dentista_Corona/iniciar_sesion.php?correo=$correo&token=$token");
        exit();
    } else {
        // El token no es válido o ha expirado
        // Mostrar un mensaje de error y redirigir según sea necesario
        echo "El enlace para restablecer la contraseña no es válido o ha expirado.";
        header("Location: ../../../Dentista_Corona/iniciar_sesion.php");
        exit();
    }
}

// Cerrar la conexión a la base de datos al finalizar
$conn->close();


?>


<!--$mail->Body = "Hola, has solicitado restablecer tu contraseña en Consultorio Dental CORONA. Para hacerlo, visita este enlace: http://192.168.2.172/consultorio_d/web/password/cambiar_pwd.php?email=$correo&token=$token"; -->