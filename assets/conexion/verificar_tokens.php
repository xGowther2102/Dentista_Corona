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
                $update_sql = "UPDATE usuarios SET contrasena = '$password' WHERE correo = '$correo'";
                if ($conn->query($update_sql) === TRUE) {
                    // Eliminar el token de la tabla de restablecimiento de contraseña
                    $delete_sql = "DELETE FROM reset_password WHERE correo = '$correo' AND token = '$token'";
                    $conn->query($delete_sql);
                    echo '
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Éxito</title>
                        <meta http-equiv="refresh" content="2;url=../../pages/login/login.php"> // Redirecciona después de 2 segundos
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    </head>
                    <body>
                        <!-- Puedes agregar aquí el contenido que desees mostrar -->
                    </body>
                    </html>
                    ';
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="../../images/Logo_Big.png" type="image/png">
    <link rel="stylesheet" href="../../css/registro_login.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="img-container">
                    <img src="../../images/Logo_Big.png" alt="Login Image" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin-bottom: 0;">Cambio de contraseña</h3> <!-- Added margin to h3 -->
                    </div>
                    <div class="card-body">

                        <div class="img-container">
                            <img src="../../images/password.png" alt="Icono" style="max-width: 100px; margin-right: 1px;">
                        </div>

                        <form id="cambiarContrasenaForm" method="post">

                            <div class="form-group row parrafo">
                                <div class="col-sm-10">
                                    <p class="text-white">
                                        Elige una contraseña que no hayas usado hasta ahora, para proteger tu cuenta,
                                        debes de elegir una contraseña nueva cada vez que restablezcas.
                                    </p>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password" class="col-sm-12 col-form-label text-white">Nueva Contraseña:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control text-white" id="password" name="password" placeholder="Ingrese su contraseña">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-outline-light btn-eye" id="togglePassword">👁️</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="confirm_password" class="col-sm-12 col-form-label text-white">Confirmar contraseña:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control text-white" id="confirm_password" name="confirm_password" placeholder="Confirme su contraseña">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-outline-light btn-eye" id="toggleConfirmPassword">👁️</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Restablecer</button>
                                </div>
                            </div>

                            <input type="hidden" name="correo" value="<?php echo $_GET['correo']; ?>">
                            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '👁️';
        });

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('confirm_password');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '👁️';
        });

        document.getElementById('cambiarContrasenaForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let contrasena = document.getElementById('password').value;

            // Validación de la contraseña utilizando una expresión regular
            let strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})");
            if (!strongRegex.test(contrasena)) {
                document.getElementById('mensajeContrasena').innerHTML = 'La contraseña debe tener al menos 8 caracteres, una letra en mayúscula y un número.';
                document.getElementById('mensajeContrasena').style.display = 'block';
            } else {
                // Si la contraseña es válida, enviar el formulario para procesar el cambio
                this.submit();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>