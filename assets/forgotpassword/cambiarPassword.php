<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="./images/Logo_Big.png" type="image/png">
    <link rel="stylesheet" href="./css/registro_login.css">
    <?php include './assets/conexion/verificar_tokens.php'; ?>
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
                        <h3 style="margin-bottom: 0;">Cambio de contraseña</h3>
                    </div>
                    <div class="card-body">
                        <div class="img-container">
                            <img src="./images/password.png" alt="Icono" style="max-width: 100px; margin-right: 1px;">
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
                            <br>
                            <div id="passwordError" class="alert alert-danger d-none" role="alert">La contraseña debe tener al menos 8 caracteres con al menos una mayúscula y un número.</div>
                            <div id="confirmPasswordError" class="alert alert-danger d-none" role="alert">Las contraseñas no coinciden.</div>
                            <br>
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
    <script src="../../../dentista_corona/js/verificar_tokens.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
