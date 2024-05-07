<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                        <h3 style="margin-bottom: 0;">Registro de usuario</h3> <!-- Added margin to h3 -->
                    </div>
                    <div class="card-body">

                        <div class="img-container">
                            <img src="./images/registro.png" alt="Icono" style="max-width: 100px; margin-right: 1px;">
                        </div>

                        <form action="../../../Dentista_Corona/assets/conexion/registro_p.php" method="POST" id="registroForm">
                            <div class="form-group row">
                                <label for="nombre" class="col-sm-12 col-form-label text-white">Nombre:</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control text-white" id="nombre" name="nombre" placeholder="Ingrese su nombre">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user" class="col-sm-12 col-form-label text-white">Usuario:</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control text-white" id="user" name="user" placeholder="Ingrese su usuario">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-12 col-form-label text-white">Correo:</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control text-white" id="correo" name="correo" placeholder="Ingrese su correo">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-12 col-form-label text-white">Contraseña:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control text-white" id="password" name="password" placeholder="Ingrese su contraseña">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-outline-light btn-eye" id="togglePassword">🙈</button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirmPassword" class="col-sm-12 col-form-label text-white">Confirmar contraseña:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control text-white" id="confirmPassword" name="confirmPassword" placeholder="Confirme su contraseña">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-outline-light btn-eye" id="toggleConfirmPassword">🙈</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary" id="btnRegistrar">Registrar</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="alertas">
                            <div id="nombreError" class="alert alert-danger d-none" role="alert">Por favor, ingrese su nombre.</div>
                            <div id="correoError" class="alert alert-danger d-none" role="alert">Por favor, ingrese un correo electrónico válido.</div>
                            <div id="passwordError" class="alert alert-danger d-none" role="alert">La contraseña debe tener al menos 8 caracteres con al menos una mayúscula y un número.</div>
                            <div id="confirmPasswordError" class="alert alert-danger d-none" role="alert">Las contraseñas no coinciden.</div>
                        </div>
                        <!-- Modal de Avisos -->
                        <div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="background-color: #1C3059;">
                                    <div class="modal-header" style="color: #fff;">
                                        <h5 class="modal-title" id="avisoModalLabel">Aviso</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="avisoModalBody" style="color: #fff;">
                                        <!-- Aquí se mostrará el mensaje del aviso -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div>
                            <a href="../../../Dentista_Corona/assets/login/login.php">¿Ya tienes cuenta?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../../../Dentista_Corona/js/registro.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>