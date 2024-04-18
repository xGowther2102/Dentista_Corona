<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        /* Add custom CSS styles */
        body {
            background-color: #1C3059;
            /* Set background color to HEX #1C3059 */
            color: white;
            /* Set text color to white */
        }

        .container-fluid {
            height: 100vh;
            /* Set the container to 100% viewport height */
        }

        .row {
            display: flex;
            /* Use flexbox for row layout */
            align-items: center;
            /* Align items vertically */
            justify-content: center;
            /* Center items horizontally */
        }

        .col-md-6 {
            text-align: center;
            /* Center content within columns */
        }

        .img-container {
            display: flex;
            /* Use flexbox for image centering */
            justify-content: center;
            /* Center image horizontally */
            max-width: 100%;
            /* Set maximum width for the image container */
        }

        .img-fluid {
            max-width: 100%;
            /* Set maximum width for the image */
            height: auto;
            /* Maintain aspect ratio */
        }

        .card {
            width: 80%;
            /* Adjust card width as needed */
            margin: 0 auto;
            /* Center the card horizontally */
            background-color: rgba(255, 255, 255, 0.1);
            /* Set background color with transparency */
            padding: 20px;
            /* Add padding to the card */
            border-radius: 30px;
            /* Add border radius for rounded corners */
        }

        .card-header {
            border: none;
            /* Remove border around card header */
        }

        .form-control {
            background-color: transparent;
            /* Make the form inputs transparent */
            border: none;
            /* Remove borders */
            border-bottom: 1px solid white;
            /* Add a bottom border */
            color: white;
            /* Set text color to white */
            margin-bottom: 10px;
            /* Add some margin between inputs */
        }

        .form-control:focus {
            background-color: transparent;
            /* Make focused inputs transparent */
            border-color: white;
            /* Change border color on focus */
            box-shadow: none;
            /* Remove box shadow on focus */
            color: white;
            /* Set text color to white */
        }

        .btn-primary {
            background-color: #F2BC57;
            /* Set button background color */
            color: #1C3059;
            /* Set button text color */
            border: none;
            /* Remove button border */
            border-radius: 10px;
            /* Add border radius for rounded corners */
        }

        .btn-primary:hover {
            background-color: #F2AB50;
            /* Change button background color on hover */
            color: #1C3059;
            /* Change button text color on hover */
        }

        .btn-secondary {
            background-color: #A66933;
            /* Set second button background color */
            color: white;
            /* Set second button text color */
            border: none;
            /* Remove second button border */
            border-radius: 10px;
            /* Add border radius for rounded corners */
        }

        .btn-secondary:hover {
            background-color: #B66833;
            /* Change second button background color on hover */
            color: white;
            /* Change second button text color on hover */
        }

        a {
            text-decoration: none;
            color: #F2BC57;
            transition: background-color 0.3s;
            /* Transición suave del color de fondo */
        }

        a:hover {
            color: #FFA500;
            /* Color al pasar el cursor */
        }
    </style>
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
                        <h3 style="margin-bottom: 0;">Iniciar Sesión</h3> <!-- Added margin to h3 -->
                    </div>
                    <div class="card-body">
                        <br>
                        <div class="img-container">
                            <img src="../../images/doctor.png" alt="Icono" style="max-width: 100px; margin-right: 1px;">
                        </div>
                        <br>
                        <br>
                        <form action="pagina1.html">
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label text-white">Usuario:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control text-white" id="username" placeholder="Ingrese su usuario">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label text-white">Contraseña:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control text-white" id="password" placeholder="Ingrese su contraseña">
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                </div>
                                <br>
                                <div class="col-sm-6">
                                    <a href="pagina2.html" class="btn btn-secondary">Ir a otra página</a>
                                </div>
                            </div>
                        </form>
                        <br>
                        <br>
                        <a href="../../assets/forgotpassword/reset.php">¿Has olvidado tu contraseña?</a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>