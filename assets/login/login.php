<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="../../images/Logo_Big.png" type="image/png">
    <link rel="stylesheet" href="../../Dentista_Corona/css/registro_login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    $(document).ready(function(){
        $('#loginForm').submit(function(event){
            event.preventDefault();
            var username = $('#usuario').val();
            var username_id = $('#id').val();
            var password = $('#password').val();
            $.ajax({
                type: 'POST',
                url: "./assets/conexion/login.php",
                data: {username: username, password: password, username_id: username_id},
                success: function(response){
                    if(response == 'success'){
                        swal({
                            title: "¡Éxito!",
                            text: "Inicio de sesión exitoso",
                            icon: "success",
                            buttons: false
                        });
                        setTimeout(function(){
                            window.location = './assets/inicio/panel.php';
                        }, 2000);
                    } else {
                        swal({
                            title: "¡ERROR!",
                            text: "Datos Incorrectos",
                            icon: "error",
                            buttons: false
                        });
                    }
                    // Limpiar los campos de usuario y contraseña
                    $('#usuario').val('');
                    $('#password').val('');
                    // Cerrar SweetAlert después de 2 segundos en caso de error
                    setTimeout(function(){
                        swal.close();
                    }, 2000);
                }
            });
        });
    });
</script>


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
                        <h3 style="margin-bottom: 0;">Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <br>
                        <div class="img-container">
                            <img src="./images/doctor.png" alt="Icono" style="max-width: 100px; margin-right: 1px;">
                        </div>
                        <br>
                        <br>
                        <form id="loginForm" method="POST">
                        <input type="hidden" id="id" name="id">
                            <div class="form-group row">
                                <label for="usuario" class="col-sm-3 col-form-label text-white">Usuario:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control text-white" id="usuario" name="usuario" placeholder="Ingrese su usuario">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label text-white">Contraseña:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control text-white" id="password" name="password" placeholder="Ingrese su contraseña">
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                                <br>
                                <div class="col-sm-6">
                                    <a href="../../../Dentista_Corona/registrar_usuario.php" class="btn btn-secondary">Registrar un usuario</a>
                                </div>
                            </div>
                        </form>
                        <br>
                        <br>
                        <a href="../../../Dentista_Corona/cambiar_pswd.php">¿Olvidó su contraseña?</a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
