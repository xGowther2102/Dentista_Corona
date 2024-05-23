<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="./images/Logo_Big.png" type="image/png">
    <style>
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
                    <img src="./images/Logo_Big.png" alt="Login Image" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 style="margin-bottom: 0;">HOLA DOCTOR</h3> <!-- Added margin to h3 -->
                    </div>
                    <div class="card-body">
                        <br>
                        <div class="img-container">
                            <img src="./images/saludo.png" alt="Icono" style="max-width: 100px; margin-right: 1px;">
                        </div>
                        <br>
                        <br>
                        <p>Bienvenido al sistema de acciones rapidas.</p>
                        <p>Por favor, seleccione una opción:</p>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="./iniciar_sesion.php" class="btn btn-primary">Ir a iniciar sesion</a>
                            </div>
                            <br>
                            <div class="col-sm-6">
                                <a href="./registrar_usuario.php" class="btn btn-secondary">Ir a registrar un usuario</a>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
