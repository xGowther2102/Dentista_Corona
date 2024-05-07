<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="./images/Logo_Big.png" type="image/png">
    <link rel="stylesheet" href="../../../Dentista_Corona/css/registro_login.css">
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
                        <form id="passwordResetForm" action="../../assets/conexion/reset_pswd.php" method="POST" onsubmit="return validarCorreoElectronico(event);">
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
                                    <button type="submit" class="btn btn-primary">Enviar correo</button>
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
        </div>
    </div>
    <script src="../../../Dentista_Corona/js/reset_pswd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>