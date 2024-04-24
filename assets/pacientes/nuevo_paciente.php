<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar nuevo paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .container {
            max-width: 800px;
            /* Ajustado el ancho para que las columnas queden en la misma línea */
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        /* Estilos para las columnas */
        .col-left,
        .col-right {
            width: 45%;
            /* Ancho ajustado para dejar espacio entre las columnas */
            float: left;
            margin-right: 5%;
        }

        /* Estilos para los botones */
        .btn-container {
            text-align: center;
            clear: both;
            /* Limpiar flotados para que los botones queden centrados */
            margin-top: 15px;
            /* Espacio entre los campos y los botones */
        }

        /* Estilos para los inputs */
        input.form-control {
            border: none;
            border-radius: 0;
            border-bottom: 1px solid #ccc;
            box-shadow: none;
        }

        /* Estilos para la animación del select */
        select.form-control.animate-select {
            position: relative;
        }

        select.form-control.animate-select::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 2px;
            background-color: #007bff;
            bottom: 0;
            left: 0;
            transition: width 0.3s ease-in-out;
        }

        select.form-control.animate-select:hover::after {
            width: 100%;
        }

        /* Estilos para el efecto de brillo en los botones */
        .btn-shine {
            position: relative;
            overflow: hidden;
        }

        .btn-shine::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: width 0.5s ease-out, height 0.5s ease-out, transform 0.5s cubic-bezier(0.17, 0.67, 0.83, 0.67);
            transform: translate(-50%, -50%) scale(0);
        }

        .btn-shine:hover::before {
            width: 0;
            height: 0;
            transform: translate(-50%, -50%) scale(2);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">Registrar nuevo paciente</h1>

        <div class="col-left">
            <form action="#">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre">
                </div>

                <div class="form-group">
                    <label for="apellidoP">Apellido paterno:</label>
                    <input type="text" class="form-control" id="apellidoP" placeholder="Ingrese su apellido paterno">
                </div>

                <div class="form-group">
                    <label for="apellidoM">Apellido materno:</label>
                    <input type="text" class="form-control" id="apellidoM" placeholder="Ingrese su apellido materno">
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" class="form-control" id="telefono" placeholder="Ingrese su número de teléfono">
                </div>

            </form>
        </div>

        <div class="col-right">
            <form action="#">
                <div class="form-group">
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" class="form-control" id="correo" placeholder="Ingrese su correo electrónico">
                </div>

                <div class="form-group">
                    <label for="fechaNacimiento">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" id="fechaNacimiento">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input class="form-control" id="direccion" placeholder="Ingrese su dirección"></input>
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select class="form-control animate-select" id="sexo">
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="btn-container">
            <button type="button" class="btn btn-primary btn-shine" onclick="registrarPaciente()">Registrar</button>
            <button type="button" class="btn btn-secondary btn-shine" data-bs-toggle="modal" data-bs-target="#errorModal">Cancelar</button>
        </div>
        </form>
    </div>
    </div>

    <!-- Modal de éxito -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">¡Éxito!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Se ha registrado con éxito el paciente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de error -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">¡Error!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Por favor, complete todos los campos antes de registrar al paciente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function registrarPaciente() {
            // Aquí puedes agregar la lógica para validar los campos del formulario antes de registrar al paciente
            // Por simplicidad, este ejemplo solo muestra el modal de éxito
            document.getElementById('successModal').classList.add('show');
        }
    </script>
</body>

</html>