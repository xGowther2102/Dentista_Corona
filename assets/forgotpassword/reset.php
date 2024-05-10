<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="./images/Logo_Big.png" type="image/png">
    <link rel="stylesheet" href="../../../Dentista_Corona/css/registro_login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="img-container">
                    <img src="./images/Logo_Big.png" alt="Login Image" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin-bottom: 0;">Restablecer Contraseña</h3> <!-- Added margin to h3 -->
                    </div>
                    <div class="card-body">
                        <br>
                        <div class="img-container">
                            <img src="./images/reset.png" alt="Icono" style="max-width: 100px; margin-right: 1px;">
                        </div>
                        <br>
                        <br>
                        <form id="passwordResetForm" method="POST">
                            <!-- Explicación sobre el campo Correo Electrónico -->
                            <p>Por favor, ingrese su correo electrónico para restablecer su contraseña:</p>
                            <br>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label text-white">Correo Electrónico:</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control text-white" id="correo" name="correo" placeholder="Ingrese su correo electrónico">
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" id="submitBtn" class="btn btn-primary">Enviar correo</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <br>
                        <a href="../../../Dentista_Corona/iniciar_sesion.php">Volver al inicio de sesión</a>
                        <br>
                    </div>
                </div>
            </div>
            <!-- Modal para mensaje de éxito -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="color: #fff; background-color:#1C3059; border-color:#1C3059;">
                            <h5 class="modal-title" id="successModalLabel">¡Correo enviado!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="color: #fff; background-color:#1C3059; border-color:#1C3059;">
                            <p>Se ha enviado un correo con instrucciones para restablecer tu contraseña a la dirección de correo proporcionada.</p>
                            <p>Por favor, verifica tu bandeja de entrada y también la carpeta de spam o correo no deseado si no ves el correo en tu bandeja de entrada.</p>
                        </div>
                        <div class="modal-footer" style="color: #fff; background-color:#1C3040; border-color:#1C3059;">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del modal -->
            <script>
                $(document).ready(function() {
                    // Agrega un listener al botón de envío
                    $("#submitBtn").click(function() {
                        // Obtiene los datos del formulario
                        let formData = $("#passwordResetForm").serialize();

                        // Realiza la solicitud AJAX al servidor
                        $.ajax({
                            type: "POST",
                            url: "./assets/conexion/reset_pswd.php",
                            data: formData,
                            success: function(response) {
                                if (response.trim() === "success") {
                                    // Muestra el modal de éxito
                                    $("#successModal").modal("show");
                                } else {
                                    // Maneja otros casos de respuesta del servidor
                                    alert("Error al procesar la solicitud.");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr);
                                console.log(status);
                                console.log(error);
                                // Maneja errores de la solicitud AJAX
                                alert("Error en la solicitud AJAX.");
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
    <!-- Coloca el script de jQuery antes de Bootstrap -->
    <script src="../../../Dentista_Corona/js/reset_pswd.js"></script>
</body>

</html>